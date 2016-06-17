<?php

namespace App\Model\Crawler;

use Illuminate\Database\Eloquent\Model;

class CrawleeResult extends Model
{
    protected $table = 'crawlee_results';

    public function crawlee(){
        $this->belongsTo('App\Model\Crawler\Crawlee','crawlee_id','id');
    }


    public function crawl(){
        
    }

}
