<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JournalUser_Event as user_event;
use App\JournalEvent;

class UpdateController extends Controller
{
    public function updateEmploye(Request $request){
        
        $res = user_event::find($request->input('id'));
        if((!$request->input('event')) && ($request->input('count') > $res->count || $request->input('count') < $res->count )){
            $count = $request->input('count') - $res->count;
            $this->addCountInEvent($res->event_id, $count);
            $res->count = $request->input('count');
        } elseif ((!$request->input('event')) && ($request->input('count') == $res->count)){
           $res->count = $request->input('count');
        } else{
            $this->addCountInEvent($res->event_id,-$request->input('count'));
            $this->addCountInEvent($request->input('event'),$request->input('count'));
            $res->count = $request->input('count');
        }
        if($request->input('room'))
            $res->room_id = $request->input('room');
        if($request->input('event'))
            $res->event_id = $request->input('event');
        if($request->input('comment'))
            $res->comment = $request->input('comment');

        if($request->input('date'))
            $res->date = $request->input('date');
        
        $res->save();
        //dump($res);dump($request);

        
        
    }
    
    public function updateEvent(Request $request){
        $res = JournalEvent::find($request->input('id'));
        $res->name = $request->input('name');
        $res->save();
    }
    
    protected function addCountInEvent($id,$count){
        $event = JournalEvent::find($id);
        $event->count = $event->count + $count; 
        $event->save();
    }
}
