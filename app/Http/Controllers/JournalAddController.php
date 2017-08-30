<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JournalCategory;
use App\JournalEvent;
use App\JournalUser_Event;
use App\JournalRoom as room;
use App\Http\Controllers\JournalHomeController as data ;

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
    
    public function showAddjob(){
        return view('journalJob',['users'=>data::getUsers(),'events'=>data::getEvents(),'rooms'=>data::getRooms(),'categories'=>data::getCategories()]);
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
              $user_event->comment = $request->input('comment');
              $user_event->room_id = $request->input('idRoom');
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
    
    public function addCab(Request $request){
    
    if ($request->input('nameCab')){
        $room = new room();
        $room->name = $request->input('nameCab');
        $room->save();
    }
    return back();
}
    
}
