<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/user','Auth\AuthController@getLogin');
Route::get('/','Auth\AuthController@getLogin');

Route::get('/user/login','Auth\AuthController@getLogin');
Route::post('/user/login','Auth\AuthController@postLogin');

Route::get('/user/logout','Auth\AuthController@getLogout');

Route::get('/user/register','Auth\AuthController@getRegister');
Route::post('/user/register','Auth\AuthController@postRegister');

/*---Objectives Management---*/
Route::group(['middleware'=>'auth'], function (){
    Route::get('/dashboard','Crawler\DashboardController@getIndex');
    /*--- Site CRUD ---*/
    Route::get('/objectives/site','Crawler\ObjectiveController@getListSites');
    Route::get('/objectives/site/list','Crawler\ObjectiveController@getListSites');
    Route::get('/objectives/site/get','Crawler\ObjectiveController@getListSites');
    Route::get('/objectives/site/get/{siteId}','Crawler\ObjectiveController@getSite');
    Route::get('/objectives/site/create','Crawler\ObjectiveController@getCreateSite');
    Route::post('/objectives/site/create','Crawler\ObjectiveController@postCreateSite');
    Route::get('/objectives/site/edit/{siteId}','Crawler\ObjectiveController@getEditSite');
    Route::post('/objectives/site/edit/{siteId}','Crawler\ObjectiveController@postEditSite');
    Route::get('/objectives/site/trashbin','Crawler\ObjectiveController@getDeletedSites');
    Route::get('/objectives/site/softdelete/{siteId}','Crawler\ObjectiveController@softDeleteSite');
    Route::get('/objectives/site/forcedelete/{siteId}','Crawler\ObjectiveController@forceDeleteSite');
    Route::get('/objectives/site/restore/{siteId}','Crawler\ObjectiveController@restore');
    Route::get('/objectives/ajax/site/get/{siteId}','Crawler\ObjectiveController@getSiteJSON');
    /*--- URL CRUD ---*/
    Route::get('/objectives/url/list','Crawler\ObjectiveController@getUrls');
    Route::get('/objectives/url/get/{urlId}','Crawler\ObjectiveController@getUrl');
    Route::get('/objectives/url/generate/{urlId}','Crawler\ObjectiveController@getGeneratedUrls');
    Route::get('/objectives/url/create','Crawler\ObjectiveController@getCreateUrl');
    Route::get('/objectives/url/create/{sideId}','Crawler\ObjectiveController@getCreateUrl');
    Route::post('/objectives/url/create/','Crawler\ObjectiveController@postCreateUrl');
    Route::get('/objectives/url/trashbin','Crawler\ObjectiveController@getDeletedUrls');
    Route::get('/objectives/url/restore/{urlId}','Crawler\ObjectiveController@restoreUrl');
    Route::get('/objectives/url/softdelete/{urlId}','Crawler\ObjectiveController@softDeleteUrl');
    Route::get('/objectives/url/forcedelete/{urlId}','Crawler\ObjectiveController@forceDeleteUrl');
    /*--- Crawlee CRUD ---*/
    Route::get('/objectives/crawlee/list','Crawler\ObjectiveController@getCrawlees');
    Route::get('/objectives/crawlee/get/{crawleeId}','Crawler\ObjectiveController@getCrawlee');
    Route::get('/objectives/crawlee/trashbin','Crawler\ObjectiveController@getDeletedCrawlees');
    Route::get('/objectives/crawlee/softdelete/{crawleeId}','Crawler\ObjectiveController@softDeleteCrawlee');
    Route::get('/objectives/crawlee/forcedelete/{crawleeId}','Crawler\ObjectiveController@forceDeleteCrawlee');
    /*--- Crawler Settings ---*/
    Route::get('/crawler/create','Crawler\CrawlerController@getCreateCrawler');
    Route::post('/crawler/create','Crawler\CrawlerController@postCreateCrawler');
    Route::get('/crawler/list','Crawler\CrawlerController@getListCrawler');
    Route::post('/crawler/list','Crawler\CrawlerController@postListCrawler');
    Route::get('/crawler/delete/{id}','Crawler\CrawlerController@getRemoveCrawler');
    /*--- Jobs CRUD--*/
    Route::get('/job/create','Crawler\CrawlerController@getCreateJob');
    Route::post('/job/create','Crawler\CrawlerController@postCreateJob');
    Route::get('/job/list/','Crawler\CrawlerController@getListJobs');
    Route::get('/job/get/{jobId}','Crawler\CrawlerController@getJob');
    Route::get('/job/list/{status}','Crawler\CrawlerController@getListJobs');
    Route::get('/job/start/{jobId}','Crawler\CrawlerController@getStartJob');
    Route::get('/job/pause/{jobId}','Crawler\CrawlerController@getPauseJob');
    Route::get('/job/delete/{jobId}','Crawler\CrawlerController@getDeleteJob');
    /*--- Job Result Extraction CRUD--*/
    Route::get('/extractions','Crawler\ExtractionController@index');
    Route::get('/extractions/create','Crawler\ExtractionController@create');
    Route::post('/extractions/store','Crawler\ExtractionController@store');
    Route::post('/extractions/test','Crawler\ExtractionController@test');
    Route::get('/extractions/show/{id}','Crawler\ExtractionController@show');
    Route::get('/extractions/delete/{id}','Crawler\ExtractionController@destroy');
    /*--- Crawl Jobs CRUD --*/
    Route::get('/crawljob/list','Crawler\CrawlerController@getCrawlJobs');
    Route::get('/crawljob/get/{jobId}','Crawler\CrawlerController@getCrawlJob');
    Route::get('/crawljob/rawhtml/{crawlJobId}','Crawler\CrawlerController@getCrawlJobHtml');
});
