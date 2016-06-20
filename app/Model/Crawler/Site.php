<?php

namespace App\Model\Crawler;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
	protected $table = 'sites';
	protected $fillable = ['name','root_url','desc'];


	public function url(){
		return $this->hasMany('App\Model\Crawler\Url','site_id','id');
	}
}
