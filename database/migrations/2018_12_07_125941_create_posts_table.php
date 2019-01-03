<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->unsigned()->nullable()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('type_id')->default(1)->comment('Type');
            $table->string('avatar')->nullable()->comment('Avatar');
            $table->string('title')->comment('Title');
            $table->text('content')->nullable()->comment('Content');
            $table->string('origin_url')->nullable()->comment('Origin URL');

            $table->integer('read_num')->default(0)->comment('Read Number');
            $table->integer('favorite_num')->default(0)->comment('Favorite Number');
            $table->integer('comment_num')->default(0)->comment('Comment Number');
            $table->integer('thumb_up_num')->default(0)->comment('Thumb Up Number');
            $table->integer('thumb_down_num')->default(0)->comment('Thumb Down Number');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
