<?php

namespace App\Http\Controllers\Crawler;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Crawler\Job;
use App\Model\Crawler\CrawlJob;
use App\Model\Crawler\Extraction;
use App\Model\Crawler\ExtractionResult;

use Symfony\Component\DomCrawler\Crawler as SymDomCrawler;

use Validator;

use Response;

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
     * @param  \illuminate\http\request  $request
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
     * Test the Rules and return JSON of 10 random entries
     * 
     * @param  \illuminate\http\request  $request
     * @return JSON
     */
    public function test(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'job_id' => 'required|exists:jobs,id',
            'type'=>'required|in:css-selector,regex',
            'rule'=>'required'
            ]);
        if ($validator->fails()) {
            return $validator->errors();
        }  

        // Random Take 10 Entries
        $crawlJobs = Job::find($request->get('job_id'))->crawlJobs()->orderByRaw("RAND()")->take(10)->get();
        $ret = [];

        if ($request->get('type') == 'css-selector') {
            foreach ($crawlJobs as $crawlJob){
                $res = new SymDomCrawler();
                $res->addHtmlContent((string) $crawlJob->html_content);

                $extractions = [];
                $res->filter($request->get('rule'))
                ->each(function ($node) use (&$extractions){
                    $extractions[] = $node->text();
                });

                $ret[] = [
                'crawl_jobs' => [
                'id' => $crawlJob->id,
                'response_code' => $crawlJob->response_code,
                ],
                'extractions' => $extractions
                ]; 
            }
        } else if($request->get('type') == 'regex'){
            foreach ($crawlJobs as $crawlJob){

                $extractions = [];

                try {
                    preg_match_all($request->get('rule'), $crawlJob->html_content, $extractions);
                }catch(\Exception $e){
                    $extractions[] = $e->getMessage();
                }

                $ret[] = [
                'crawl_jobs' => [
                'id' => $crawlJob->id,
                'response_code' => $crawlJob->  response_code,
                ],
                'extractions' => $extractions
                ]; 
            }
        }

        return Response::json($ret);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $extraction = Extraction::find($id);

        $crawlJobs = $extraction->job()->first()->crawlJobs()->get();
        $ret = [];

        if ($extraction->type == 'css-selector') {
            foreach ($crawlJobs as $crawlJob){
                $res = new SymDomCrawler();
                $res->addHtmlContent((string) $crawlJob->html_content);

                $extractions = [];
                $res->filter($extraction->rule)
                ->each(function ($node) use (&$extractions){
                    $extractions[] = $node->text();
                });

                $ret[] = [
                'crawl_jobs' => [
                'id' => $crawlJob->id,
                'response_code' => $crawlJob->response_code,
                ],
                'extractions' => $extractions
                ]; 
            }
        } else if($extraction->type == 'regex'){
            foreach ($crawlJobs as $crawlJob){

                $extractions = [];

                try {
                    preg_match_all($extraction->rule, $crawlJob->html_content, $extractions);
                }catch(\Exception $e){
                    $extractions[] = $e->getMessage();
                }

                $ret[] = [
                'crawl_jobs' => [
                'id' => $crawlJob->id,
                'response_code' => $crawlJob->  response_code,
                ],
                'extractions' => $extractions
                ]; 
            }
        }

        return Response::json($ret);
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
        Extraction::find($id)->delete();

        return redirect('/extractions');
    }
}
