<?php

use Illuminate\Database\Seeder;
use App\Model\Crawler\Site;
use App\Model\System\SystemSetting;
use App\Model\Crawler\Url;
use App\Model\Crawler\Crawler;
use App\User;

class SampleSiteSeeder extends Seeder
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
        $url['name']        = 'Prologue(5.0-5.2) : Release Notes, Upgrade Guide, Contribution Guide';
        $url['original_url']= 'http://laravel.com/docs/5.@param0/@param1';
        $url['site_id']     = $site['id'];
        $url['settings']    = '{"param0":{"type":"number","start":"0","end":"2"},"param1":{"type":"string","combination":["releases","upgrade","contributions"]}}';
        $url->save();

        $url = new Url();
        $url['name']        = 'Home Page';
        $url['original_url']= 'http://laravel.com';
        $url['site_id']     = $site['id'];
        $url->save();

        $crawler = new Crawler();
        $crawler['name']    = 'Laravel Crawler';
        $crawler['desc']    = 'Crawl 5 pages at the sametime.';
        $crawler['maxinstances'] = 5;
        $crawler->save();

        $user               = new User();
        $user['name']       = 'admin';
        $user['email']      = 'admin@admin.com';
        $user['password']   = bcrypt('admin');
        $user->save();
        
        $system             = new SystemSetting();
        $system['allowregister'] = false;
        $system->save();

    }
}
