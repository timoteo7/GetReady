<?php

namespace App\Http\Controllers\api;

use App\Place;
use App\Customer;
use App\Provider;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiPlaceController extends Controller
{
 
    public function index()
    {
        return response()->json(Place::get(), 200);
    }
    
    public function get($id)
    {
        return response()->json(Place::where ('individual_id', $id)->get(), 200);
    }

    public function set(Request $request)
    {
        if (Customer::where('user_id', Auth::user()->id)->exists()) {
            echo "é CLIENTE!!!!!! ".$customer=Customer::where('user_id',Auth::user()->id)->first();
            echo " Local:".$place=Place::find($customer->main_place_id);
        }else
        if (Provider::where('user_id', Auth::user()->id)->exists()) {
            echo "é FORNECEDOR!!!!!!".$provider=Provider::where('user_id',Auth::user()->id)->first();
            echo " Local:".$place=Place::find($provider->main_place_id);
        }else
        echo "é ADMIN ????";

        $place->update($request->all());
        return response()->json($place, 200);
    }

    public function store(Request $request)
    {
        return response()->json(Place::create($request->all()), 201);
    }

    public function show(Place $place)
    {
        return response()->json($place,200);
    }

    public function update(Request $request, Place $place)
    {
        $place->update($request->all());
        return response()->json($place,200);
    }

    public function destroy(Place $place)
    {
        return response()->json($place->delete(), 204);
    }
    
}
