<?php

namespace App\Model\Crawler;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crawlee extends Model
{
	use SoftDeletes;
	protected $table = 'crawlees';
	protected $date = 'deleted_at';

	public function url()
	{
		return $this->belongsTo('App\Model\Crawler\Url','url_id','id');
	}

	public function crawleeResult()
	{
		return $this->hasMany('App\Model\Crawler\CrawleeResult','crawlee_id','id');
	}
}
