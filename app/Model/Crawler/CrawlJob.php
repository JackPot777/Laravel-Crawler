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
    protected $table='crawl_jobs';Goutte\Client

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
            $HTMLCrawler = new Client();
            $HTMLCrawler->request('GET',$this->url);

            $response_code = $HTMLCrawler->getResponse()->getStatus();
            $domHtml = $HTMLCrawler->getBody(); 

            $this->response_code = $response_code;
            $this->html_content = ''.$domHtml;
            $this->html_title   = ''.$domHtml->find('title')[0]->plaintext;
            $this->tried_times = $this->tried_times + 1;
            $this->iscompleted = $this->response_code == 200;
            $this->save();
        }
    }
}
