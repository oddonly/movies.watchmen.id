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

Route::get('/', [
	'uses' =>'HomeController@getHome',
	'as' =>'home'
])->middleware('auth');;

Route::get('login', function () {
    return view('login');
});

Route::get('/live_search/action', 'LiveSearch@action')->name('live_search.action');
Route::get('/live_search2/action', 'LiveSearch@action2')->name('live_search.action2');
Route::get('/aktor/random', 'LiveSearch@aktorrandom')->name('aktor.random');
Route::get ('password/lost','ForgotPasswordController@forgotPassword')->middleware('auth');

Auth::routes();
Route::get ('dashboard', 'DashboardController@index')->middleware('auth');
Route::get ('changepassword', 'UserController@changepassword');
Route::post('updatepassword','UserController@updatePassword');
Route::get ('profile', 'UserController@profile')->middleware('auth');
Route::resource ('pages', 'PagesController');
Route::post ('update/{user_id}', 'UserController@updateprofile');
Route::post ('login', 'MainController@checklogin');
Route::post('changePassword/{user_id}','UserController@updatePassword')->name('changePassword');
Route::get ('user/profile', 'UserController@profile')->middleware('auth');
Route::get ('main/logout', 'MainController@logout')->middleware('auth');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::any('{catchall}', function () {
    return view('404');
})->where('catchall', '.*');
