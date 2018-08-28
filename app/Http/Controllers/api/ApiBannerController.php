<?php

namespace App\Http\Controllers\api;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

class ApiBannerController extends Controller
{

    public function index()
    {
        return response()->json(Banner::get(), 200);
    }


    public function store(Request $request)
    {

		$validator = Validator::make($request->all(), [
           'name' => 'required',
           'type_id' => 'required',
           'subtype_id' => 'required',
       ]);

 
       if ($validator->fails()) {
           return response()->json(['error'=>$validator->errors()], 401);            
       }

        return response()->json(Banner::create($request->all()), 201);
    }


    public function show(Banner $banner)
    {
        return response()->json($banner,200);
    }


    public function update(Request $request, Banner $banner)
    {
		$banner->update($request->all());
        return response()->json($banner,200);
    }


    public function destroy(Banner $banner)
    {
        return response()->json($banner->delete(), 204);
    }
}
