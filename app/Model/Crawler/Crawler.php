<?php

namespace App\Model\Crawler;

use App\Utility\Thread;
use App\Utility\Utility;
use App\Model\Crawler\AsyncCrawler;
use Illuminate\Database\Eloquent\Model;

class Crawler extends Model
{
    /**
     * Crawler database table name.
     *
     * @var string
     */
    protected $table = 'crawlers';

    /**
     * Fillable database field in mass-assgin.
     *
     * @var array[string]
     */
    protected $fillable = ['name','desc','maxinstances','interval'];

    /**
     * Get Current Activated Crawlers Id, for anti-multi-started Crawlers.
     *
     * @var array[int]
     */
    public static $activatedCrawlersId = [];

    /**
     * Get a belonged job.
     *
     * @return App\Model\Crawler\Job $job job data
     */
    public function job()
    {
        return $this->belongsTo('App\Model\Crawler\Job','id','crawler_id');
    }

    /**
     * Return crawler is removable , cannot have job or isn't activated.
     * 
     * @return boolean isRemoveable of the crawler
     */
    public function isRemovable(){
        return $this->job()->first() == null;
    }

    /**
     * Start crawler to crawl un-completed jobs.
     *
     * @return \Symfony\Component\Console\Output\ConsoleOutput $ut Crawler Log Output
     */
    public function listen()
    {
        $ut = new Utility();
        if (!$this->isactivated) return false;
        if (!Thread::isAvailable())
        {
            $ut->info('Thread is not supported.');
            exit(0);
        }
        $ut->info ('#' . $this->id . ' Crawler - ' . $this->name . ' : Start listening');
        Crawler::$activatedCrawlersId[] = $this->id;
        $crawlJobs = $this->job()->first()->crawlJobs()->where('iscompleted',0)->orderBy('id','asc')->get();
        $ttlCrawlJobs = $this->job()->first()->crawlJobs()->count();
        $ut->info ('#' . $this->id . ' Crawler - ' . $this->name . ' : Uncompleted Jobs '. count($crawlJobs) . '/' . ' Completed Jobs ' . $ttlCrawlJobs );

        // Crawler Initiation
        $asyncCrawlers = [];
        for ( $thread = 0 ; $thread < $this->maxinstances && count($crawlJobs) > 0;$thread++)
        {
            $asyncCrawlers[] = new AsyncCrawler($crawlJobs->shift());
            $ut->info ('#' . $this->id . ' Crawler - ' . $this->name . ' : ' . ($thread+1) . '/' . $this->maxinstances . ' Async Crawler initialized.');
        }
        foreach ($asyncCrawlers as $thread=>&$asyncCrawler)
        {
            $asyncCrawler->start();
            $ut->info ('#' . $this->id . ' Crawler - ' . $this->name . ' : ' . ($thread+1) . '/' . $this->maxinstances . ' Async Crawler started.');
        }
        sleep($this->interval);

        // Crawler Activaction & Completion Loop Check
        $isActivated= true;
        $crawlJobsLeft = count($crawlJobs);
        while ($isActivated && $crawlJobsLeft > 0) {
            foreach ($asyncCrawlers as $thread=>&$asyncCrawler)
            {
                if (!$asyncCrawler->isAlive())
                {
                    $ut->info ('#' . $this->id . ' Crawler - ' . $this->name . ' : ' . ($thread+1) . '/' . $this->maxinstances . ' Async Crawler Completed.');
                    if (count($crawlJobs) == 0)
                    {
                        unset($asyncCrawlers[$thread]);
                        $ut->info ('#' . $this->id . ' Crawler - ' . $this->name . ' : ' . ($thread+1) . '/' . $this->maxinstances . ' Async Crawler destroyed.');
                    } else {
                        unset($asyncCrawlers[$thread]);
                        $nAsyncCrawler = new AsyncCrawler($crawlJobs->shift());
                        $asyncCrawlers[$thread] = $nAsyncCrawler;
                        $nAsyncCrawler->start();
                        $ut->info ('#' . $this->id . ' Crawler - ' . $this->name . ' : ' . ($thread+1) . '/' . $this->maxinstances . ' Async Crawler assigned new job and started.');
                    }
                }
                sleep($this->interval);
            }
            $isActivated= Crawler::find($this->id)->isactivated;
            $crawlJobsLeft= count($crawlJobs);
            $ut->info('CrawlJobs Left : ' . $crawlJobsLeft);
        }

        //Crawler Completion
        $j = $this->job()->first();
        $j->status = 'Completed';
        $j->completed_datetime = \Carbon\Carbon::now();
        $j->save();
        $ut->info ('#' . $this->id . ' Crawler - ' . $this->name . ' : ' . 'Completed crawling.');
        $this->isactivated = false;
        foreach (Crawler::$activatedCrawlersId as $key=>$activatedCrawlerId)
        {
            if ($activatedCrawlerId == $this->id)
            {
                unset (Crawler::$activatedCrawlersId[$key]);
            }
        }
        $this->save();
        $ut->info ('#' . $this->id . ' Crawler - ' . $this->name . ' : ' . 'Destroyed.');
    }
}
