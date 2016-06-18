<?php
namespace App\Model\Crawler;

use Sunra\PhpSimple\HtmlDomParser;
use Illuminate\Database\Eloquent\Model;

class CrawleeResult extends Model
{
    protected $table = 'crawlee_results';

    public function crawlee(){
        return $this->belongsTo('App\Model\Crawler\Crawlee','crawlee_id','id');
    }


    public function crawl(){
		$domHtml = HtmlDomParser::file_get_html($this->crawlee()->get()->generated_url());
		$this->html_crawl_completed_datetime = Carbon\Carbon::now();
		$this->html_content = ''.$dom;
		$this->html_title 	= ''.$dom->find('title')[0]->plaintext;
		$this->status = 'Completed';
		$this->save();
    }

}
