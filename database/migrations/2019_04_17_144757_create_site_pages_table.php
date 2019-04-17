<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\Model;

class CreateSitePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_name')->unique()->comment('Unique Name');

            $table->string('title')->comment('Page Title');
            $table->text('content')->comment('Page Content');

            $table->timestamps();
            $table->softDeletes();
        });

        Model::unguard();

        \App\SitePage::create(['unique_name' => 'about', 'title' => 'about', 'content' => '']);
        \App\SitePage::create(['unique_name' => 'help', 'title' => 'help', 'content' => '']);
        \App\SitePage::create(['unique_name' => 'terms', 'title' => 'terms', 'content' => '']);
        \App\SitePage::create(['unique_name' => 'privacy', 'title' => 'privacy', 'content' => '']);

        Model::reguard();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_pages');
    }
}
