<?php

namespace App\Http\Controllers;

use App\BikeMeeting;
use EasyWeChat\Payment\Order;
use Illuminate\Http\Request;
use Auth;
use Log;

class BikeMeetingController extends Controller
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (strpos($request->header('user_agent'), 'MicroMessenger') == false) {
                return redirect()->route('bike-meeting.wechat');
            }

            return $next($request);
        })->except(['index', 'wechat', 'payNotify']);
    }

    /**
     * Index Page
     */
    public function index()
    {
        return view('bike-meeting.index');
    }

    /**
     * Payment
     */
    public function payment()
    {
        $applyData = BikeMeeting::where('user_id', Auth::id())->first();
        if ($applyData && $applyData->is_payment) {
            flash('您已缴纳该费用，请不要重复缴费')->error();
            return redirect()->route('bike-meeting.index');
        }

        $wechat = app('wechat');

        $orderAttr = [
            'trade_type'       => 'JSAPI',
            'body'             => '上犹自行车运动协会年会报名费',
            'detail'           => '年会报名费用',
            'out_trade_no'     => 'BIKE-MEETING' . '-U' . Auth::id() . '-' . time(),
            'total_fee'        => BikeMeeting::APPLY_FEE_NUMBER,
            'openid'           => Auth::user()->wx_open_id,
            'notify_url'       => route('bike-meeting.pay-notify'),
        ];

        $order = new Order($orderAttr);
        $result = $wechat->payment->prepare($order);

        $assign['applyData'] = $applyData;
        $assign['wechatJs'] = $wechat->js;
        $assign['wechatPayConfig'] = $wechat->payment->configForJSSDKPayment($result->prepay_id);

        return view('poyang-lake-cycling.payment', $assign);
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
}
