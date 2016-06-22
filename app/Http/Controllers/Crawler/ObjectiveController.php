<?php

namespace App\Http\Controllers\Crawler;

use Validator;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Model\Crawler\Site;
use App\Model\Crawler\Url;
use App\Model\Crawler\Crawlee;
use App\Model\Crawler\CrawleeResult;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ObjectiveController extends Controller
{
    /**
     * Show all website entries.
     *
     * @return \Illuminate\Http\Response
     */
    public function getListSites()
    {
        $pass['sites'] = Site::paginate();
        $pass['lastSite'] = Site::orderBy('created_at','desc')->first();
        return view('pages.site.list',$pass);
    }

    /**
     * Show a website details, including Urls, Crawlees, CrawleeResults.
     *
     * @param int $siteId site id
     * @return \Illuminate\Http\Response
     */
    public function getSite(int $siteId)
    {
        return Site::find($siteId);
    }
    /**
     * Show a website details, including Urls, Crawlees, CrawleeResults.
     *
     * @param int $siteId site id
     * @return \Illuminate\Http\Response
     */
    public function getSiteJSON(int $siteId)
    {
        return response()->json(Site::find($siteId));
    }

    /**
     * Website new entry application form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreateSite()
    {
        return view('pages.site.create');
    }

    /**
     * Website new entry application post handler.
     *
     * @param Request \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function postCreateSite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:10|max:255',
            'desc' => 'required|min:10|max:2048',
            'root_url' => 'required|min:3|max:2028'
        ]);
        if ($validator->fails()){
            return redirect('/objectives/site/create')->withErrors($validator)->withInput();
        }
        $site = Site::create($request->all());
        return redirect('/objectives/site/get/'.$site->id);
    }

    public function getEditSite(int $siteId){
        $site = Site::find($siteId);
        return view('pages.site.edit',['site'=>$site]);
    }

    public function postEditSite(Request $request,int $siteId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:10|max:255',
            'desc' => 'required|min:10|max:2048',
            'root_url' => 'required|min:3|max:2028'
        ]);
        if ($validator->fails()){
            return redirect('/objectives/site/edit/'.$siteId)->withErrors($validator)->withInput();
        }else {
            $site = Site::where('id',$siteId)->first();
            if ($site != null)
            {
                $site->name = $request->name;
                $site->desc = $request->desc;
                $site->root_url =$request->root_url;
                $site->save();
                return redirect('/objectives/site/get/'.$site->id);
            }
        }
        return redirect('/objectives/site/list/');
    }

    /**
     * Website trashbin.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDeletedSites()
    {
        $pass['sites'] = Site::onlyTrashed()->paginate();
        $pass['lastSite'] = Site::onlyTrashed()->orderBy('created_at','desc')->first();
        return view('pages.site.trashbin',$pass);
    }

    /**
     * Soft delete a website.
     *
     * @param int $siteId site id
     * @return \Illuminate\Http\Response
     */
    public function softDeleteSite(int $siteId)
    {
       $deletedSite = Site::where('id',$siteId)->first()->delete();
       return redirect ('/objectives/site/trashbin');
    }


    //TODO: NEED TO TEST AFTER URL / CRAWLEE / CRAWLEE CRUD COMPLETION
    public function forceDeleteSite(int $siteId)
    {
        $deletedSite = Site::onlyTrashed()->where('id',$siteId)->first();
        //$deletedSite = Site::onlyTrashed()->where('id',$siteId)->first()->forceDelete();
        // Site 1--* URL 1--* Crawlee 1--* CrawleeResult
        $deletedSiteUrls = $deletedSite->url()->withTrashed()->get();
        $deletedSiteCrawlees = [];
        foreach ($deletedSiteUrls as $deletedSiteUrl)
        {
            $deletedSiteCrawlees[] = $deletedSiteUrl->crawlee()->withTrashed()->get();
        }
        $deletedSiteCrawleeResults = [];
        foreach ($deletedSiteCrawlees as $deletedSiteCrawlee)
        {
            $deletedSiteCrawleeResults[] = $deletedSiteCrawlee->crawleeResult()->withTrashed()->get();
        }
        foreach ($deletedSiteCrawleeResults as $deletedSiteCrawleeResult)
        {
            $deletedSiteCrawleeResult->forceDelete();
        }
        foreach ($deletedSiteCrawlees as $deletedSiteCrawlee)
        {
            $deletedSiteCrawlee->forceDelete();
        }
        foreach ($deletedSiteUrls as $deletedSiteUrl)
        {
            $deletedSiteUrl->forceDelete();
        }
        return redirect ('/objectives/site/trashbin');
    }

    /**
     * Get url creator.
     *
     * @param int $siteId optional
     * @return \Illuminate\Http\Response
     */
    public function getCreateUrl(int $siteId = null)
    {
        $pass = [];
        if ($siteId !=null )
        {
            $pass['site'] = Site::where('id',$siteId)->first();
        }
        $pass['sites'] = Site::all();
        return view('pages.url.create',$pass);
    }
    /**
     * Post Url creation.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateUrl(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_id' => 'required|exists:sites,id',
            'name' => 'required|min:10|max:255',
            'original_url' => 'required|min:10|max:2048',
            'type' => 'required|in:Simple,Simple_Custom'
        ]);
        if ($validator->fails()){
            return redirect('/objectives/url/create')->withErrors($validator)->withInput();
        }
        $url = Url::create($request->all());
        return redirect('/objectives/url/get/'.$url->id);
    }

    /**
     * Show all urls.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUrls()
    {
        $pass['urls'] = Url::paginate();
        $pass['lastUrl'] = Url::orderBy('created_at','desc')->first();
        return view('pages.url.list',$pass);
    }

    /**
     * Show an url detail.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUrl(int $urlId)
    {
        $pass['url'] = Url::withTrashed()->where('id',$urlId)->get();
        return $pass['url'];
        return view('pages.url.detail',$pass);
    }

    /**
     * Show URL trashbin.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDeletedUrls()
    {
        $pass['urls'] = Url::onlyTrashed()->paginate();
        $pass['lastUrl'] = Url::onlyTrashed()->orderBy('created_at','desc')->first();
        return view('pages.url.trashbin',$pass);
    }

    /**
     * Soft delete  an url.
     *
     * @return \Illuminate\Http\Response
     */
    public function softDeleteUrl(int $urlId)
    {
        $pass['url'] = Url::where('id',$urlId)->delete();
        return redirect('/objectives/url/trashbin');
    }

    

}
