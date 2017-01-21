<?php

namespace App\Model\Crawler;

use Illuminate\Database\Eloquent\Model;

class Extraction extends Model
{
    /**
     * Database table name.
     *
     * @var string
     */
    protected $table = 'extractions';

    /**
     * Fillable database field in mass-assgin.
     *
     * @var array[string]
     */
    protected $fillable = ['crawlers_id','name','description','rule'];

    /**
     * Get a belonged job.
     *
     * @return App\Model\Crawler\Job
     */
    public function job()
    {
        return $this->belongsTo('App\Model\Crawler\Job','id','job_id');
    }

    /**
     * Get a list of extraction results.
     *
     * @return App\Model\ExtractionResult
     */
    public function extractionResults()
    {
        return $this->belongsTo('App\Model\Crawler\ExtractionResult','id','extraction_id');
    }
}
