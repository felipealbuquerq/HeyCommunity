<?php

namespace App\Wechat;


class TempleMessage
{
    public static function sendNewMailNotice($receiver, $data, $url)
    {
        $templeId = '3kIiG0SPwcsGQCoN-YuS7mXyvfruio6SlPkF2FK7idA';
        $sender = '消息机器人';

        $app = app('wechat');
        $notice = $app->notice;

        $data['sender']     =   $sender;
        $data['remark']     =   "\n此消息由系统自动发送，点击查看详情 ~";

        $result = $notice->send([
            'touser'        => $receiver,
            'template_id'   => $templeId,
            'data'          => $data,
            'url'           => $url,
        ]);
    }
}
