<?php

use Illuminate\Database\Seeder;
use App\Model\Crawler\Site;
use App\Model\Crawler\Url;
use App\Model\Crawler\Crawlee;

class SampleSiteCrawleeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $site               = new Site();
        $site['name']       = 'Sample Site';
        $site['desc']       = 'The biggest discussion channel in the world.';
        $site['root_url']   = 'http://localhost';
        $site->save();

        $url = new Url();
        $url['name']         = 'Sample Crawl';
        $url['original_url'] = 'http://localhost/jklashdjkahqghjkq!asdjkhkjH$%TYUIPO!#%^!(Y!&(^YUQIY!#^';
        $url['site_id']     = $site['id'];
		$url['type'] 		 = 'Simple';
		$url['settings']	 = '{ "type": "Simple", "isCustomized": false }';
        $url->save();

        $url = new Url();
        $url['name']         = 'Custom Crawl';
        $url['original_url'] = 'http://localhost/s/@param0/g/@param1';
        $url['site_id']     = $site['id'];
		$url['type'] 		 = 'Simple_Custom';
		$url['settings']	 = '{ "type": "Simple_Custom", "isCustomized": true, "params": [ { "name": "@param0", "type": "number", "start": 1, "end":99 }, { "name": "@param1", "type": "string", "combination": [ "new", "old", "outdated", "classic" ] } ] }';
        $url->save();

    }
}
