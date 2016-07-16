<?php

namespace App\Model\Crawler;

use App\Model\Crawler\AsyncCrawler;
use Illuminate\Database\Eloquent\Model;

class Crawler extends Model
{
    protected $table = 'crawlers';

    public function getAsyncCrawler()
    {
        return new AsyncCrawler($this->header,$this->job);
    }

    public function url()
    {
        return $this->belongsTo('App\Model\Crawler\Url','url_id','id');
    }

    public function isRemovable()
    {
        return !$this->isactivated&&$this->url()->first()==null;
    }
    protected $fillable = ['name','desc','maxinstances'];
}
