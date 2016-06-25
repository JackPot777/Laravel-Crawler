<?php

namespace App\Model\Crawler;

use App\Model\Crawler\Job;

class AsyncCrawler extends Thread
{
	protected $job;

	public function setJob(Job $job)
	{
		$this->job = $job;
	}

	public function run()
	{
		$this->job->crawl();
	}
}
