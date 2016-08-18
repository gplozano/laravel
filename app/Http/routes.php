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

// Route::get('/', function () {
//     return view('dashboard');
// });

Route::get('/', 'StatusController@index');

// Route::get('login', function() {
// 	return view('pages.login');
// });


// Admin Authentication routes ...
Route::get('admin', 'Auth\AuthController@getLogin');
Route::post('admin', 'Auth\AuthController@postLogin');
Route::get('admin/logout', 'Auth\AuthController@getLogout');



Route::get('admin/dashboard', 'Dashboard@index');

// Admin routes

// Resources
Route::resource('admin/issues/notes', 'NotesController');

// GET
Route::get('admin/issues', 'IssuesController@index');
Route::get('admin/issues/add', 'IssuesController@add');
Route::get('admin/issues/{id}', 'IssuesController@show');
Route::get('admin/settings', 'SettingsController@index');
Route::get('admin/settings/user/new', 'SettingsController@create');
Route::get('admin/settings/user/{id}', 'SettingsController@edit');
Route::get('admin/domains/find', 'DomainsController@find');

//Route::get('admin/issues/notes/new', 'NotesController@create');


// POST
Route::post('admin/issues/gr', 'IssuesController@gr');

Route::post('admin/issues/closedomain', 'IssuesController@closeDomain');
Route::post('admin/issues/addhost', 'IssuesController@addDomainHost');
Route::post('admin/issues/delhost', 'IssuesController@delDomainHost');
Route::post('admin/issues/deldomain', 'IssuesController@delDomain');
Route::post('admin/issues/adddomain', 'IssuesController@addDomain');
Route::post('admin/issues/{id}', 'IssuesController@edit');
Route::post('admin/issues', 'IssuesController@store');


Route::post('admin/settings/user/new', 'SettingsController@store');
Route::post('admin/settings/user/delete', 'SettingsController@destroy');

//Route::post('admin/issues/notes/new', 'NotesController@store');
//Route::post('admin/issues/notes/delete', 'NotesController@destroy');


// User login status routes
Route::get('status', 'StatusController@index');

// User Auth routes...
Route::get('login', 'UserAuthController@getLogin');
Route::post('login', 'UserAuthController@postLogin');
Route::get('logout', 'UserAuthController@getLogout');


