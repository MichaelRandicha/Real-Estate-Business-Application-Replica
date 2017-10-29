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

Auth::routes();

// Route::get('/', function () {
//     return view('login.index');
// });

	// Route::get('/', function(){
 //    	return view('login.index');
 //    });

Route::group(['middleware' => 'guest'], function() {
	Route::get('/', function(){
		Route::get('/', 'HomeController@index');
	});    
});

Route::group(['middleware' => 'auth'], function() {
	Route::get('/', function(){
		return view('login.index');
	});    
});



// Route::group(['middleware' => 'guest'], function() {
//     return "Hello World";
// });

Route::match(['get', 'post'], 'password/reset', function(){
    return abort(404);
});