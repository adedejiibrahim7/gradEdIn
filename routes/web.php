<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailTemplateController;

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
Route::get('/openings/{opportunity}', 'OpportunitiesController@show');
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
Route::post('academic-history/add', 'AcademicHistoryController@store');
Route::patch('academic-history/update', 'AcademicHistoryController@update');
Route::get('/academic-history/delete/{academic_history}', 'AcademicHistoryController@destroy');
Route::post('/save/{opportunity}', 'OpportunitiesController@save');
Route::get('/saved-openings', 'OpportunitiesController@savedOpenings');
Route::post('follow/{user}', 'UserController@follow');

Route::get('admin/home', function(){
   return view('admin.home');
});

Route::get('admin/', 'AdminController@index');
Route::get('admin/manage', 'AdminController@manage');
Route::post('admin/user/create', 'AdminController@createUser');
Route::get('link/{text}', 'LinkController@link');
Route::post('admin/update/{user}', 'AdminController@newUpdate');
Route::get('admin/openings', 'AdminController@openings');
Route::get('admin/openings/pending', 'AdminController@pending');
Route::get('admin/openings/active', 'AdminController@active');
Route::get('admin/openings/closed', 'AdminController@closed');
Route::get('/approve/{opportunity}', 'OpportunitiesController@approve');
//Route::get('/close/{opportunity}', 'OpportunitiesController@close');
Route::get('/close/{opportunity}', 'OpportunitiesController@close');
Route::get('/admin/users', 'AdminController@users');
Route::get('/admin/recruiters', 'AdminController@recruiters');
Route::get('/admin/seekers', 'AdminController@seekers');
Route::get('/admin/seekers', 'AdminController@seekers');
Route::get('/admin/admins', 'AdminController@admins');
Route::get('/admin/mail', 'MailController@index');
Route::get('/admin/mail/to-user/{user}', 'MailController@toUser');
Route::get('/admin/mail/to-all', 'MailController@mailAll');
Route::post('/admin/mail/send-mail', 'MailController@send');
Route::post('/admin/mail/send-mail/to-all', 'MailController@toAll');
Route::get('/admin/mail/templates', [MailTemplateController::class, 'index'])->name('admin.mail.templates');
