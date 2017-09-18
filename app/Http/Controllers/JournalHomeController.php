<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JournalCategory;
use App\JournalEvent;
use App\JournalUser;
use App\JournalRoom;

class JournalHomeController extends Controller
{
    
    public static function getCategories(){
        return JournalCategory::orderBy('name')->get();
    }
    public static function getEvents(){
        return JournalEvent::orderBy('name')->get();
    }
    public static function getUsers(){
        return JournalUser::orderBy('name')->get();
    }
    
    public static function getRooms(){
        return JournalRoom::orderBy('name')->get();
    }
    
    public function getDataAjax(){
        $mas['room']=self::getRooms();
        $mas['events']=self::getEvents();
        return $mas;
    }
    
    public function show($dat = NULL){
        return view('journalHome',['categories'=> $this->getCategories(),
            'events'=> $this->getEvents(),
            'users'=>$this->getUsers()]);
    }
    
    public function getEventsInCategory($id){
        $cat = JournalCategory::find($id);
        $res = JournalEvent::with('categories')->where('category_id', '=', $id)->get();
        return view('layouts.resultCategories',['category'=>$res,'catName'=>$cat]);
    }
}
