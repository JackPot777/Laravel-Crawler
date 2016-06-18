<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrawleeResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crawlee_results',function (Blueprint $table){
            $table->increments('id');
            $table->enum('status',['ToBeDone','Processing','Completed'])->default('ToBeDone');
            $table->string('html_title');
            $table->mediumText('html_content');
			$table->dateTime('html_crawl_tobedone_datetime')->default(null);
			$table->dateTime('html_crawl_completed_datetime')->default(null);
            $table->integer('crawlee_id')->unsigned();
            $table->foreign('crawlee_id')->references('id')->on('crawlees');
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
        Schema::drop('crawlee_results');
    }
}
