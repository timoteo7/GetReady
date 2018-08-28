<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Type;
use App\Subtype;
//use Storage;
use Illuminate\Http\Request;

class BannerController extends Controller
{

    public function index()
    {
        $categories = Type::pluck('description' , 'id');
        $subcategories = Subtype::pluck('description' , 'id');
        $banner=Banner::latest()->paginate(5);
        return view('banner.index',compact('banner','categories','subcategories'));
    }


    public function create()
    {
        $categories = Type::pluck('description' , 'id');
        $subcategories = Subtype::pluck('description' , 'id');
        return view('banner.create',compact('categories','subcategories'));
    }


    public function store(Request $request)
    {
        if($request->file('image'))
        {
		    $filename = $request->file('image')->store('image');
            $request->merge([ 'url_image' => $filename ]);
        }
        Banner::create( $request->all() );

        return redirect()->route('banner.index')
					->with('success','Novo Banner Criado!');
    }


    public function edit(Banner $banner)
    {
        $categories = Type::pluck('description' , 'id');
        $subcategories = Subtype::pluck('description' , 'id');
        return view('banner.edit',compact('banner','categories','subcategories'));
    }


    public function update(Request $request, Banner $banner)
    {
        
        if($request->file('image'))
        {
            $filename = $request->file('image')->store('image');
		    if($filename)$request->merge([ 'url_image' => $filename ]);
        }
		$banner->update($request->all());
		
        return redirect()->route('banner.index')
					->with('success','Banner Atualizado!');
    }


    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('banner.index')
					->with('success','Banner Apagado!');
    }
}
