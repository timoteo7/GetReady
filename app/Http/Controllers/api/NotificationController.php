<?php

namespace App\Http\Controllers\api;

use DB;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Order $order)
    {
        $order=DB::table('orders')->where('transaction_code', 'LIKE' ,  '%'.$request->chargeCode.'%' )->first();
        \Log::debug(json_encode($order));
        $order = Order::find ($order->id);        
        $order->update( ['status' => 'WAITING_PROVIDER_CHECKOUT' ]);
        
    }


}
