<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
	use SoftDeletes;
	/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('desc');
            $table->string('root_url');
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
        Schema::drop('sites');
    }
}
