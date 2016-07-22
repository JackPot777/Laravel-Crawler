<?php
namespace App\Model\Crawler;

use Carbon\Carbon;
use App\Utility\Utility;
use App\Model\Crawler\Crawler;

class DaemonDispatcher
{
    /**
     * Singleton Instance.
     *
     * @var DaemonDispatcher
     */
    protected static $instance = null;

    /**
     * Disable Constructor.
     *
     */
    protected function __construct(){}

    /**
     * Disable Clone.
     *
     */
    protected function __clone(){}

    /**
     * Disable Serialization.
     *
     */
    protected function __wakeup()
    {
        throw new Exception ('Cannot unserialize singleton.');
    }

    /**
     * Job Dispatcher Instance.
     *
     * @return static::$instance
     */
    public static function getInstance()
    {
        if (static::$instance === null)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * Start to listen and control the Crawlers.
     *
     */
    public function listen()
    {
        $ut = new Utility();
        $ut->info ('Daemon Dispatcher started to listen.');
        while (true)
        {
            $crawlers = Crawler::where('isactivated',1)->get();
            if (count($crawlers) > 0 )
            {
                $ut->info (count($crawlers) .' crawlers activated.');
            }
            foreach ($crawlers as $crawler)
            {
                if (!in_array($crawler->id,Crawler::$activatedCrawlersId))
                {
                    $ut->info ('Activating #' . $crawler->id . ' Crawler');
                    $crawler->listen();
                }
                sleep(1);
            }
            sleep(1);
        }
    }
}
