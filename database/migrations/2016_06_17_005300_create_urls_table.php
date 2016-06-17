<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urls',function (Blueprint $table){
            $table->increments('id');
			$table->text('name');
            $table->text('original_url');
			$table->enum('type',['Simple','Simple_Custom'])->default('Simple');
			$table->text('settings'); //JSON
			$table->integer('site_id')->unsigned();
            $table->foreign('site_id')->references('id')->on('sites');
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
        Schema::drop('urls');
    }
}
