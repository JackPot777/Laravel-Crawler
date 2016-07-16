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
	protected $fillable =['name','original_url','settings','site_id'];
	/**
	 * Crawlee Generator
	 * Rephase the settings and generate all of the crawlee url.
	 * @return array $urls
	 **/
	public function getGeneratedUrls()
	{
		$urls = [];
		if ($this->settings == null)
		{
			$urls[] = $this->original_url;
		}else
		{
			$crawleeSettings = json_decode($this->settings,true);
			//data array generation
			$paramCombos = [];
			$y=0;
			$gloParam = [];
			foreach ($crawleeSettings as $paramName => $param)
			{
				$gloParam[$y]['name'] = $paramName;
				if ($param['type'] == 'number')
				{
					for($i=$param['start'];$i<=$param['end'];$i++)
					{
						$paramCombos[$y][] = (int)$i;
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
				$i=0;
				$newUrl = $this->original_url;
				foreach ($paramCombo as $param)
				{
					$newUrl = str_replace('@'.$gloParam[$i]['name'],$param,$newUrl);
					$i++;
				}
				unset($i);
				$urls[] = $newUrl;
			}
		}
		return $urls;
	}

	public function isActivated()
	{
		return $this->jobs()->count() > 0;
	}

	public function delete()
	{
		if ($this->isActivated())
		{
			throw new Exception('The url has job(s), cannot be deleted.');
			return ;
		}
		return parent::delete();
	}

	public function jobs()
	{
		return $this->hasMany('App\Model\Crawler\Job','url_id','id');
	}

	public function site()
	{
		return $this->belongsTo('App\Model\Crawler\Site','site_id','id');
	}
}
