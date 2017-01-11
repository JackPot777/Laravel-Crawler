<?php

namespace App\Model\Crawler;

use Illuminate\Database\Eloquent\Model;
use Sunra\PhpSimple\HtmlDomParser;
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
        if (!$this->iscompleted) {
        $domHtml = HtmlDomParser::file_get_html($this->url);
        $this->html_content = ''.$domHtml;
        $this->html_title   = ''.$domHtml->find('title')[0]->plaintext;
        $this->response_code = http_response_code();
        $this->tried_times = $this->tried_times + 1;
        $this->iscompleted = $this->response_code == 200;
        $this->save();
        }
    }
}
