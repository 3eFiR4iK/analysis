<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JournalCategory;
use App\JournalEvent;
use App\JournalUser_Event;

class JournalAddController extends Controller
{
    public function addCategory(Request $request){
        if($request->input('nameCategory')){
            $category = new JournalCategory();
            $category->name = $request->input('nameCategory');
            $category->save();
        }
        return back();
    }
    public function addEvent(Request $request){
        if ($request->input('nameEvent') && $request->input('idCategory')){
            $event = new JournalEvent();
            $event->name = $request->input('nameEvent');
            $event->category_id = $request->input('idCategory');
            $event->save();
        }
        return back();
    }
    public function addjob(Request $request){
        dump($request);
        if($request->input('idEvent') &&
            $request->input('idUser') &&
            $request->input('date') &&
            $request->input('count')){
              $user_event = new JournalUser_Event();
              $user_event->user_id = $request->input('idUser');
              $user_event->event_id = $request->input('idEvent');
              $user_event->count = $request->input('count');
              $user_event->date = $request->input('date');
              $user_event->save();
              $this->addCountInEvent($request->input('idEvent'), $request->input('count'));
            }
            return back();
    }
    
    protected function addCountInEvent($id,$count){
        $event = JournalEvent::find($id);
        $event->count = $event->count + $count; 
        $event->save();
    }
}
