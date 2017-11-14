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
		
		Route::get('add', 'BranchController@add')->name('branch.add');
		Route::post('add', 'BranchController@register')->name('branch.register');
		
		Route::get('view/{id}', 'BranchController@view')->name('branch.view');

		Route::get('list', 'BranchController@list')->name('branch.list');

		Route::get('edit/{id}', 'BranchController@edit')->name('branch.edit');
		Route::post('edit/{id}', 'BranchController@change')->name('branch.change');	
	});

	Route::group(['prefix' => 'agent'], function(){
		Route::get('/', 'AgentController@index')->name('agent');
		
		Route::get('add', 'AgentController@add')->name('agent.add');
		Route::post('add', 'AgentController@register')->name('agent.register');
		
		Route::get('view/{id}', 'AgentController@view')->name('agent.view');

		Route::get('list', 'AgentController@list')->name('agent.list');

		Route::get('edit/{id}', 'AgentController@edit')->name('agent.edit');
		Route::post('edit/{id}', 'AgentController@change')->name('agent.change');
		
		Route::get('edit/{id}/status/change', 'AgentController@changeStatus')->name('agent.changestatus');
	});

	Route::group(['prefix' => 'closing'], function(){
		Route::get('/', 'ClosingController@index')->name('closing');
		
		Route::get('add', 'ClosingController@add')->name('closing.add');
		Route::post('add', 'ClosingController@register')->name('closing.register');

		Route::get('view/{id}', 'ClosingController@view')->name('closing.view');

		Route::get('list', 'ClosingController@list')->name('closing.list');
	});

	Route::group(['prefix' => 'report'], function(){
		Route::get('branch', 'ReportController@branch')->name('report.branch');
		Route::get('commission', 'ReportController@commission')->name('report.commission');
		Route::get('closing', 'ReportController@closing')->name('report.closing');
		Route::get('point', 'ReportController@point')->name('report.point');
		Route::get('closing/list/', 'ReportController@closingList')->name('report.closing.list');
		Route::get('point/list/', 'ReportController@pointList')->name('report.point.list');
	});

});

Route::match(['get', 'post'], 'password/reset', function(){
    return abort(404);
});