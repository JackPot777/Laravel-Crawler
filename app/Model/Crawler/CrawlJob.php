<?php

namespace App\Model\Crawler;

use Illuminate\Database\Eloquent\Model;
use Goutte\Client;

class CrawlJob extends Model
{
    /**
     * CrawlJob database table.
     *
     * @var string
     */
    protected $table='crawl_jobs';

    /**
     * Mass assignment Fillables.
     *
     * @var array[string]
     */
    protected $fillable = ['job_id','url'];

    /**
     * Get a belonged job.
     *
     * @return App\Model\Crawler\Job
     */
    public function job()
    {
        return $this->belongsTo('App\Model\Crawler\Job','job_id','id');
    }

    /**
     * Start to crawl the job.
     *
     */
    public function crawl()
    {
        $this->tried_times = $this->tried_times + 1;
        if (!$this->iscompleted) {
            $HTTPClient= new Client();
            $HTMLCrawler = $HTTPClient->request('GET',$this->url);
            $response_code = $HTTPClient->getResponse()->getStatus();
            $domHtml = $HTTPClient->getResponse()->getContent(); 
            $title = $HTMLCrawler->filter('title')->first()->text();

            $this->response_code = $response_code;
            $this->html_content = ''.$domHtml;
            $this->html_title   = ''.$title;
            $this->iscompleted = $this->response_code == 200;
            $this->save();
        }
    }
}
