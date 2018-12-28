<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBikeMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bike_meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->unsigned()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('name')->nullable()->comment('姓名');
            $table->string('nickname')->comment('昵称');
            $table->string('phone')->comment('手机号码');

            $table->tinyInteger('is_payment')->default(0)->comment('是否支付报名费');
            $table->tinyInteger('state')->default(0)->comment('状态');

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
        Schema::dropIfExists('bike_meetings');
    }
}
