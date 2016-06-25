<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * un the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs',function (Blueprint $table){
            $table->increments('id');
            $table->string('name')->nullable(false);
            $table->enum('status',['ToBeDone','Scheduled','Completed'])->default('ToBeDone');
			$table->dateTime('scheduled_datetime')->default(null);
            $table->dateTime('completed_datetime')->default(null);
            $table->integer('url_id')->unsigned();
            $table->foreign('url_id')->references('id')->on('urls');
            $table->integer('crawler_id')->unsigned();
            $table->foreign('crawler_id')->references('id')->on('crawlers');
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
        Schema::drop('jobs');
    }
}
