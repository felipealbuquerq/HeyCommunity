<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimelineVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeline_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->unsigned()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('timeline_id')->index()->unsigned()->comment('Timeline ID');
            $table->foreign('timeline_id')->references('id')->on('timelines');

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
        Schema::dropIfExists('timeline_videos');
    }
}
