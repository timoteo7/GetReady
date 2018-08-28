<?php

namespace App\Http\Controllers\api;

use App\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiActivityController extends Controller
{

    public function index()
    {
        return response()->json(Activity::get(), 200);
    }

    public function store(Request $request)
    {
        return response()->json(Activity::create($request->all()), 201);
    }

    public function show(Activity $activity)
    {
        return response()->json($activity,200);
    }


    public function update(Request $request, Activity $activity)
    {
        $activity->update($request->all());
        return response()->json($activity,200);
    }

    public function destroy(Activity $activity)
    {
        return response()->json($activity->delete(), 204);
    }
}
