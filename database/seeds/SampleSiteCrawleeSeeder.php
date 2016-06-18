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
        $site['name']       = 'Laravel Offical Website';
        $site['desc']       = 'Laravel offical website. You know what it is.';
        $site['root_url']   = 'http://www.laravel.com';
        $site->save();

        $url = new Url();
        $url['name']         = 'Prologue(5.0-5.2) : Release Notes, Upgrade Guide, Contribution Guide';
        $url['original_url'] = 'http://laravel.com/docsi/5.@param0/@param1';
        $url['site_id']     = $site['id'];
		$url['type'] 		 = 'Simple_Custom';
		$url['settings']	 = '{ "type": "Simple_Custom", "params": [ { "name": "@param0", "type": "number", "start": 0, "end": 2 }, { "name": "@param1", "type": "string", "combination": [ "releases", "upgrade", "contributions" ] } ] }';
        $url->save();

        $url = new Url();
        $url['name']         = 'Home Page';
        $url['original_url'] = 'http://laravel.com';
        $url['site_id']     = $site['id'];
		$url['type'] 		 = 'Simple';
		$url['settings']	 = '{ "type":"Simple"  }';
        $url->save();

    }
}
