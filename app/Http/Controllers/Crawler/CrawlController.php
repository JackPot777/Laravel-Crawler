<?php

namespace App\Http\Controllers\Crawler;

use Validator;

use Illuminate\Http\Request;
use App\Model\Crawler\Site;
use App\Model\Crawler\Url;
use App\Model\Crawler\Crawlee;
use App\Model\Crawler\CrawleeResult;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class CrawlController extends Controller
{
    public function getIndex()
    {
        return Site::get();
    }

    public function getListSites()
    {
        return Site::get();
    }

    public function getSite(int $siteId)
    {
        return Site::find($siteId);
    }

    public function getCreateSite()
    {
        return view('site.create');
    }

    public function postCreateSite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:10|max:255',
            'desc' => 'required|min:10|max:2048',
            'root_url' => 'required|min:3|max:2028'
        ]);
        if ($validator->fails()){
            return redirect('/crawler/site/create')->withErrors($validator)->withInput();
        }
        $site = new Site($request->all());
        return redirect('/crawler/site/get/'.$site->id);
    }

    public function getEditSite(int $siteId){
        return Site::find($siteId);
    }

    public function postEditSite(Request $request,int $siteId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:10|max:255',
            'desc' => 'required|min:10|max:2048',
            'root_url' => 'required|min:3|max:2028'
        ]);
        if ($validator->fails()){
            return redirect('/crawler/site/edit')->withErrors($validator)->withInput();
        }
        $site = new Site($request->all());
        return redirect('/crawler/site/get/'.$site->id);
    }

    public function getDeleteSite(int $siteId)
    {
        $site = Site::find($siteId)->delete();
        return redirect('/crawler/site');
    }
}











































































