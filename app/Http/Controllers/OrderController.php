<?php

namespace App\Http\Controllers;

use App\Order;
use App\Type;
use App\Subtype;

use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders=Order::latest()->paginate(5);
        return view('order.index',compact('orders'));
    }


    public function create()
    {
        $categories = Type::pluck('description' , 'id');
        return view('order.create',compact('categories'));
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Order $order)
    {
        //
    }


    public function edit(Order $order)
    {
        //
    }


    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('order.index')
					->with('success','Pedido Apagado!');
    }
}
