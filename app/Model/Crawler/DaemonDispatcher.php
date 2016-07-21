<?php
namespace App\Model\Crawler;
use App\Model\Crawler\Crawler;
use Carbon\Carbon;
class DaemonDispatcher
{
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

	public function listen()
	{
		while (true)
		{
			$crawlers = Crawler::where('isactivated',1)->get();
			$this->info ('['.Carbon::now().']'.' ' . count($crawlers) .' Crawlers Activated');
			foreach ($crawlers as $crawler)
			{
				if (!in_array($crawler->id,Crawler::$activatedCrawlersId))
				{
					$crawler->listen();
					Crawler::$activatedCrawlersId[] = $crawler->id;
					$this->info('['.Carbon::now().']'.'#' . $crawler->id .' Crawler - Activated - Start Crawl Jobs.');
				}
			sleep(1);
			}
			sleep(1);
		}
	}

	private function info(string $str)
	{
		$output = new \Symfony\Component\Console\Output\ConsoleOutput();
		$output->writeln('<info>'.$str.'</info>');
	}
}
