<?php

namespace App\Model\Crawler;

use App\Utility;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * Job database table name.
     *
     * @var string
     */
    protected $table='jobs';

    /**
     * Fillable database field in mass-assgin.
     *
     * @var array[string]
     */
    protected $fillable = ['name','status','scheduled_datetime','crawler_id','url_id'];

    /**
     * Get a handling Crawler.
     *
     * @return App\Model\Crawler\Crawler
     */
    public function crawler()
    {
        return $this->belongsTo('App\Model\Crawler\Crawler','crawler_id','id');
    }

    /**
     * Get a url structure.
     *
     * @return App\Model\Crawler\Url
     */
    public function url()
    {
        return $this->belongsTo('App\Model\Crawler\Url','url_id','id');
    }

    /**
     * Get a list of crawl jobs.
     *
     * @return App\Model\Crawler\CrawlJob
     */
    public function crawlJobs()
    {
        return $this->hasMany('App\Model\Crawler\CrawlJob','job_id','id');
    }

    /**
     * Get crawler activation
     *
     * @return boolean  $isactivated
     */
    public function isActivated()
    {
        return $this->crawler()->first()->isactivated;
    }

    /**
     * Get if the job has a number of uncompleted crawljobs but already tried once or more.
     * 
     * @return boolean $isRetriable
     */
    public function isRetriable()
    {
        $isRetriable = Job::find($jobId)->crawlJobs()
        ->where('tried_times' , '>=', 1) 
        ->where('response_code','!=',200)->count() > 0;
        return $isRetriable;
    }

    /**
     * Get the total number of failed jobs.
     *
     * @return int
     */ 
    public function getNumRetriableJobs()
    {
        $num = Job::find($jobId)->crawlJobs()
        ->where('tried_times' , '>=', 1) 
        ->where('response_code','!=',200)->count();
        return $num;
    }

    /**
     * Start the crawler in data-model.
     *
     */
    public function start()
    {
        $crawler = $this->crawler()->first();
        $crawler->isactivated = true;
        $crawler->save();
    }

    /**
     * Pause the crawler in data-model.
     *
     */
    public function pause()
    {
        $crawler = $this->crawler()->first();
        $crawler->isactivated = false;
        $crawler->save();
    }

    /**
     * Generate a list of CrawlJobs in data-model.
     *
     * //TODO::data-modeling needs to setup.
     */
    private function generateCrawlJobs()
    {
        $url = $this->url()->first();
        foreach ($url->getGeneratedUrls() as $url)
        {
            $crawlJob = new CrawlJob();
            $crawlJob->url = $url;
            $crawlJob->job_id = $this->id;
            $crawlJob->save();
        }
    }

    /**
     * Save the model into database and generate CrawlJobs.
     *
     * @param array $options
     * @return bool
     */
    public function initialize(array $options = [])
    {
        $tmp = parent::save($options);
        $this->generateCrawlJobs();
        return $tmp;
    }
}
