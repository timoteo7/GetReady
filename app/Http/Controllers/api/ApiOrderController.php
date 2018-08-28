<?php

namespace App\Http\Controllers\api;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiOrderController extends Controller
{

    public function index()
    {
        return response()->json(Order::get(), 200);
    }


    public function store(Request $request)
    {
        return response()->json(Order::create($request->all()), 201);
    }

    public function show(Order $order)
    {
        return response()->json($order,200);
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        return response()->json($order,200);
    }

    public function destroy(Order $order)
    {
        return response()->json($order->delete(), 204);
    }
}
