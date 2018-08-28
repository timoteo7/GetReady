<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mapper;
use DB;
use App\Provider;
use App\Place;

class HomeController extends Controller
{
    public function __invoke()
    {
		
		Mapper::map(-23.944841, -46.330376, ['zoom' => 12,  'marker' => false,
					 'clusters' => ['size' => 10, 'center' => true, 'zoom' => 20]
					 ]);
	
		$provider=Provider::get();
	
		foreach($provider as $item)
		{
			if (Place::where('id', $item['main_place_id'])->exists()) {

				$latitude=DB::table('places')->where('id', $item['main_place_id'])->value('latitude');
				$longitude=DB::table('places')->where('id', $item['main_place_id'])->value('longitude');

				//if(($latitude==NULL)or($longitude==NULL))dd(DB::table('places')->where('id', $item['main_place_id']));
			
				//Mapper::marker($latitude, $longitude, ['symbol' => 'circle', 'scale' => 1000]);
			
			Mapper::informationWindow(
				$latitude,
				$longitude,
			'<div id="content">'.
				'<div id="siteNotice">'.
				'</div>'.
				'<h3 id="firstHeading" class="firstHeading">'.$item['name'].'</h3>'.
				'<div id="bodyContent">'.
					'<p>' .$item['email'].'</p>'.
					'<p>'.$item['address'].'</p>'.
				'</div>'.
            '</div>'
            , [ 'open' => false, 'title' => $item['name'] ,'maxWidth'=> 350, 'autoClose' => 'true']);
            //, [ 'open' => false, 'title' => $item['name'] ,'maxWidth'=> 350, 'autoClose' => 'true' , 'symbol' => 'BACKWARD_CLOSED_ARROW', 'scale' => 5, 'animation' => 'DROP', 'strokeColor'=> '#B40404' ]);
			}
		}
	

		return view('home');
	}
}
