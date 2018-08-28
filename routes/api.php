<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post ('notification', 'api\NotificationController@index');

Route::group(['middleware'=>'auth:api'], function(){

     Route::apiResources([
     		'order'=>'api\ApiOrderController',
			'provider'=>'api\ApiProviderController',
			'customer'=>'api\ApiCustomerController',
			'activity'=>'api\ApiActivityController',
			'place'=>'api\ApiPlaceController',
			'type'=>'api\ApiTypeController',
			'ticket'=>'api\TicketController',
			'subtype'=>'api\ApiSubtypeController',
		]);
		
	Route::get ('subtype/fromType/{serviceId}', 'api\ApiSubtypeController@fromType');
	Route::get ('provider/fromSubtype/{serviceId}', 'api\ApiProviderController@fromSubtype')->name('provider.fromsubtype');
	Route::get ('place/customer/{id}', 'api\ApiPlaceController@customer');
	//Route::put ('place/set/', 'api\ApiPlaceController@set');
	
	Route::match(array('PUT', 'PATCH', 'POST'), "place/set/", array(
      'uses' => 'api\ApiPlaceController@set',
      'as' => 'place.set'
	));
	
	Route::get ('customer/place/{customer}', 'api\ApiCustomerController@place'); //Devolve o Local Principal do Cliente ???
	Route::get ('customer/order/{customer}', 'api\ApiCustomerController@order'); // Devolve Lista de Pedidos do Cliente
	
	
	
	Route::resource('banner', 'api\ApiBannerController', ['only' => ['index','show','store']]);

	Route::resource('map', 'api\ApiMapsController', ['only' => ['update','show']]);
});

Route::get ('dropdown/{type}', 'api\ApiTypeController@dropdown');