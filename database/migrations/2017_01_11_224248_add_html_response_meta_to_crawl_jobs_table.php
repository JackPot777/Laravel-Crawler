<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHtmlResponseMetaToCrawlJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crawl_jobs',function (Blueprint $table){
            $table->integer('response_code')->deafault(null);
            $table->integer('tried_times')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('crawl_jobs',function (Blueprint $table){
            $table->dropColumn('response_code');
            $table->dropColumn('tried_times');
        });
    }
}
