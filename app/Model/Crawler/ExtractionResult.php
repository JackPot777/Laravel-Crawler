<?php

namespace App\Extraction\Crawler;

use Illuminate\Database\Eloquent\Model;

class ExtractionResult extends Model
{
    /**
     * Database table name.
     *
     * @var string
     */
    protected $table = 'extraction_results';

    /**
     * Fillable database field in mass-assgin.
     *
     * @var array[string]
     */
    protected $fillable = ['extraction_id', ' value'];

    /**
     * Get a belonged extraction.
     *
     * @return App\Model\Extraction
     */
    public function extraction()
    {
        return $this->belongsTo('App\Model\Extraction','extraction_id','id');
    }
}
