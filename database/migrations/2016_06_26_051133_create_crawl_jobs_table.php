<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrawlJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crawl_jobs',function (Blueprint $table){
            $table->increments('id');
            $table->boolean('iscompleted')->default(false);
            $table->text('url')->nullable(false);
            $table->string('html_title');
            $table->mediumText('html_content');
            $table->integer('job_id')->unsigned();
            $table->foreign('job_id')->references('id')->on('jobs');
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
        Schema::drop('crawl_jobs');
    }
}
