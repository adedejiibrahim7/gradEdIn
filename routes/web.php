<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MailTemplateController;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\OpportunitiesController;


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
Route::get('/opportunities/create', [OpportunitiesController::class, 'create']);
Route::get('/opportunities', [OpportunitiesController::class, 'index']);
Route::get('/opportunities/{opportunity}', [OpportunitiesController::class, 'show']);
Route::get('/openings/{opportunity}', [OpportunitiesController::class, 'show']);
Route::post('/o', [OpportunitiesController::class, 'store']);
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

Route::group(['prefix' => 'admin', 'name' => 'admin'], function (){
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/manage', [AdminController::class, 'manage']);
    Route::post('/user/create', [AdminController::class, 'createUser']);
    Route::get('link/{text}', 'LinkController@link');
    Route::post('/update/{user}', [AdminController::class, 'newUpdate']);
    Route::get('/openings', [AdminController::class, 'openings']);
    Route::get('/openings/pending', [AdminController::class, 'pending']);
    Route::get('/openings/active', [AdminController::class, 'active']);
    Route::get('/openings/closed', [AdminController::class, 'closed']);
    Route::get('/approve/{opportunity}', [OpportunitiesController::class, 'approve']);
//Route::get('/close/{opportunity}', 'OpportunitiesController@close');
    Route::get('/close/{opportunity}', [OpportunitiesController::class, 'close']);
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/recruiters', [AdminController::class, 'recruiters']);
    Route::get('/seekers', [AdminController::class, 'recruiters']);
    Route::get('/seekers', [AdminController::class, 'seekers']);
    Route::get('/admins', [AdminController::class, 'admins']);
    Route::get('/mail', [MailController::class, 'index']);
    Route::get('/mail/to-user/{user}', [MailController::class, 'toUser']);
    Route::get('/mail/to-all', [MailController::class, 'mailAll']);
    Route::post('/mail/send-mail', [MailController::class, 'send']);
    Route::post('/mail/send-mail/to-all', [MailController::class, 'toAll']);
    Route::get('/mail/templates', [MailTemplateController::class, 'index'])->name('admin.mail.templates');
    Route::post('/mail/templates/save', [MailTemplateController::class, 'save'])->name('admin.mail.templates.save');
    Route::get('/mail/templates/{template}/delete', [MailTemplateController::class, 'delete'])->name('admin.mail.templates.delete');
    Route::get('/mail/templates/{template}/show', [MailTemplateController::class, 'show'])->name('admin.mail.templates.delete');

});
