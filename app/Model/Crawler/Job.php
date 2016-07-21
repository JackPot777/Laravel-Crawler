<?php

namespace App\Model\Crawler;

use App\Utility;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table='jobs';
    protected $fillable = ['name','status','scheduled_datetime','crawler_id','url_id'];
    public function crawler()
    {
        return $this->belongsTo('App\Model\Crawler\Crawler','crawler_id','id');
    }
    public function url()
    {
        return $this->belongsTo('App\Model\Crawler\Url','url_id','id');
    }
    public function crawlJobs()
    {
        return $this->hasMany('App\Model\Crawler\CrawlJob','job_id','id');
    }
    public function isActivated()
    {
        return $this->crawler()->first()->isactivated;
    }
    public function start()
    {
        $crawler = $this->crawler()->first();
        $crawler->isactivated = true;
        $crawler->save();
    }
    public function pause()
    {
        $crawler = $this->crawler()->first();
        $crawler->isactivated = false;
        $crawler->save();
    }
    private function generateCrawlJobs()
    {
        $url = $this->url()->first();
        foreach ($url->getGeneratedUrls() as $url)
        {
            $crawlJob = new CrawlJob();
            $crawlJob->url = $url;
            $crawlJob->job_id = $this->id;
            $crawlJob->save();
        }
    }

    public function save(array $options = [])
    {
        $tmp = parent::save($options);
        $this->generateCrawlJobs();
        return $tmp;
    }


}
