<?php

namespace App\Http\Controllers;

use App\PoYangLakeCyclingApplyData;
use EasyWeChat\Payment\Order;
use Illuminate\Http\Request;
use Auth;
use Log;

class PoYangLakeCyclingController extends Controller
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (strpos($request->header('user_agent'), 'MicroMessenger') == false) {
                // return redirect()->route('poyang-lake-cycling.wechat');
            }

            return $next($request);
        })->except(['index', 'wechat', 'payNotify']);
    }

    /**
     * Index Page
     */
    public function index()
    {
        return view('poyang-lake-cycling.index');
    }

    /**
     * Only In Wechat Browser Page
     */
    public function wechat()
    {
        return view('poyang-lake-cycling.wechat');
    }

    /**
     * Apply Check Handle
     */
    protected function appiledRedirect(PoYangLakeCyclingApplyData $applyData)
    {
        if ($applyData->is_payment_apply_fee && $applyData->is_payment_deposit) {
            flash('您已成功报名')->error();
            return redirect()->route('poyang-lake-cycling.apply-successful');
        } else {
            flash('您已报名，请进行缴费')->error();
            return redirect()->route('poyang-lake-cycling.payment');
        }
    }

    /**
     * Apply Page
     */
    public function apply()
    {
        $applyData = PoYangLakeCyclingApplyData::where('user_id', Auth::id())->first();
        if ($applyData) return $this->appiledRedirect($applyData);

        return view('poyang-lake-cycling.apply');
    }

    /**
     * Apply Handle
     */
    public function applyHandle(Request $request)
    {
        $applyData = PoYangLakeCyclingApplyData::where('user_id', Auth::id())->first();
        if ($applyData) return $this->appiledRedirect($applyData);

        $this->validate($request, [
            'name'          =>  'required|string|min:2',
            'club_name'     =>  'required|string',
            'phone'         =>  'required|string|min:11',
            'identity_card_number'      =>  'required|string|min:18',
            'is_shangyou_people'        =>  'required|integer|in:0,1',
            'gender_id'     =>  'required|integer|in:1,2',
            'group_id'      =>  'required|integer|in:1,2,3,4',
        ], [
            'gender_id.in'  =>  '请选择性别',
            'group_id.in'   =>  '请选择组别',
        ], [
            'name'          =>  '姓名',
            'club_name'     =>  '俱乐部名称',
            'phone'         =>  '手机号码',
            'identity_card_number'      =>  '身份证号码',
            'is_shangyou_people'        =>  '是否上犹籍选手',
            'gender_id'     =>  '性别',
            'group_id'      =>  '组别',
        ]);

        $data = $request->only(['name', 'club_name', 'phone', 'identity_card_number', 'is_shangyou_people', 'gender_id', 'group_id']);
        $data['user_id']    =   Auth::id();
        $applyData = PoYangLakeCyclingApplyData::create($data);

        if ($applyData) {
            flash('报名已提交，请先缴费');
            return redirect()->route('poyang-lake-cycling.payment');
        } else {
            flash('报名失败')->error();
            return back();
        }
    }

    /**
     * Payment Page
     */
    public function payment()
    {
        $applyData = PoYangLakeCyclingApplyData::where('user_id', Auth::id())->first();
        if ($applyData && $applyData->is_payment_apply_fee && $applyData->is_payment_deposit) {
            flash('您已完成缴费')->error();
            return redirect()->route('poyang-lake-cycling.apply-successful');
        }

        return view('poyang-lake-cycling.payment', compact('applyData'));
    }

    /**
     * Pay Notify
     */
    public function payNotify(Request $request)
    {
        Log::debug('Wechat Pay Debug: ', ['request' => $request]);
        $app = app('wechat');
        $response = $app->payment->handleNotify(function($notify, $successful){
            if ($successful) {
                $notifyData = json_decode($notify, true);
                Log::debug('Wechat Pay Debug: ', ['notifyData' => $notifyData]);

                // TODO change data
            }

            Log::debug('Wechat Pay Debug: ', ['notify' => $notify]);
            Log::debug('Wechat Pay Debug: ', ['notify' => $successful]);
        });

        return $response;

    }

    /**
     * Pay Apply Fee
     */
    public function payApplyFee()
    {
        $applyData = PoYangLakeCyclingApplyData::where('user_id', Auth::id())->first();
        if ($applyData && $applyData->is_payment_apply_fee) {
            flash('您已缴纳该费用，请不要重复缴费')->error();
            return redirect()->route('poyang-lake-cycling.payment');
        }

        $wechat = app('wechat');

        $orderAttr = [
            'trade_type'       => 'JSAPI',
            'body'             => '阳明湖第四届业余自行车邀请赛报名费',
            'detail'           => '赛事报名费用',
            // 'out_trade_no'     => 'PLC-APPLY-FEE' . '-U' . Auth::id(),
            'out_trade_no'     => 'PLC-APPLY-FEE' . '-U' . Auth::id() . '-' . time(),
            'total_fee'        => PoYangLakeCyclingApplyData::APPLY_FEE_NUMBER,
            'openid'           => Auth::user()->wx_open_id,
            'notify_url'       => route('poyang-lake-cycling.pay-notify'),
        ];

        $order = new Order($orderAttr);
        $result = $wechat->payment->prepare($order);

        $assign['applyData'] = $applyData;
        $assign['wechatJs'] = $wechat->js;
        $assign['wechatPayConfig'] = $wechat->payment->configForJSSDKPayment($result->prepay_id);

        return view('poyang-lake-cycling.payment', $assign);
    }

    /**
     * Pay Apply Fee
     */
    public function payDeposit()
    {
        $applyData = PoYangLakeCyclingApplyData::where('user_id', Auth::id())->first();
        if ($applyData && $applyData->is_payment_deposit) {
            flash('您已缴纳该费用，请不要重复缴费')->error();
            return redirect()->route('poyang-lake-cycling.payment');
        }

        $wechat = app('wechat');

        $orderAttr = [
            'trade_type'       => 'JSAPI',
            'body'             => '阳明湖第四届业余自行车邀请赛押金',
            'detail'           => '计时芯片押金',
            // 'out_trade_no'     => 'PLC-DEPOSIT' . '-U' . Auth::id(),
            'out_trade_no'     => 'PLC-DEPOSIT' . '-U' . Auth::id() . '-' . time(),
            'total_fee'        => PoYangLakeCyclingApplyData::DEPOSIT_NUMBER,
            'openid'           => Auth::user()->wx_open_id,
            'notify_url'       => route('poyang-lake-cycling.pay-notify'),
        ];

        $order = new Order($orderAttr);
        $result = $wechat->payment->prepare($order);

        $assign['applyData'] = $applyData;
        $assign['wechatJs'] = $wechat->js;
        $assign['wechatPayConfig'] = $wechat->payment->configForJSSDKPayment($result->prepay_id);

        return view('poyang-lake-cycling.payment', $assign);
    }

    /**
     * Apply Successful Page
     */
    public function applySuccessful()
    {
        return view('poyang-lake-cycling.apply-successful');
    }
}
