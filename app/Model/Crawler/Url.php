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

	private function generateCrawlees()
	{
		if ($this->type == 'Simple')
		{
			$crawlee = new Crawlee();
			$crawlee->generated_url = $this->original_url;
			$crawlee->url_id = $this->id;
			$crawlee->save();
		}else if($this->type == 'Simple_Custom')
		{
			$crawleeSettings = json_decode($this->settings,true);
			$crawlees =  array();
			//data array generation
			$paramCombos = [];
			$y=0;
			foreach ($crawleeSettings['params'] as $param)
			{
				if ($param['type'] == 'number')
				{
					for($i=$param['start'];$i<=$param['end'];$i++)
					{
						$paramCombos[$y][] = $i;
					}
				}else if ($param['type'] == 'string')
				{
					$paramCombos[$y] = $param['combination'];
				}
				$y++;
			}
			unset($y);
			$paramCombos = Utility::generateCombination($paramCombos);
			foreach ($paramCombos as $paramCombo)
			{
				$crawlee = new Crawlee();
				$crawlee->url_id = $this->id;
				$crawlee->generated_url = $this->original_url;
				$i=0;
				foreach ($paramCombo as $param)
				{
					$crawlee->generated_url = str_replace('@param'.$i,$param,$crawlee->generated_url);
					$i++;
				}
				unset($i);
				$crawlees[] = $crawlee;
			}
			foreach ($crawlees as $crawlee)
			{
				$crawlee->save();
			}
		}
	}

	public function save(array $options = [])
	{
		$tmp = parent::save($options);
		//$this->generateCrawlees();
		return $tmp;
	}


	public function crawlee()
	{
		return $this->hasMany('App\Model\Crawler\Crawlee','url_id','id');
	}

	public function site()
	{
		return $this->belongsTo('App\Model\Crawler\Site','site_id','id');
	}
}
