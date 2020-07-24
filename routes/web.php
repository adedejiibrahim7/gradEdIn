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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', function (){
    return view('details');
});
Route::post('/p', 'ProfileController@store');
Route::get('/opportunities/create', 'OpportunitiesController@create');
Route::get('/opportunities', 'OpportunitiesController@index');
Route::get('/opportunities/{opportunity}', 'OpportunitiesController@show');
Route::post('/o', 'OpportunitiesController@store');
Route::get('/apply/{opportunity}', 'ApplicationController@apply');
Route::get('/my-applications', 'ApplicationController@myApplications');
Route::get('/applications/{opportunity}', 'ApplicationController@index');
