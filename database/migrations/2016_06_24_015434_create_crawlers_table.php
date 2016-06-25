<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrawlersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @param maxinstances int min 1 max 10
     * @return void
     */
    public function up()
    {
        Schema::create('crawlers',function (Blueprint $table){
            $table->increments('id');
            $table->string('name')->nullable(false);
            $table->string('desc')->nullable(false);
            $table->boolean('isactivated')->default(false);
            $table->integer('completedjobs')->default(0);
            $table->integer('maxinstances')->default(1);
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
        Schema::drop('crawlers');
    }
}
