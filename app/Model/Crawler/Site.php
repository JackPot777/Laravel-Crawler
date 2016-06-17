<?php

namespace App\Model\Crawler;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
	protected $table = 'sites';

	public function url(){
		$this->hasMany('App\Model\Crawler\Url','site_id','id');
	}
}
