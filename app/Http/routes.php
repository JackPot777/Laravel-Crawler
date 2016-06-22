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

//Route::get('/', function () {
    //return view('welcome');
//});

Route::get('/user','Auth\AuthController@getLogin');
Route::get('/','Auth\AuthController@getLogin');

Route::get('/user/login','Auth\AuthController@getLogin');
Route::post('/user/login','Auth\AuthController@postLogin');

Route::get('/user/logout','Auth\AuthController@getLogout');

Route::get('/user/register','Auth\AuthController@getRegister');
Route::post('/user/register','Auth\AuthController@postRegister');

/*---Crawler Panel---*/

//Route::get('/crawler','Crawler\CrawlController@getIndex');

//Route::get('/crawler/site','Crawler\CrawlController@getListSites');
//Route::get('/crawler/site/list','Crawler\CrawlController@getListSites');
//Route::get('/crawler/site/get','Crawler\CrawlController@getListSites');
//Route::get('/crawler/site/get/{siteId}','Crawler\CrawlController@getSite');
//Route::get('/crawler/site/create','Crawler\CrawlController@getCreateSite');
//Route::post('/crawler/site/create','Crawler\CrawlController@postCreateSite');
//Route::get('/crawler/site/edit/{siteId}','Crawler\CrawlController@getEditSite');
//Route::post('/crawler/site/edit/{siteId}','Crawler\CrawlController@postEditSite');
//Route::get('/crawler/site/trashbin','Crawler\CrawlController@getDeletedSites');
//Route::get('/crawler/site/delete/{siteId}','Crawler\CrawlController@getDeleteSite');

//Route::get('/crawler/url','Crawler\CrawlController@getAllUrls');
//Route::get('/crawler/url/{siteId}','Crawler\CrawlController@getUrls');

//Route::get('/crawler/crawlees/{urlId}','Crawler\CrawlController@getCrawlees');

//Route::get('/dashboard',['middleware'=>'auth', function (){
	//return view('pages.indexdashboard');
//}]);

/*---Objectives Management---*/
//TODO: Refactor objectives method into ObjController
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

    Route::get('/objectives/ajax/site/get/{siteId}','Crawler\ObjectiveController@getSiteJSON');
    /*--- URL CRUD ---*/
    Route::get('/objectives/url/list','Crawler\ObjectiveController@getUrls');
    Route::get('/objectives/url/get/{urlId}','Crawler\ObjectiveController@getUrl');
    Route::get('/objectives/url/create','Crawler\ObjectiveController@getCreateUrl');
    Route::get('/objectives/url/create/{sideId}','Crawler\ObjectiveController@getCreateUrl');
    Route::post('/objectives/url/create/','Crawler\ObjectiveController@postCreateUrl');
    
    Route::get('/objectives/url/trashbin','Crawler\ObjectiveController@getDeletedUrls');
    Route::get('/objectives/url/softdelete/{urlId}','Crawler\ObjectiveController@softDeleteUrl');

    /*--- Crawlee CRUD ---*/


    /*--- CrawleeResult CRUD--*/
});
