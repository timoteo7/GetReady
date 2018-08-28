<?php

namespace App\Http\Controllers\api;

use App\Order;
use App\Place;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiCustomerController extends Controller
{

    public function index()
    {
        return response()->json(Customer::get(), 200);
    }
    
    public function place(Customer $customer)
    {
        return response()->json(Place::where ('id', 
                                        $customer->main_place_id ) ->get(), 200);
    }
    
    public function order(Customer $customer)
    {
        return response()->json(Order::where ('customer_id', 
                                        $customer->id ) ->get(), 200);
    }

    public function store(Request $request)
    {
        return response()->json(Customer::create($request->all()), 201);
    }


    public function show(Customer $customer)
    {
        return response()->json($customer,200);
    }


    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());
        return response()->json($customer,200);
    }


    public function destroy(Customer $customer)
    {
        return response()->json($customer->delete(), 204);
    }
}
