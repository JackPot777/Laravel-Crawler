<?php

namespace App\Http\Controllers\Crawler;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Crawler\Crawler;
use App\Model\Crawler\Job;
use App\Model\Crawler\CrawlJob;
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
     * Remove a crawler by crawler_id
     *
     * @param int $id crawler_id
     * @return \Illuminate\Http\Response
     */
    public function getRemoveCrawler(int $id)
    {
        $crawler = Crawler::find($id);
        $errors = [];
        if ($crawler == null)
        {
            $errors[] = 'The crawler does not exists.';
        }else if (!$crawler->isRemovable())
        {
            $errors[] = 'The crawler is not removable due to working on a job.';
        }else {
            $crawler->forceDelete();
        }
        return redirect('/crawler/list/')->with(['errors'=>$errors]);
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
            'name' => 'required|min:3|max:255',
            'scheduled_datetime' => 'date',
            'crawler_id' => 'required|exists:crawlers,id',
        ]);
        $validator->after(function($validator) use ($request)
        {
            $crawler_id  = $request->crawler_id;
            $crawler = Crawler::find($crawler_id);
            if ($crawler==null)
            {
                $validator->errors()->add('crawler_id','The crawler is missing. Please select a new one.');
            }else if ($crawler->isactivated)
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

    /**
     * Delete a current job which is not activated.
     *
     * @param int $jobId job id
     * @return \Illuminate\Http\Response
     */
    public function getDeleteJob(int $jobId)
    {
        $job = Job::find($jobId);
        $errors = [];
        if ($job->isActivated())
        {
            $errors = ['The job is activated. Please dis-activated before delete.'];
        }else
        {
            foreach ($job->crawlJobs()->get() as $crawlJob)
            {
                $crawlJob->delete();
            }
            $job->delete();
        }
        return redirect('/job/list')->with('errors',$errors);
    }

    /**
     * Start the job.
     *
     * @param int $jobId job id
     * @return \Illuminate\Http\Response
     */
    public function getStartJob(int $jobId)
    {
        $job = Job::find($jobId);
        $errors = [];
        if ($job->crawler()->first()->isactivated)
        {
            $errors = ['The job is already activated.'];
        }else
        {
            $job->start();
        }
        return redirect('/job/get/'.$jobId)->with('errors',$errors);
    }
    /**
     * Pause the job.
     *
     * @param int $jobId job id
     * @return \Illuminate\Http\Response
     */
    public function getPauseJob(int $jobId)
    {
        $job = Job::find($jobId);
        $errors = [];
        if (!$job->crawler()->first()->isactivated)
        {
            $errors = ['The job is already deactivated.'];
        }else
        {
            $job->pause();
        }
        return redirect('/job/get/'.$jobId)->with('errors',$errors);
    }
    /**
     * List all jobs based on the status.
     *
     * @param string $status : all null tobedone scheduled completed
     * @return \Illuminate\Http\Response
     */
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
    /**
     * Get the job details.
     *
     * @param int $jobId job id.
     * @return \Illuminate\Http\Response
     */
    public function getJob(int $jobId)
    {
        $pass['job'] = Job::find($jobId);
        return view('pages.job.detail',$pass);
    }

    /**
     * List crawl jobs.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCrawlJobs()
    {
        $pass['crawlJobs'] = CrawlJob::paginate(200);
        return view('pages.crawljob.listall',$pass);
    }
    /**
     * Get crawl jobs of a job.
     *
     * @param int $jobId
     * @return \Illuminate\Http\Response
     */
    public function getCrawlJob(int $jobId)
    {
        $pass['crawlJobs'] = CrawlJob::where('job_id',$jobId)->paginate(200);
        return view('pages.crawljob.list',$pass);
    }
    /**
     * Get a crawl job html.
     *
     * @param int $crawlJobId Crawl Job Id
     * @return \Illuminate\Http\Response
     */
    public function getCrawlJobHtml(int $crawlJobId)
    {
        $crawlJob = CrawlJob::find($crawlJobId);
        if ($crawlJob != null)
        {
            $html     = $crawlJob->html_content;
            return response($html,200)->header('Content-Type','text/plain');
        }else
        {
            return redirect('/crawljob/list');
        }
    }
}
