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

Route::get('/', function () {
    return redirect('/login');
});

    //Route::get('/welcome', 'HomeController');
    Route::view('/welcome', 'welcome');


Route::group(['middleware' => 'auth'], function () {

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
    
    //Route::get('/home', 'ProviderController@index')->name('provider.index');
    
    Route::get('/home', 'HomeController');
    Route::get('/gantt', 'GanttController');


    Route::resource('provider', 'ProviderController',   ['except' => ['show']]);
    Route::resource('customer', 'CustomerController',   ['except' => ['show']]);
    Route::resource('type',     'TypeController',       ['except' => ['show']]);
    Route::resource('subtype',  'SubtypeController',    ['except' => ['show']]);
    Route::resource('banner',   'BannerController',     ['except' => ['show']]);
    Route::resource('coupon',   'CouponController',     ['except' => ['show']]);
    Route::resource('order',    'OrderController',      ['except' => ['show']]);

 
});
/*
Route::prefix("api")->group(function () {
    Route::resource('type', 'api\ApiTypeController', ['only' => ['index']]);
    Route::get('subtype/{serviceId}', 'api\ApiSubtypeController@index');
    Route::resource('banner', 'api\ApiBannerController', ['only' => ['index','show','store']]);
	Route::resource('map', 'api\ApiMapsController', ['only' => ['update','show']]); 
});*/

Auth::routes();

