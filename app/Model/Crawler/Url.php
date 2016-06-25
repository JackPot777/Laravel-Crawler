<?php

namespace App\Model\Crawler;

use App\Model\Crawler\Crawlee;
use App\Utility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Url extends Model
{
	use SoftDeletes;

	protected $table = 'urls';
	protected $date = 'deleted_at';
	protected $fillable =['name','original_url','type','settings','site_id'];
	/**
	 * Crawlee Generator
	 * Rephase the settings and generate all of the crawlee url.
	 *
	 * Simple Type Generator for non-customized url.
	 *{
	 *  "type": "Simple",
	 *  "isCustomized": false
	 *}
	 *
	 * Simple_Custom Type Generator
	 *{
	 *  "type": "Custom_Generator",
	 *  "isCustomized": true,
	 *  "params": [
	 *    {
	 *      "name": "@param0",
	 *      "type": "number",
	 *      "start": 1,
	 *      "end": 99
	 *    },
	 *    {
	 *      "name": "@param1",
	 *      "type": "string",
	 *      "combination": [
	 *        "new",
	 *        "old",
	 *        "outdated",
	 *        "classic"
	 *      ]
	 *    }
	 *  ]
	 *}
	 **/


	public function crawlee()
	{
		return $this->hasMany('App\Model\Crawler\Crawlee','url_id','id');
	}

	public function site()
	{
		return $this->belongsTo('App\Model\Crawler\Site','site_id','id');
	}
}
