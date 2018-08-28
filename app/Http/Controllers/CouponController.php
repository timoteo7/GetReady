<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function index()
    {
        $coupons=Coupon::latest()->paginate(5);
        return view('coupon.index',compact('coupons'));
    }


    public function create()
    {
        $code=$this->generate_password();
        return view('coupon.create',compact('code'));
    }


    public function store(Request $request)
    {
        Coupon::create($request->all());
        return redirect()->route('coupon.index')
					->with('success','Novo Cupom Criado!');
    }


    public function show(Coupon $coupon)
    {
        //
    }


    public function edit(Coupon $coupon)
    {
        return view('coupon.edit',compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $coupon->update($request->all());
        return redirect()->route('coupon.index')
					->with('success','Cupom Atualizado!');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupon.index')
					->with('success','Cupom Apagado!');
    }
    
    
    function generate_password ($length = 6)
    {
       //$characters = '234789abcdefghjkmnpqrtuvwxyzABCDEFHJKLMNPQRTUVWXYZ';
       $characters = '234789ABCDEFHJKLMNPQRTUVWXYZ';
       $charactersLength = strlen($characters);
       $randomString = '';
       for ($i = 0; $i < $length; $i++)
       {
           $randomString .= $characters[rand(0, $charactersLength - 1)];
       }
       return $randomString;
   }
    
}
