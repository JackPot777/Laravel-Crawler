<?php

namespace App\Model\Crawler;

use App\Utility\Thread;
use App\Model\Crawler\AsyncCrawler;
use Illuminate\Database\Eloquent\Model;

class Crawler extends Model
{
    protected $table = 'crawlers';
    protected $fillable = ['name','desc','maxinstances'];

    public static $activatedCrawlersId = [];

    public function job()
    {
        return $this->belongsTo('App\Model\Crawler\Job','id','crawler_id');
    }
    public function listen()
    {
        if (!$this->isactivated) return false;
        //$this->isactivated = true;
        //$this->save();
        if (!Thread::isAvailable())
        {
            $this->info ('Thread is not supported.');
        }
        $crawlJobs = $this->job()->first()->crawlJobs()->where('iscompleted',0)->orderBy('id','asc')->get();
        $asyncCrawlers = [];
        for ( $i = 0 ; $i < $this->maxinstances && count($crawlJobs) > 0;$i++)
        {
            $asyncCrawlers[] = new AsyncCrawler($crawlJobs->shift());
        }
        foreach ($asyncCrawlers as $ac)
        {
            $ac->start();
        }

        foreach ($asyncCrawlers as $thread=>$ac)
        {
            if (!$ac->isAlive())
            {
                if (count($crawlJobs) == 0)
                {
                    unset($asyncCrawler[$thread]);
                }else
                {
                    $ac->setCrawlJob($crawlJobs->shift());
                    $ac->start();
                }
            }
            sleep(1);
        }
        $j = $this->job()->first();
        $j->status = 'Completed';
        $j->save();
        $this->isactivated = false;
        $this->save();
    }
	private function info(string $str)
	{
		$output = new \Symfony\Component\Console\Output\ConsoleOutput();
		$output->writeln('<info>'.$str.'</info>');
	}
}
