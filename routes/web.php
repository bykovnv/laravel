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

Route::group(['namespace' => 'Profile'], function () {
    Route::get('/profile/{id}', 'ProfileController')->name('profile.id');
    Route::get('/edit/{id}', 'EditController')->name('profile.edit');
    Route::get('/media/{id}', 'MediaController')->name('profile.media');
    Route::get('/security/{id}', 'SecurityController')->name('profile.security');;
    Route::get('/status/{id}', 'StatusController')->name('profile.status');

    Route::post('/edit/{id}', 'EditUpdateController')->name('profile.editUpdate');
    Route::post('/media/{id}', 'MediaUpdateController')->name('profile.media.update');
    Route::post('/security/{id}', 'SecurityUpdateController')->name('profile.security.update');
    Route::post('/status/{id}', 'StatusUpdateController')->name('profile.status.update');
});

Route::redirect('/', '/login');


Auth::routes();

Route::middleware(['admin'])->group(function () {

    Route::get('/profiles', 'Profile\AllProfilesController')->name('profile.all');
    Route::get('/create', 'Profile\CreateController')->name('profile.add');
    Route::get('/delete/{id}', 'Profile\DeleteController')->name('profile.delete');
    Route::post('/create/user', 'Profile\CreateProfileController')->name('profile.create');

    });








