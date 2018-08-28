<?php

namespace App\Http\Controllers;


use App\Provider;
use App\Type;
use App\Subtype;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        $provider=Provider::latest()->paginate(5);
        return view('provider.index',compact('provider'));
    }

    public function create()
    {
		//$provider=Provider::pluck('name' , 'id');
		$categories = Type::pluck('description' , 'id');
		$subcategories = Subtype::pluck('description' , 'id');
		//$subtypes = Provider::subtypes->toArray();
        return view('provider.create',compact('categories','provider','subcategories','subtypes'));
    }

    public function store(Request $request)
    {
		Provider::create($request->all());
        return redirect()->route('provider.index')
					->with('success','Novo Prestador de Serviço Criado!');
    }

    public function edit(Provider $provider)
    {
        	$activities = $provider->activity->toArray();
        	$subtypes = $provider->subtypes->toArray();
	        $categories = Type::pluck('description' , 'id');
		$subcategories = Subtype::pluck('description' , 'id');
        return view('provider.edit',compact('provider','categories','subcategories','activities','subtypes' ));
    }

    public function update(Request $request, Provider $provider)
    {

        $lista=$request->request->get('hdn_list');

        $provider->subtypes()->detach();
        if (!empty ($lista))
        {
            $items = explode ('|', $lista);
            foreach ($items as $item)
            {
                $item_info = explode ('@', $item);
                if (!empty ($item_info[0]))
                {
                    $provider->subtypes()->attach($item_info[0]);
                }
            }
        }

		$provider->update($request->all());
        return redirect()->route('provider.index')
					->with('success','Prestador de Serviço Atualizado!');
    }

    public function destroy(Provider $provider)
    {
        $provider->delete();
        return redirect()->route('provider.index')
					->with('success','Prestador de Serviço Apagado!');
    }
}
