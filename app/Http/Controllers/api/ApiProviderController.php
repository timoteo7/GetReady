<?php

namespace App\Http\Controllers\api;

use App\Provider;
use App\Customer;
use App\Subtype;
use App\Place;
use App\User;
use Auth;
use DB;
//use Geographical;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ApiProviderController extends Controller
{

    public function index()
    {
        return response()->json(Provider::get(), 200);
    }


    public function store(Request $request)
    {
        return response()->json(Provider::create($request->all()), 201);
    }


    public function show(Provider $provider)
    {
        return response()->json($provider,200);
    }


    public function update(Request $request, Provider $provider)
    {
		$provider->update($request->all());
        return response()->json($provider,200);
    }


    public function destroy(Provider $provider)
    {
        return response()->json($provider->delete(), 204);
    }

    public function fromSubtype($serviceId)
    {

        /*
        $query = Place::distance($place_customer->latitude, $place_customer->longitude); // TODAS LOCALIZAÇÕES NO BD SEM FILTRO
        $asc = $query->orderBy('distance', 'ASC')->get();
        foreach ($asc as $place) {
            echo "-------------------";
            echo " ID:".$place->id;
            echo " Distancia:".number_format($place->distance*1000,0,",",".")."m ";
        }*/

        $place_customer=Place::find(Customer::where('user_id',Auth::user()->id)->first()->main_place_id);
        $subtypes = Subtype::find($serviceId);
        $sql=
        "select * from (
        SELECT providers.* , ((ACOS(SIN(? * PI() / 180) * SIN(places.latitude * PI() / 180) + COS(? * PI() / 180) * COS(places.latitude * PI() / 180) * COS((? - places.longitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515 * 1.609344 *1000) as distance
        FROM places
        INNER JOIN providers ON places.id = providers.main_place_id
        INNER JOIN provider_subtype ON providers.id = provider_subtype.provider_id
        WHERE provider_subtype.subtype_id = ?
        ) as a  
        ORDER BY distance asc limit 20";
        
        $query=DB::select($sql, [$place_customer->latitude, $place_customer->latitude, $place_customer->longitude, $serviceId]);
        
        /*
        foreach ($query as $provider) {
            //$place_provider=Place::find(Provider::find($provider->pivot->provider_id)->main_place_id);
            echo "ID:".$provider->id." Distancia:".$provider->distance;
        }*/

        return response()->json($query, 200);
    }
}
