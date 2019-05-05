<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TopicCommmentsMigrateToComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $rootComments = \App\TopicComment::whereNull('parent_id')->withTrashed()->get();

        foreach ($rootComments as $rootComment) {
            $newRootComment = \App\Models\Comment::create($this->getModelData($rootComment));

            if ($rootComment->childComments()->count()) {
                foreach ($rootComment->childComments as $comment) {
                    $data = $this->getModelData($comment);
                    $data['root_id']  =   $newRootComment->id;
                    $data['parent_id']  =   $newRootComment->id;

                    \App\Models\Comment::create($data);
                }
            }
        }
    }

    /*
     * Get Model Data
     */
    protected function getModelData($comment)
    {
        return [
            'floor_number'  =>  $comment->floor_number,
            'entity_type'   =>  \App\Topic::class,
            'entity_id'     =>  $comment->topic_id,
            'user_id'       =>  $comment->user_id,
            'content'       =>  $comment->content,

            'thumb_up_num'      =>  $comment->thumb_up_num,
            'thumb_down_num'    =>  $comment->thumb_down_num,
            'created_at'        =>  $comment->created_at,
            'updated_at'        =>  $comment->updated_at,
            'deleted_at'        =>  $comment->deleted_at,
        ];
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
