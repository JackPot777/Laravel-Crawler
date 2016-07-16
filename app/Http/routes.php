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
    /*--- Crawl Jobs CRUD--*/
    Route::get('/job/create','Crawler\CrawlerController@getCreateJob');
    Route::post('/job/create','Crawler\CrawlerController@postCreateJob');
    Route::get('/job/list/','Crawler\CrawlerController@getListJobs');
    Route::get('/job/list/{status}','Crawler\CrawlerController@getListJobs');
    Route::get('/job/trashbin','Crawler\CrawlerController@getDeletedJobs');
    Route::get('/job/softdelete/{crawleeResultId}','Crawler\CrawlerController@SoftDeleteCrawlee');
    Route::get('/job/forcedelete/{crawleeResultId}','Crawler\CrawlerController@ForceDeleteCrawlee');
});
