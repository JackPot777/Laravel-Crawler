<?php

namespace App\Model\Crawler;

use App\Utility;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table='jobs';
    protected $fillable = ['name','status','scheduled_datetime','crawler_id','url_id'];
    public function crawler()
    {
        return $this->belongsTo('App\Model\Crawler\Crawler','crawler_id','id');
    }
    public function url()
    {
        return $this->belongsTo('App\Model\Crawler\Url','url_id','id');
    }

    private function generateCrawlJobs()
    {
        $url = $this->url()->first();
        if ($this->type == 'Simple')
        {
            $crawlJob = new CrawlJob();
            $crawlJob->url = $url->original_url;
            $crawlJob->job_id = $this->id;
            $crawlJob->save();
        }else if($this->type == 'Simple_Custom')
        {
            $crawlSettings = json_decode($this->settings,true);
            $crawlJobs =  array();
            //data array generation
            $paramCombos = [];
            $y=0;
            foreach ($crawlSettings['params'] as $param)
            {
                if ($param['type'] == 'number')
                {
                    for($i=$param['start'];$i<=$param['end'];$i++)
                    {
                        $paramCombos[$y][] = $i;
                    }
                }else if ($param['type'] == 'string')
                {
                    $paramCombos[$y] = $param['combination'];
                }
                $y++;
            }
            unset($y);
            $paramCombos = Utility::generateCombination($paramCombos);
            foreach ($paramCombos as $paramCombo)
            {
                $crawlJob = new crawlJob();
                $crawlJob->url_id = $url->id;
                $crawlJob->generated_url = $this->original_url;
                $i=0;
                foreach ($paramCombo as $param)
                {
                    $crawlJob->generated_url = str_replace('@param'.$i,$param,$crawlJob->generated_url);
                    $i++;
                }
                unset($i);
                $crawlJobs[] = $crawlJob;
            }
            foreach ($crawlJobs as $crawlJob)
            {
                $crawlJob->save();
            }
        }
    }

    public function save(array $options = [])
    {
        $tmp = parent::save($options);
        $this->generateCrawlJobs();
        return $tmp;
    }


}
