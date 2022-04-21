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

use Illuminate\Http\Request;

//Route::get('/', 'HomeController@index')->name('home');
//Route::get('/', 'ProfilesController@profile')->name('profile.id');
Route::redirect('/', '/login');
Route::get('/home', 'ProfilesController@profile')->name('profile.id');

Auth::routes();

Route::get('/edit/{id}', 'ProfilesController@edit')->name('profile.edit');
Route::get('/media/{id}', 'ProfilesController@media')->name('profile.media');
Route::get('/security/{id}', 'ProfilesController@security')->name('profile.security');;
Route::get('/status/{id}', 'ProfilesController@status')->name('profile.status');
Route::get('/profile/{id}', 'ProfilesController@profile')->name('profile.id');
Route::get('/profiles', 'ProfilesController@profiles')->name('profile.all');
Route::get('/create', 'ProfilesController@create')->name('profile.create');

Route::post('/edit/{id}', 'ProfilesController@editUpdate')->name('profile.editUpdate');
Route::post('/media/{id}', 'ProfilesController@mediaUpdate')->name('profile.media.update');
Route::post('/security/{id}', 'ProfilesController@securityUpdate')->name('profile.security.update');
Route::post('/status/{id}', 'ProfilesController@statusUpdate')->name('profile.status.update');
Route::get('/delete/{id}', 'ProfilesController@delete')->name('profile.delete');
Route::post('/create/user', 'ProfilesController@createUser')->name('profile.create');

