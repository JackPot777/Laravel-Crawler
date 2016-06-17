<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrawleesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crawlees',function (Blueprint $table){
            $table->increments('id');
            $table->text('generated_url');
			$table->integer('url_id')->unsigned();
            $table->foreign('url_id')->references('id')->on('urls');
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
        Schema::drop('crawlees');
    }
}
