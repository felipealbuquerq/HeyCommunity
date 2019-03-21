<?php

namespace App\Listeners;

use App\Events\TopicNotice;
use App\Notice;
use App\Wechat\TempleMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TopicNoticeListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TopicNotice  $event
     * @return void
     */
    public function handle(TopicNotice $event)
    {
        if ($event->userId != $event->senderId) {
            $this->wechatSendNewMailNotice($event);
            
            $notice = Notice::create([
                'user_id'       =>  $event->userId,
                'sender_id'     =>  $event->senderId,
                'entity_name'   =>  $event->entityName,
                'entity_class'  =>  get_class($event->entity),
                'entity_id'     =>  $event->entity->id,
            ]);
        }
    }

    /**
     * Send Wechat New Mail Notice
     */
    protected function wechatSendNewMailNotice($event)
    {
        if (!$event->user->wx_open_id) {
            return false;
        }

        $data = [
            'first'     =>  null,
            'subject'   =>  null,
        ];

        switch ($event->entityName) {
            case 'TopicComment':
                $data['first']      =   $event->sender->nickname . ': ' . strip_tags($event->entity->content);
                $data['subject']    =   '你的话题《' . $event->entity->topic->title . '》有了新评论';
                break;
            case 'TopicCommentReplay':
                $data['first']      =   $event->sender->nickname . ': ' . strip_tags($event->entity->content);
                $data['subject']    =   '你在话题《' . $event->entity->topic->title . '》的评论有了新回复';
                break;
        }

        // message target url
        $url = route('topic.show', $event->entity->topic->id);

        TempleMessage::sendNewMailNotice($event->user->wx_open_id, $data, $url);
    }
}
