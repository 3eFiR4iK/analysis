<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JournalEvent as events;

class ApiController extends Controller
{
    public function getEvents($id){
    	//dump(events::where('category_id','=',$id)->get());
    	return events::where('category_id','=',$id)->orderBy('name')->get();
    }
}
