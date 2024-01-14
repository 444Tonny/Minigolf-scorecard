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
    return view('home');
})->name('home');

Route::get('/setup', 'App\Http\Controllers\user\NumberController@index')->name('selectNumber');
Route::post('/setup', 'App\Http\Controllers\user\NumberController@numberSelected')->name('numberSelected');

Route::get('/players', 'App\Http\Controllers\user\PlayerController@index')->name('selectNames');
Route::post('/players', 'App\Http\Controllers\user\PlayerController@namesSelected')->name('namesSelected');

Route::get('/holes', 'App\Http\Controllers\user\HoleController@index')->name('holes'); 
Route::post('/holes', 'App\Http\Controllers\user\HoleController@saveResults')->name('saveResults');

// Email
Route::post('/sendEmail', 'App\Http\Controllers\user\MailController@sendEmailWithJson')->name('sendEmail');


// Admin
Route::get('/thedugoutadmin', 'App\Http\Controllers\admin\LoginController@showLoginForm')->name('login');
Route::post('/thedugoutadmin', 'App\Http\Controllers\admin\LoginController@tryLogin')->name('tryLogin');

Route::middleware('auth')->group(function () {
    // Admin
    Route::get('/thedugoutadmin/logout', 'App\Http\Controllers\admin\LoginController@logout')->name('logout');

    Route::get('/thedugoutadmin/credentials', 'App\Http\Controllers\admin\LoginController@indexEditor')->name('adminCredentials');
    Route::put('/thedugoutadmin/credentials', 'App\Http\Controllers\admin\LoginController@editPassword')->name('passwordEdited');

    Route::get('/thedugoutadmin/games', 'App\Http\Controllers\admin\AdminController@index')->name('adminGames');

    Route::get('/thedugoutadmin/sponsors', 'App\Http\Controllers\admin\SponsorsController@indexEditor')->name('adminSponsors');
    Route::put('/thedugoutadmin/sponsors', 'App\Http\Controllers\admin\SponsorsController@updateSponsors')->name('sponsorsEdited');
});

// 404 not found pages
Route::fallback(function () {
    return redirect()->route('home'); 
});
?>