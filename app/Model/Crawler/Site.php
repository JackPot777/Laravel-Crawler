<?php

namespace App\Model\Crawler;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use SoftDeletes;

    /**
     * Site table in database.
     *
     * @var string
     */
    protected $table = 'sites';

    /**
     * Database table fillables for mass-assignment.
     *
     * @var array[string]
     */
    protected $fillable = ['name','root_url','desc'];

    /**
     * Set deleted_at field for SoftDeletion.
     *
     * @var string  $date   database field name
     */
    protected $date = 'deleted_at';

    /**
     * Url structures of Site.
     *
     * @return App\Model\Crawler\Url
     */
    public function urls()
    {
        return $this->hasMany('App\Model\Crawler\Url','site_id','id');
    }

    /**
     * Site data-model deletion.
     *
     * @return boolean
     */
    public function delete()
    {
        if ($this->isActivated())
        {
            return false;
        }
        foreach($this->urls as $url)
        {
            $url->delete();
        }
        return parent::delete();
    }

    /**
     * Get if Site has jobs.
     *
     * @return boolean
     */
    public function isActivated()
    {
        foreach ($this->urls as $url)
        {
            if ($url->isActivated())
            {
                return true;
            }
        }
        return false;
    }
}
