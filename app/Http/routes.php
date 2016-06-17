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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user','Auth\AuthController@getLogin');

Route::get('/user/login','Auth\AuthController@getLogin');
Route::post('/user/login','Auth\AuthController@postLogin');

Route::get('/user/logout','Auth\AuthController@getLogout');

Route::get('/user/register','Auth\AuthController@getRegister');
Route::post('/user/register','Auth\AuthController@postRegister');

/*---Crawler Panel---*/
Route::get('/crawler','Crawler\CrawlController@getIndex');

Route::get('/crawler/site','Crawler\CrawlController@getSites');
Route::get('/crawler/site/{siteId}','Crawler\CrawlController@getSite');

Route::get('/crawler/url','Crawler\CrawlController@getAllUrls');
Route::get('/crawler/url/{siteId}','Crawler\CrawlController@getUrls');

Route::get('/crawler/crawlees/{urlId}','Crawler\CrawlController@getCrawlees');

