<?php

namespace App\Http\Controllers;

use App\BikeMeeting;
use EasyWeChat\Payment\Order;
use Illuminate\Http\Request;
use Auth;
use Log;
use Symfony\Component\HttpFoundation\RequestStack;

class BikeMeetingController extends Controller
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (strpos($request->header('user_agent'), 'MicroMessenger') == false) {
                // return redirect()->route('bike-meeting.wechat');
            }

            return $next($request);
        })->except(['wechat', 'payNotify']);
    }

    /**
     * Apply Page
     */
    public function apply()
    {
        $applyData = new BikeMeeting();

        return view('bike-meeting.apply', compact('applyData'));
    }

    /**
     * Apply Page
     */
    public function applySuccessful()
    {
        $applyData = BikeMeeting::where('user_id', Auth::id())->first();

        if (!$applyData) {
            return redirect()->route('bike-meeting.index');
        }

        return view('bike-meeting.apply-successful', compact('applyData'));
    }

    /**
     * Index Page
     */
    public function index()
    {
        if (Auth::check()) {
            $applyData = BikeMeeting::where('user_id', Auth::id())->first();
        }

        return view('bike-meeting.index', compact('applyData'));
    }

    /**
     * Payment
     */
    public function payment(Request $request)
    {

        $applyData = BikeMeeting::where('user_id', Auth::id())->first();

        // 报名
        if (!$applyData) {
            $this->validate($request, [
                'nickname'      =>  'required|string',
                'phone'         =>  'required',
            ]);

            $bikeMeeting = new BikeMeeting();
            $bikeMeeting->user_id   =   Auth::id();
            $bikeMeeting->nickname  =   $request->nickname;
            $bikeMeeting->phone     =   $request->phone;
            $bikeMeeting->save();

            $applyData = $bikeMeeting;
        }

        // 成功报名并缴费
        if ($applyData && $applyData->is_payment) {
            flash('您已缴纳该费用，请不要重复缴费')->error();
            return redirect()->route('bike-meeting.index');
        }

        // 缴费
        $wechat = app('wechat');

        $orderAttr = [
            'trade_type'       => 'JSAPI',
            'body'             => '上犹自行车运动协会年会报名费',
            'detail'           => '年会报名费用',
            'out_trade_no'     => 'BikeMt' . '-U' . Auth::id() . '-' . time(),
            'total_fee'        => BikeMeeting::APPLY_FEE_NUMBER,
            'openid'           => Auth::user()->wx_open_id,
            'notify_url'       => route('bike-meeting.pay-notify'),
        ];

        $order = new Order($orderAttr);
        $result = $wechat->payment->prepare($order);

        $assign['applyData'] = $applyData;
        $assign['wechatJs'] = $wechat->js;
        $assign['wechatPayConfig'] = $wechat->payment->configForJSSDKPayment($result->prepay_id);

        return view('bike-meeting.apply', $assign);
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

                // change data
                $applyData = BikeMeeting::whereHas('user', function ($query) use ($notifyData) {
                    $query->where('wx_open_id', $notifyData['openid']);
                })->first();

                if ($applyData) {
                    $applyData->is_payment = true;
                    $applyData->save();
                }
            }

            Log::debug('Wechat Pay Debug: ', ['notify' => $notify]);
            Log::debug('Wechat Pay Debug: ', ['notify' => $successful]);
        });

        return $response;
    }

    /**
     * Only In Wechat Browser Page
     */
    public function wechat()
    {
        return view('bike-meeting.wechat');
    }

    /**
     * Apply Data
     */
    public function applyData()
    {
        $user = Auth::user();
        if (!$user && !$user->is_super_admin) {
            abort(403, '无权访问此页面');
        }

        $applyData = BikeMeeting::latest()->paginate();

        return view('bike-meeting.apply-data', compact('applyData'));
    }
}
