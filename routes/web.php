<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@show');
Route::post('/addCategory','AddController@addCategory');
Route::post('/sites/add','AddController@CatInSite');
Route::get('/sites','SitesController@show');
Route::post('/import','ImportController@import');
Route::get('/export/thisday','ExportController@thisDay');
Route::post('/export','ExportController@export');
Route::post('/delete','SitesController@deleteCategory');

//-----journal liot------//

Route::get('/journal','JournalHomeController@show');
Route::get('journal/job','JournalAddController@showAddJob');
Route::get('/journal/{id}','JournalHomeController@getEventsInCategory')->where('id','[0-9]+');
Route::post('/journal/addcategory','JournalAddController@addCategory');
Route::post('/journal/addevent','JournalAddController@addEvent');
Route::post('/journal/addjob','JournalAddController@addJob');
Route::post ('/journal/addcab','JournalAddController@addCab');
Route::get('/journal/employee','JournalEmployeeController@show');
Route::get('/journal/employee/{id}','JournalEmployeeController@getEventsUser');
Route::get('/journal/export','JournalExportController@export');