<?php

namespace App\Http\Controllers\api;

use App\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiTypeController extends Controller
{

    public function index()
    {
        return response()->json(Type::get(), 200);
    }


    public function store(Request $request)
    {
        return response()->json(Type::create($request->all()), 201);
    }


    public function show(Type $type)
    {
        return response()->json($type,200);
    }


    public function update(Request $request, Type $type)
    {
        $type->update($request->all());
        return response()->json($type,200);
    }


    public function destroy(Type $type)
    {
        return response()->json($type->delete(), 204);
    }

    public function dropdown(Type $type)
    {
        $subtype=$type->subtypes()->pluck('description' , 'id');
        //dd($subtype);
        return response()->json($subtype,200);
    }

}
