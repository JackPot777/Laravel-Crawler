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

	public function urls()
	{
		return $this->hasMany('App\Model\Crawler\Url','site_id','id');
	}
	
	public function delete()
	{
		if ($this->isActivated())
		{
			return false;
		}
		foreach($this->urls as $url)
		{
			$url->delete();
		}
		return parent::delete();
	}

	public function isActivated()
	{
		foreach ($this->urls as $url)
		{
			if ($url->isActivated())
			{
				return true;
			}
		}
		return false;
	}
}
