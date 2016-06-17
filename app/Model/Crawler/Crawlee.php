<?php

namespace App\Model\Crawler;

use Illuminate\Database\Eloquent\Model;

class Crawlee extends Model
{
	protected $table = 'crawlees';

	public function url(){
		$this->belongsTo('App\Model\Crawler\Url','url_id','id');
	}
}
