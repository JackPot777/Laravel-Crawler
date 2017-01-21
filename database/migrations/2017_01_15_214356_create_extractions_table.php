<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extractions',function (Blueprint $table){
            $table->increments('id');
            $table->integer('job_id')->nullable(false);
            $table->string('name');
            $table->string('description');
            $table->string('type')->enum(['css-selector','regex']);
            $table->text('rule');
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
        Schema::drop('extractions');
    }
}
