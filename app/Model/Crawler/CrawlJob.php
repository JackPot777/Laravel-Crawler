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

    public function crawl()
    {
        $domHtml = HtmlDomParser::file_get_html($this->url);
        $this->html_content = ''.$dom;
        $this->html_title 	= ''.$dom->find('title')[0]->plaintext;
        $this->iscompleted = true;
        $this->save();
    }

}
