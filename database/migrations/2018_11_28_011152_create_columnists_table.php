<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumnistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('columnists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->unsigned()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('domain')->comment('Column Domain');

            $table->string('title')->comment('Column Title');
            $table->string('introduction', 255)->comment('Columnist Introduction');
            $table->string('description', 255)->comment('Column Description');

            $table->integer('article_num')->default(0)->comment('Article Number');
            $table->integer('read_num')->default(0)->comment('Read Number');
            $table->integer('comment_num')->default(0)->comment('Comment Number');
            $table->integer('subscribe_num')->default(0)->comment('Subscribe Number');

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
        Schema::dropIfExists('columnists');
    }
}
