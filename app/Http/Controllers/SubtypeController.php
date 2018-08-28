<?php

namespace App\Http\Controllers;

use App\Type;
use App\Subtype;
use Illuminate\Http\Request;

class SubtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$categories = Type::pluck('description' , 'id');
        $subtype=Subtype::latest()->paginate(5);
        return view('subtype.index',compact('subtype','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$categories = Type::pluck('description' , 'id');
        return view('subtype.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('image'))
        {
            $filename = $request->file('image')->store('image');
		    $request->merge([ 'url_image' => $filename ]);
		}
        Subtype::create($request->all());
        return redirect()->route('subtype.index')
					->with('success','Nova Sub Categoria Criada!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subtype  $subType
     * @return \Illuminate\Http\Response
     */
    public function edit(Subtype $subtype)
    {
		$categories = Type::pluck('description' , 'id');
        return view('subtype.edit',compact('subtype','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subtype  $subType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subtype $subtype)
    {
        if($request->file('image'))
        {
            $filename = $request->file('image')->store('image');
		    if($filename)$request->merge([ 'url_image' => $filename ]);
        }
        $subtype->update($request->all());
        return redirect()->route('subtype.index')
					->with('success','Sub-Categoria Atualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subtype  $subType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subtype $subtype)
    {
        $subtype->delete();
        return redirect()->route('subtype.index')
					->with('success','Tipo de Serviço Apagado!');
    }
}
