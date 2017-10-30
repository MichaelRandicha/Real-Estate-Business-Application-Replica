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
		Route::post('add', 'BranchController@register')->name('registerBranch');
		
		Route::get('view/{id}', 'BranchController@view')->name('viewBranch');

		Route::get('edit/{id}', 'BranchController@edit')->name('editBranch');
		Route::post('edit/{id}', 'BranchController@change')->name('changeBranch');	
	});

	Route::group(['prefix' => 'closing'], function(){
		Route::get('/', 'ClosingController@index')->name('closing');
		Route::post('search', 'ClosingController@search')->name('searchClosing');
		Route::get('add', 'ClosingController@add')->name('addClosing');
		Route::get('view/{id}', 'ClosingController@view')->name('viewClosing');
	});

	Route::group(['prefix' => 'agent'], function(){
		Route::get('/', 'AgentController@index')->name('agent');

		Route::post('search', 'AgentController@search')->name('searchAgent');
		
		Route::get('add', 'AgentController@add')->name('addAgent');
		Route::post('add', 'AgentController@register')->name('registerAgent');
		
		Route::get('view/{id}', 'AgentController@view')->name('viewAgent');

		Route::get('edit/{id}', 'AgentController@edit')->name('editAgent');
		Route::post('edit/{id}', 'AgentController@change')->name('changeAgent');
		
		Route::get('edit/{id}/status/change', 'AgentController@changeStatus')->name('changeStatusAgent');
	});

});



// Route::group(['middleware' => 'guest'], function() {
//     return "Hello World";
// });

Route::match(['get', 'post'], 'password/reset', function(){
    return abort(404);
});