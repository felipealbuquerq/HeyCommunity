<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestRecordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_recorders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->unsigned()->nullable()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('session_id', 60)->nullable()->comment('Session ID');

            $table->string('path', 255)->comment('The Page Path');
            $table->string('url', 255)->comment('The Page URL');
            $table->string('method', 10)->comment('The Request Method');
            $table->string('ip', 30)->comment('The Request Ip');
            $table->text('params')->nullable()->comment('The Request Params');
            $table->string('route_name', 30)->nullable()->comment('The Page Route Name');
            $table->string('controller_name', 100)->nullable()->comment('The Page Controller Name');

            $table->integer('lifetime')->default(0)->comment('The Page View Time');

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
        Schema::dropIfExists('request_recorders');
    }
}
