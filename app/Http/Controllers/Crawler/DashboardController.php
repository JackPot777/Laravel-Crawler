<?php

namespace App\Http\Controllers\Crawler;

use Illuminate\Http\Request;

use App\Model\Crawler\Site;
use App\Model\Crawler\Url;
use App\Model\Crawler\Crawlee;
use App\Model\Crawler\CrawleeResult;

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
        $pass['numSites']           = Site::count();
        $pass['lastSite']           = Site::orderBy('created_at','desc')->first();
        $pass['numUrls']            = Url::count();
        $pass['lastUrl']            = Url::orderBy('created_at','desc')->first();
        $pass['numTtlCrawlees']     = Crawlee::count();
        $pass['lastCreatedCrawlees']= Crawlee::orderBy('created_at','desc')->first();
        $pass['numCreatedUrlCrawlees']= Crawlee::where('url_id',Crawlee::orderBy('created_at','desc')->first()->url()->first()->id)->count();
        $pass['numToBeDoneCrawlJobs']  = CrawleeResult::where('status','ToBeDone')->count();
        $pass['lastCreatedTBDCrawlJobs']  = CrawleeResult::where('status','ToBeDone')->orderBy('created_at','desc')->get();
        $pass['numProcessingCrawlJobs']  = CrawleeResult::where('status','Processing')->count();
        $pass['lastCreatedProcessingCrawlJobs']  = CrawleeResult::where('status','Processing')->orderBy('created_at','desc')->get();
        $pass['numCompletedCrawlJobs']  = CrawleeResult::where('status','Completed')->count();
        $pass['lastCreatedCompletedCrawlJobs']  = CrawleeResult::where('status','Completed')->orderBy('created_at','desc')->get();
        return view('pages.indexdashboard',$pass);
    }

}
