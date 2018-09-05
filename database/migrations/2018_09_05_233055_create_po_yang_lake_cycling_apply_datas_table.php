<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoYangLakeCyclingApplyDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_yang_lake_cycling_apply_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->unsigned()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('name')->comment('姓名');
            $table->string('club_name')->comment('俱乐部名称');
            $table->string('identity_card_number')->comment('身份证号码');
            $table->string('phone')->comment('手机号码');
            $table->tinyInteger('gender_id')->comment('性别');
            $table->tinyInteger('group_id')->comment('组别');
            $table->tinyInteger('is_shangyou_people')->default(0)->comment('是否上犹籍选手');

            $table->tinyInteger('is_payment_apply_fee')->default(0)->comment('是否支付报名费');
            $table->tinyInteger('is_payment_deposit')->default(0)->comment('是否支付报名费');
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
        Schema::dropIfExists('po_yang_lake_cycling_apply_datas');
    }
}
