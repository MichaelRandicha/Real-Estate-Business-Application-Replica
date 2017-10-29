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
	Route::get('/', 'HomeController@index');   
});

Route::group(['middleware' => 'auth'], function() {
	Route::get('/', function(){
		return redirect('dashboard');
	});

	Route::group(['prefix' => 'dashboard'], function(){
		Route::get('/', 'DashboardController@index')->name('dashboard');
	});

	Route::group(['prefix' => 'branch'], function(){
		Route::get('/', 'BranchController@index')->name('branch');
		Route::post('search', 'BranchController@search')->name('searchBranch');
		Route::get('add', 'BranchController@add')->name('addBranch');
		Route::get('view/{id}', 'BranchController@view')->name('viewBranch');
		Route::get('edit/{id}', 'BranchController@edit')->name('editBranch');
	});

	Route::group(['prefix' => 'closing'], function(){
		Route::get('/', 'ClosingController@index')->name('closing');
	});

	Route::group(['prefix' => 'property'], function(){
		Route::get('/', 'PropertyController@index')->name('property');
	});

	Route::group(['prefix' => 'agent'], function(){
		Route::get('/', 'AgentController@index')->name('agent');
	});

});



// Route::group(['middleware' => 'guest'], function() {
//     return "Hello World";
// });

Route::match(['get', 'post'], 'password/reset', function(){
    return abort(404);
});