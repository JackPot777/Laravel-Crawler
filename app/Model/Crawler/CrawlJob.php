<?php

namespace App\Model\Crawler;

use Illuminate\Database\Eloquent\Model;
use Sunra\PhpSimple\HtmlDomParser;

use App\Model\System\HTMLCrawler;

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
            /**
             *  TODO:: Use Goutte Crawler
             */ 
            $HTMLCrawler = new HTMLCrawler();
            $HTMLCrawler->load_file($this->url);
            $this->response_code = $HTMLCrawler->get_html_response_header()['response_code'];
            $domHtml = $HTMLCrawler->plaintext;
            $this->html_content = ''.$domHtml;
            $this->html_title   = ''.$domHtml->find('title')[0]->plaintext;
            $this->tried_times = $this->tried_times + 1;
            $this->iscompleted = $this->response_code == 200;
            $this->save();
        }
    }
}
