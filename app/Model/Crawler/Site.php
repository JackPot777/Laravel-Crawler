<?php

namespace App\Model\Crawler;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
	use SoftDeletes;
	protected $table = 'sites';
	protected $fillable = ['name','root_url','desc'];
	protected $date = 'deleted_at';

	public function url()
	{
		return $this->hasMany('App\Model\Crawler\Url','site_id','id');
	}
}
