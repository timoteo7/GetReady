<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Charts\GanttChart;
use App\Http\Controllers\Controller;
use App\Order;

class GanttController extends Controller
{

    public function __invoke()
    {
        $names= (array_pluck ( Order::with(['activity', 'activity.provider'])->paginate(50)->toArray()['data'], 'activity.provider.name') );
        $startdate=  ( array_pluck ( Order::latest()->paginate(50)->toArray()['data'],'schedule') );
        $duration=  ( array_pluck ( Order::with(['activity'])->latest()->paginate(50)->toArray()['data'],'activity.minutes') );
        
        $vv=0;
        foreach($startdate as $schedule) {
                $orders[]=array( 'startDate'=> $schedule,
                                'endDate'=> date('Y-m-d H:i:s',strtotime($schedule)+($duration[$vv])*60),
                                'taskName'=>$names[$vv],
                                'status'=>"SUCCEEDED",
                );
            $vv++;
        }
        
        //$teste= ( array_combine($startdate, $enddate) );
        
        //dd($orders);
        if(isset($orders))
        {
            $orders=json_encode($orders,JSON_HEX_QUOT | JSON_HEX_APOS | JSON_UNESCAPED_UNICODE);    
            $names=json_encode($names,JSON_HEX_QUOT | JSON_HEX_APOS | JSON_UNESCAPED_UNICODE);
        }
        return view('chart_view',compact('orders','names'));
    }

}
