<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemController extends Controller
{
    /**
     * Get Phone Captcha
     */
    public function getPhoneCaptcha(Request $request)
    {
        $this->validate($request, [
            'phone'     =>  'required|string|size:11',
        ]);

        $appKey = 'dd62f0529984ca26a98b0be3';
        $masterSecret = 'eda9b43078100513650e14c2';
        $smsTempId = '29873';
        $signTempId = '8560';

        $client = new \JiGuang\JSMS($appKey, $masterSecret);
        $result = $client->sendCode($request->phone, $smsTempId, $signTempId);

        if ($result['http_code'] == 200) {
            return response()->json([
                'status_code'   =>  200,
            ]);
        } else {
            return response([
                'status_code'   =>  403,
                'message'       =>  $result['body']['error']['message'],
            ], 403);
        }
    }

    /**
     * Check Phone Captcha
     */
    public function checkPhoneCaptcha(Request $request)
    {
        $this->validate($request, [
            'phone'     =>  'required|string|size:11',
        ]);

        $r = checkJiGuangSmsCode($request->phone);
    }
}
