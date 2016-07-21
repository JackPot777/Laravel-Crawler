<?php

namespace App\Model\Crawler;

use App\Utility\Thread;
use App\Model\Crawler\CrawlJob;

class AsyncCrawler extends Thread
{
	protected 	$crawlJob;

	public function __construct(CrawlJob $crawlJob)
	{
		$this->crawlJob = $crawlJob;
		parent::__construct($crawlJob);
	}

	public function setCrawlJob(CrawlJob $crawlJob)
	{
		$this->crawlJob = $crawlJob;
	}

	public function start()
	{
		$pid = @pcntl_fork();
		if ( $pid == -1 ) {
			$this->fatalError(Thread::COULD_NOT_FORK);
		}
		if ( $pid ) {
			// parent
			$this->_pid = $pid;
		} else {
			// child
			pcntl_signal(SIGTERM, array( $this, 'handleSignal' ));
			$this->info ('#' . $this->crawlJob->id . ' ' . ' - Start Crawling : '. $this->crawlJob->url);
			$this->crawlJob->crawl();
			exit( 0 );
		}
	}
	private function info(string $str)
	{
		$output = new \Symfony\Component\Console\Output\ConsoleOutput();
		$output->writeln('<info>'.$str.'</info>');
	}

}
