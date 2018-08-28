<?php

namespace App\Http\Controllers\api;

use App\Subtype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiSubtypeController extends Controller
{

    public function index()
    {
        return response()->json(Subtype::get(), 200);
    }

    public function fromType($serviceId)
    {
        return response()->json(Subtype::where ('type_id', $serviceId)->get(), 200);
    }

    public function store(Request $request)
    {
        return response()->json(Subtype::create($request->all()), 201);
    }


    public function show(Subtype $subtype)
    {
        return response()->json($subtype,200);
    }


    public function update(Request $request, Subtype $subtype)
    {
        $subtype->update($request->all());
        return response()->json($subtype,200);
    }


    public function destroy(Subtype $subtype)
    {
        return response()->json($subtype->delete(), 204);
    }
}
