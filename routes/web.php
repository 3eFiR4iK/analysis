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


Route::get('/',function (){
    return view('main');
});

Route::get('/ajax','JournalHomeController@getDataAjax');

//----analysis kadet-----//

Route::get('/analysis/getVisits/{date}/{kadets?}','ApiController@getVisits');
Route::get('/analysis/test/','HomeController@test');



Route::get('/analysis', 'HomeController@show');
Route::get('/analysis/prepods', 'HomeController@showPrepods');//Преподы
Route::post('/addCategory','AddController@addCategory');
Route::post('/sites/add','AddController@CatInSite');
Route::get('/sites','SitesController@show');
Route::post('/import','ImportController@import');
Route::post('/importprepods','ImportController@importPrepods');//Преподы
Route::get('/export/thisday','ExportController@thisDay');
Route::post('/export','ExportController@export');
Route::get('/pexport/thisday','ExportController@PthisDay');//Преподы
Route::post('/pexport','ExportController@Pexport');//Преподы
Route::post('/delete','SitesController@deleteCategory');
Route::get('/analysis/search','AnalysisSearchController@search');
//-----journal liot------//
Route::get('/journal/getevents/{id}','ApiController@getEvents');
Route::get('/journal','JournalHomeController@show');
Route::get('journal/job','JournalAddController@showAddJob');
Route::get('/journal/{id}','JournalHomeController@getEventsInCategory')->where('id','[0-9]+');
Route::post('/journal/addcategory','JournalAddController@addCategory');
Route::post('/journal/addevent','JournalAddController@addEvent');
Route::post('/journal/addjob','JournalAddController@addJob');
Route::post ('/journal/addcab','JournalAddController@addCab');
Route::get('/journal/employee','JournalEmployeeController@show');
Route::get('/journal/employee/{id}','JournalEmployeeController@getEventsUser');
Route::get('/journal/word','JournalExportController@show');
Route::post('/journal/export','JournalExportController@export');
Route::post('/journal/update','UpdateController@update');
Route::post('/journal/updateempl','UpdateController@updateEmploye');
Route::post('/journal/updateevent','UpdateController@updateEvent');
Route::get('/journal/edit','JournalHomeController@showEdit');
Route::get('journal/edit/{name}','UpdateController@updateEdit');
Route::post('/journal/update','UpdateController@update');
Route::post('/journal/delete','UpdateController@delete');
