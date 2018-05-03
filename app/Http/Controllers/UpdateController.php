<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JournalUser_Event as user_event;
use App\JournalEvent;
use App\Http\Controllers\JournalHomeController as journalData;
use App\JournalUser as users;
use App\JournalCategory as categories;
use App\JournalRoom as room;


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
        if($request->input('time'))
            $res->time = $request->input('time');
        
        $res->save();
        //return dump($request);

        
        
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
    
    public function updateEdit($name){
        if ($name == 'categories'){
        return view('layouts.resultEdit',['edit' => journalData::getCategories(),'name'=>'Категории']);}    
        if ($name == 'employee'){
        return view('layouts.resultEdit',['edit' => journalData::getUsers(),'name'=>'Сотрудники']);}
        if ($name == 'room'){
        return view('layouts.resultEdit',['edit' => journalData::getRooms(),'name'=>'Кабинеты']);}
    }
    
    public function delete(Request $request){
        if($request->input('section') == 'Категории')
            $this->deleteCategory ($request->input('id'));
        if($request->input('section') == 'Сотрудники')
            $this->deleteUser ($request->input('id'));
        if($request->input('section') == 'Кабинеты')
            $this->deleteRoom ($request->input('id'));
    }
    
    public function update(Request $request){

        if($request->input('section') == 'Категории')
            $this->updateCategory ($request->input('id'), $request->input('name'));
        if($request->input('section') == 'Сотрудники')
            $this->updateUser ($request->input('id'), $request->input('name'));
        if($request->input('section') == 'Кабинеты')
            $this->updateRoom ($request->input('id'), $request->input('name'));
    }
    
    protected function updateCategory($id,$name){
        $category = categories::find($id);
        $category->name = $name;
        //dump($name);
        $category->save();
    }
    protected function updateUser($id,$name){
        $user = users::find($id);
        $user->name = $name;
        $user->save();
    }
    protected function updateRoom($id,$name){
        $room = room::find($id);
        $room->name = $name;
        $room->save();
    }
    
    protected function deleteCategory($id){
        $category = categories::find($id);
        $category->delete();
    }
    protected function deleteUser($id){
         $user = users::find($id);
         $user->delete();
    }
    protected function deleteRoom($id){
        $room = room::find($id);
        $room->delete();
    }
    
}
