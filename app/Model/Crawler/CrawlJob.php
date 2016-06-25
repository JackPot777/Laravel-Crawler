<?php

namespace App\Model\Crawler;

use Illuminate\Database\Eloquent\Model;

class CrawlJob extends Model
{
    protected $table='crawl_jobs';
    protected $fillable = ['job_id','url'];

    public function job()
    {
        return $this->belongsTo('App\Model\Crawler\Job','job_id','id');
    }
}
