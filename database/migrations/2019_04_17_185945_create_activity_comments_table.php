<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->unsigned()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('activity_id')->index()->unsigned()->comment('Activity ID');
            $table->foreign('activity_id')->references('id')->on('activities');

            $table->integer('activity_comment_id')->index()->unsigned()->nullable()->comment('Activity Comment ID');
            $table->integer('floor_number')->comment('Activity Comment Floor Number');

            $table->text('content')->comment('Activity Comment Content');

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
        Schema::dropIfExists('activity_comments');
    }
}
