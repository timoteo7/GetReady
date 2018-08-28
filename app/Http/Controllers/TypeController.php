<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{

    public function index()
    {
        $type=Type::latest()->paginate(5);
        return view('type.index',compact('type'));
    }


    public function create()
    {
        return view('type.create');
    }


    public function store(Request $request)
    {
        if($request->file('image'))
        {
        	$filename = $request->file('image')->store('image');
		$request->merge([ 'url_image' => $filename ]);
	}
        Type::create($request->all());
        return redirect()->route('type.index')
					->with('success','Novo Tipo de Serviço Criado!');
    }


    public function edit(Type $type)
    {
        return view('type.edit',compact('type'));
    }


    public function update(Request $request, Type $type)
    {
        if($request->file('image'))
        {
            $filename = $request->file('image')->store('image');
		    if($filename)$request->merge([ 'url_image' => $filename ]);
        }
        $type->update($request->all());
        return redirect()->route('type.index')
					->with('success','Tipo de Serviço Atualizado!');
    }


    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('type.index')
					->with('success','Tipo de Serviço Apagado!');
    }
}
