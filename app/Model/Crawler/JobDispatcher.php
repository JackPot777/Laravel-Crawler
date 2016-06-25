<?php
namespace App\Model\Crawler;

use App\Model\Crawler\Job;
use App\Model\Crawler\AsyncCrawler;
use App\Model\Crawler\Crawler;

class JobDispatcher
{
	protected $asyncCrawlers = [];
	protected static $instance = null;
	protected function __construct(){}
	protected function __clone(){}
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

	public function getAsyncCrawlers()
	{
		return static::$instance->asyncCrawlers;
	}

	public function addAsyncCrawler(AsyncCrawler $asyncCrawler)
	{
		return static::$instance->asyncCrawlers[] = $asyncCrawler;
	}

}
