<?php

namespace App\Model\Crawler;

use App\Utility\Thread;
use App\Utility\Utili\Utilityy;
use App\Model\Crawler\CrawlJob;
class AsyncCrawler extends Thread
{
    /**
     * A controlled CrawlJob for the AsyncCrawler.
     *
     * @var CrawlJob
     */
    protected   $crawlJob;

    /**
     * Construct a AsyncCrawler.
     *
     * @param CrawlJob  $crawlJob   A CrawlJob Object with completed data set(url, name, etc).
     */
    public function __construct(CrawlJob $crawlJob)
    {
        $this->crawlJob = $crawlJob;
        parent::__construct($crawlJob);
    }

    /**
     * Set a CrawlJob into AsyncCrawler.
     *
     * @param CrawlJob  $crawlJob   A Completed CrawlJob Object.
     */
    public function setCrawlJob(CrawlJob $crawlJob)
    {
        $this->crawlJob = $crawlJob;
    }

    /**
     * Start the Crawling in Multithread.
     *
     * @throws \Exception Thread::COULD_NOT_FORK|Thread::FUNCTION_NOT_CALLABLE
     */
    public function start()
    {
        $pid = @pcntl_fork();
        if ( $pid == -1 )
        {
            $this->fatalError(Thread::COULD_NOT_FORK);
        }
        if ( $pid )
        {
            // Parent Process
            $this->_pid = $pid;
        } else {
            // Child Process
            pcntl_signal(SIGTERM, array( $this, 'handleSignal' ));
            $this->crawlJob->crawl();
            exit( 0 );
        }
    }
}
