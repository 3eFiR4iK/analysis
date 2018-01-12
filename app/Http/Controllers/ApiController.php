<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JournalEvent as events;
use App\Visits as visits;
use App\VisitsPrepods as prepods;

class ApiController extends Controller
{
    public function getEvents($id){
    	//dump(events::where('category_id','=',$id)->get());
    	return events::where('category_id','=',$id)->orderBy('name')->get();
    }
    
    public function getVisits($date,$kadets){
        if($kadets == 'true'){
            return visits::with('sites.categories')->where('date',$date)->get()->toJson();
        } else if($kadets == 'false'){
            return prepods::with('sites.categories')->where('date',$date)->get()->toJson();
        }
    }
}
