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

    protected $fillable = ['name','desc','maxinstances'];
}
