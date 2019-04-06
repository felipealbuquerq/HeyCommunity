<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimelineCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeline_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->unsigned()->nullable()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('timeline_id')->index()->unsigned()->nullable()->comment('Timeline ID');
            $table->foreign('timeline_id')->references('id')->on('timelines');
            $table->integer('comment_id')->index()->unsigned()->nullable()->comment('Timeline Comment ID');
            $table->foreign('comment_id')->references('id')->on('timeline_comments');

            $table->string('content', 10000)->comment('Comment Content');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timeline_comments');
    }
}
