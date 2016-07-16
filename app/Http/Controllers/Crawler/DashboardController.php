<?php

namespace App\Http\Controllers\Crawler;

use Illuminate\Http\Request;

use App\Model\Crawler\Site;
use App\Model\Crawler\Url;
use App\Model\Crawler\Job;
use App\Model\Crawler\Crawler;
use App\Model\Crawler\CrawlJob;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Dashboard Front Page Render.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $pass['sites']['all']['num']            = Site::count();
        $pass['sites']['last']                  = Site::orderBy('updated_at','desc')->first();
        $pass['urls']['all']['num']             = Url::count();
        $pass['urls']['last']                   = Url::orderBy('updated_at','desc')->first();
        $pass['crawlers']['all']['num']         = Crawler::count();
        $pass['crawlers']['activated']['num']   = Crawler::where('isactivated',1)->count();
        $pass['crawlers']['last']               = Crawler::orderBy('updated_at','desc')->first();
        $pass['jobs']['all']['num']             = Job::count();
        $pass['jobs']['last']                   = Job::orderBy('updated_at','desc')->first();
        $pass['jobs']['completed']['num']       = Job::where('status','Completed')->count();
        $pass['jobs']['completed']['last']      = Job::where('status','Completed')->orderBy('updated_at','desc')->first();
        $pass['jobs']['toBeDone']['num']        = Job::where('status','ToBeDone')->count();
        $pass['jobs']['toBeDone']['last']       = Job::where('status','ToBeDone')->orderBy('updated_at','desc')->first();
        $pass['jobs']['scheduled']['num']       = Job::where('status','Scheduled')->count();
        $pass['jobs']['scheduled']['last']      = Job::where('status','Scheduled')->orderBy('updated_at','desc')->first();
        return view('pages.indexdashboard',$pass);
    }

}
