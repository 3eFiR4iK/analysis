<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JournalCategory;
use App\JournalEvent;
use App\JournalUser;

class JournalHomeController extends Controller
{
    
    public static function getCategories(){
        return JournalCategory::get();
    }
    public static function getEvents(){
        return JournalEvent::get();
    }
    public static function getUsers(){
        return JournalUser::get();
    }
    
    public function show(){
        return view('journalHome',['categories'=> $this->getCategories(),
            'events'=> $this->getEvents(),
            'users'=>$this->getUsers()]);
    }
}
