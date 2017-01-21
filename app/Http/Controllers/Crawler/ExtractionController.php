<?php

namespace App\Http\Controllers\Crawler;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Crawler\Extraction;
use App\Model\Crawler\ExtractionResult;

use Validator;

class ExtractionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $extractions = Extraction::get();
        $lastExtraction = Extraction::orderBy('updated_at','desc')->first();
        return view('pages.extraction.index',['extractions'=>$extractions,'lastExtraction'=>$lastExtraction]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.extraction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'job_id' => 'required|exists:jobs,id',
                'type'=>'required|in:css-selector,regex',
                'rule'=>'required'
            ]);
        if ($validator->fails()) {
            return redirect('/extractions/create')->withInput()->withErrors($validator);
        } else {
            Extraction::create($request->all());
            return redirect('/extractions');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
