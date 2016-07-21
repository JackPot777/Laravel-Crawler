<?php
namespace App;

use App\Model\Crawler\Job;
use App\Model\Crawler\CrawlJob;


class CrawlDaemon{
    protected $crawlJobs;
    protected $job;
    protected $interval;

    public function __construct(CrawlJob $crawlJobs, Job $job, int $interval)
    {
        $this->crawlJobs = $crawlJobs;
        $this->job       = $job;
        $this->interval  = $interval;
    }
}
