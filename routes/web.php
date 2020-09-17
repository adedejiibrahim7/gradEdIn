<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home3');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/settings', 'UserController@settings');
Route::post('/switch', 'UserController@switch');
Route::get('/profile-setup', 'ProfileController@create');
Route::post('/p', 'ProfileController@store');
Route::post('/ep', 'EmployerProfileController@store');
Route::get('/opportunities/create', 'OpportunitiesController@create');
Route::get('/opportunities', 'OpportunitiesController@index');
Route::get('/opportunities/{opportunity}', 'OpportunitiesController@show');
Route::post('/o', 'OpportunitiesController@store');
Route::post('/apply/{opportunity}', 'ApplicationController@apply');
Route::get('/my-applications', 'ApplicationController@myApplications');
Route::get('/applications/{opportunity}', 'ApplicationController@index');
Route::get('/profile/{user}', 'ProfileController@show');
Route::get('/profile/edit/{user}', 'ProfileController@edit');
Route::patch('/profile/update', 'ProfileController@update');
Route::get('/my-openings/', 'OpportunitiesController@myOpportunities');
Route::get('/my-opportunities/', 'OpportunitiesController@myOpportunities');
Route::patch('update/{profile}', 'Profilecontroller@update');
Route::post('star/{application}', 'ApplicationController@star');
Route::get('applications/get-csv/{opportunity}', 'ApplicationController@DownloadCSV');
Route::get('/homme', function (){
   return view('home3');
});
Route::get('publications/add', 'PublicationController@create');
Route::post('publications/add-publication', 'PublicationController@store');

