@extends('adminlte::page')

<style> 
html,body,#wrapper {
	width: 100%;
	height: 100%;
	margin: 0px;
}
 
.chart {
	font-family: Arial, sans-serif;
	font-size: 12px;
}
 
.axis path,.axis line {
	fill: none;
	stroke: #000;
	shape-rendering: crispEdges;
}
 
.bar {
	fill: #33b5e5;
}
 
.bar-failed {
	fill: #CC0000;
}
 
.bar-running {
	fill: #669900;
}
 
.bar-succeeded {
	fill: #33b5e5;
}
 
.bar-killed {
	fill: #ffbb33;
}
 
#forkme_banner {
	display: block;
	position: absolute;
	top: 0;
	right: 10px;
	z-index: 10;
	padding: 10px 50px 10px 10px;
	color: #fff;
	background:
		url('http://dk8996.github.io/Gantt-Chart/images/blacktocat.png')
		#0090ff no-repeat 95% 50%;
	font-weight: 700;
	box-shadow: 0 0 10px rgba(0, 0, 0, .5);
	border-bottom-left-radius: 2px;
	border-bottom-right-radius: 2px;
	text-decoration: none;
}

</style>


@section('content')

<div class="chart" id="Chart" style="width: 100%"></div>
  <div></div>


	<button type="button" onclick="changeTimeDomain('1hr')">1 HR</button>
	<button type="button" onclick="changeTimeDomain('3hr')">3 HR</button>
	<button type="button" onclick="changeTimeDomain('6hr')">6 HR</button>
        <button type="button" onclick="changeTimeDomain('1day')">1 DAY</button>
        <button type="button" onclick="changeTimeDomain('1week')">1 WEEK</button>



        <script type="text/javascript">

    var taskStatus = {
        "SUCCEEDED" : "bar",
        "FAILED" : "bar-failed",
        "RUNNING" : "bar-running",
        "KILLED" : "bar-killed"
    };



    
    @php
    //    var taskNames = [
    //    @foreach($orders as $order)
    //        "{{$order->activity->provider['name']}}", 
    //    @endforeach
    //    ];
    @endphp
    
    <?php  //var taskNames = [ "D Job", "P Job", "E Job", "A Job", "N Job", "teste 1", "teste 2", "teste 3", ] ?>

    <?php if(!empty($names)){  dd($names); ?>
    
   var taskNames =  {!! $names !!};
   var tasks =  convertDates ({!! $orders !!});
   
   function convertDates(which)
    {
        var result = []
        which.forEach ((dt) => {
            dt.startDate = new Date(dt.startDate)
            dt.endDate = new Date(dt.endDate)
            result.push (dt)
        })
        return result
    }



tasks.sort(function(a, b) {
    return a.endDate - b.endDate;
});
var maxDate = tasks[tasks.length - 1].endDate;
tasks.sort(function(a, b) {
    return a.startDate - b.startDate;
});
var minDate = tasks[0].startDate;

var format = "%H:%M";
var timeDomainString = "1day";

var gantt = d3.gantt().selector(".chart").taskTypes(taskNames).taskStatus(taskStatus).tickFormat(format).height(450).width(800);


gantt.timeDomainMode("fixed");
changeTimeDomain(timeDomainString);

gantt(tasks);

function changeTimeDomain(timeDomainString) {
    this.timeDomainString = timeDomainString;
    switch (timeDomainString) {
    case "1hr":
	format = "%H:%M:%S";
	gantt.timeDomain([ d3.time.hour.offset(getEndDate(), -1), getEndDate() ]);
	break;
    case "3hr":
	format = "%H:%M";
	gantt.timeDomain([ d3.time.hour.offset(getEndDate(), -3), getEndDate() ]);
	break;

    case "6hr":
	format = "%H:%M";
	gantt.timeDomain([ d3.time.hour.offset(getEndDate(), -6), getEndDate() ]);
	break;

    case "1day":
	format = "%H:%M";
	gantt.timeDomain([ d3.time.day.offset(getEndDate(), -1), getEndDate() ]);
	break;

    case "1week":
	format = "%a %H:%M";
	gantt.timeDomain([ d3.time.day.offset(getEndDate(), -7), getEndDate() ]);
	break;
    default:
	format = "%H:%M"

    }
    gantt.tickFormat(format);
    gantt.redraw(tasks);
}

function getEndDate() {
    var lastEndDate = Date.now();
    if (tasks.length > 0) {
	lastEndDate = tasks[tasks.length - 1].endDate;
    }

    return lastEndDate;
}

function addTask() {

    var lastEndDate = getEndDate();
    var taskStatusKeys = Object.keys(taskStatus);
    var taskStatusName = taskStatusKeys[Math.floor(Math.random() * taskStatusKeys.length)];
    var taskName = taskNames[Math.floor(Math.random() * taskNames.length)];

    tasks.push({
	"startDate" : d3.time.hour.offset(lastEndDate, Math.ceil(1 * Math.random())),
	"endDate" : d3.time.hour.offset(lastEndDate, (Math.ceil(Math.random() * 3)) + 1),
	"taskName" : taskName,
	"status" : taskStatusName
    });

    changeTimeDomain(timeDomainString);
    gantt.redraw(tasks);
};

function removeTask() {
    tasks.pop();
    changeTimeDomain(timeDomainString);
    gantt.redraw(tasks);
};

<?php   } ?>
</script>

@endsection

<script type="text/javascript" src="http://d3js.org/d3.v3.min.js"></script>
<script type="text/javascript" src="js/gantt.js"></script>
