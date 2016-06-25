<?php

namespace App\Http\Controllers\Crawler;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Crawler\Crawler;
use App\Model\Crawler\Job;
use App\Model\Crawler\Url;
class CrawlerController extends Controller
{
    /**
     * Create an crawler.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreateCrawler()
    {
        return view('pages.crawler.create');
    }

    /**
     * Post an request to create an crawler.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreateCrawler(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:5|max:255',
            'desc' => 'required|min:5|max:255',
            'maxinstances' => 'required|numeric|min:1|max:100',
        ]);
        if ($validator->fails())
        {
            return redirect('/crawler/create')->withErrors($validator)->withInput();
        }
        $crawler = new Crawler($request->all());
        $crawler->save();
        return redirect('/crawler/list');
    }

    /**
     * Show all crawler entries.
     *
     * @return \Illuminate\Http\Response
     */
    public function getListCrawler()
    {
        $pass['crawlers'] = Crawler::paginate();
        $pass['lastCrawler'] = Crawler::orderBy('created_at','desc')->first();
        return view('pages.crawler.list',$pass);
    }

    /**
     * Create new job.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreateJob()
    {
        $pass['crawlers'] = Crawler::where('isactivated',false)->get();
        $pass['urls'] = Url::get();
        return view('pages.job.create',$pass);
    }

    /**
     * Post an request to create an crawler.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreateJob(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:5|max:255',
            'scheduled_datetime' => 'date',
            'crawler_id' => 'required|',
        ]);
        $validator->after(function($validator) use ($request)
        {
            $crawler_id  = $request->crawler_id;
            $crawler = Crawler::find($crawler_id);
            if ($crawler->isactivated)
            {
                $validator->errors()->add('crawler_id','The crawler is in use. Please choose another one.');
            }

        });
        if ($validator->fails())
        {
            return redirect('/job/create')->withErrors($validator)->withInput();
        }
        $job = new Job($request->all());
        $job->save();
        return redirect('/job/list');
    }

    public function getListJobs(string $status=null)
    {
        switch ($status){
        case 'tobedone':
            $pass['jobs'] = Job::where('status','ToBeDone')->paginate();
            break;
        case 'scheduled':
            $pass['jobs'] = Job::where('status','Scheduled')->paginate();
            break;
        case 'completed':
            $pass['jobs'] = Job::where('status','Completed')->paginate();
            break;
        case 'all':
        default:
            $pass['jobs'] = Job::paginate();
        }
        $pass['last'] = Job::orderBy('updated_at','desc')->first();
        return view('pages.job.list',$pass);
    }

}
