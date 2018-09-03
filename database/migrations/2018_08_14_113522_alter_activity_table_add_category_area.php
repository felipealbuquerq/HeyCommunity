<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterActivityTableAddCategoryArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->nullable()->comment('Category ID')->after('user_id');
            $table->foreign('category_id')->references('id')->on('activity_categories');

            $table->integer('area_id')->unsigned()->nullable()->comment('Area ID')->after('user_id');
            $table->foreign('area_id')->references('id')->on('activity_areas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['area_id']);

            $table->dropColumn(['category_id', 'area_id']);
        });
    }
}
