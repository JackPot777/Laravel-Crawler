<?php

namespace App\Model\Crawler;

use \Exception;
use App\Utility\Utility;
use App\Model\Crawler\Crawlee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Url extends Model
{
    use SoftDeletes;

    /**
     * Database table.
     *
     * @var string  $table
     */
    protected $table = 'urls';

    /**
     * SoftDelete database column.
     *
     * @var string  $date   Database Column.
     */
    protected $date = 'deleted_at';

    /**
     * Database fillables for mass-assignment.
     *
     * @var array[string] $fillable     Database Columns.
     */
    protected $fillable =['name','original_url','settings','site_id'];

    /**
     * Crawlee Generator
     *
     * Rephase the settings and generate all of the crawlee url.
     * @return array $urls
     */
    public function getGeneratedUrls()
    {
        $urls = [];
        if ($this->settings == null)
        {
            $urls[] = $this->original_url;
        }else{
            $crawleeSettings = json_decode($this->settings,true);
            //data array generation
            $paramCombos = [];
            $y=0;
            $gloParam = [];
            foreach ($crawleeSettings as $paramName => $param)
            {
                $gloParam[$y]['name'] = $paramName;
                if ($param['type'] == 'number')
                {
                    for($i=$param['start'];$i<=$param['end'];$i++)
                    {
                        $paramCombos[$y][] = (int)$i;
                    }
                }else if ($param['type'] == 'string'){
                    $paramCombos[$y] = $param['combination'];
                }
                $y++;
            }
            unset($y);
            $paramCombos = Utility::generateCombination($paramCombos);
            foreach ($paramCombos as $paramCombo)
            {
                $i=0;
                $newUrl = $this->original_url;
                foreach ($paramCombo as $param)
                {
                    $newUrl = str_replace('@'.$gloParam[$i]['name'],$param,$newUrl);
                    $i++;
                }
                unset($i);
                $urls[] = $newUrl;
            }
        }
        return $urls;
    }

    /**
     * Get if the Url has jobs.
     *
     * @return boolean
     */
    public function isActivated()
    {
        return $this->jobs()->count() > 0;
    }

    /**
     * Url Deletion.
     *
     * @return boolean
     *
     * @throws Exception
     */
    public function delete()
    {
        if ($this->isActivated())
        {
            throw new Exception('The url has job(s), cannot be deleted.');
            return ;
        }
        return parent::delete();
    }

    /**
     * Get jobs that belong to the url.
     *
     * @return App\Model\Crawler\Job
     */
    public function jobs()
    {
        return $this->hasMany('App\Model\Crawler\Job','url_id','id');
    }

    /**
     * Get the the parent site.
     *
     * @return App\Model\Crawler\Job
     */
    public function site()
    {
        return $this->belongsTo('App\Model\Crawler\Site','site_id','id');
    }
}
