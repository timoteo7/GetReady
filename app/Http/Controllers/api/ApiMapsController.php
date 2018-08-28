<?php

namespace App\Http\Controllers\api;

use App\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ApiMapsController extends Controller
{



    public function show($id)
    {
		$provider = Provider::find($id);
        return $provider->only(['id','latitude', 'longitude']);
    }



    public function update(Request $request, $id)
    {
		$provider = Provider::find($id);
		$provider->update($request->only(['latitude', 'longitude']));
		
        return response()->json($provider->only(['id','latitude', 'longitude']),200);
    }



}
