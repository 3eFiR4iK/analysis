<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JournalUser as users;
use App\JournalUser_Event as user_event;
use App\Http\Controllers\JournalHomeController as journal;


class JournalEmployeeController extends Controller
{
    public function show($data = NULL){
        
        return view('journalEmployee',['categories'=> journal::getCategories(),
            'events'=> journal::getEvents(),
            'users'=>journal::getUsers(),
            'users_event'=>$data['data'],
            'userName'=>$data['userName']]);
    }
    
    public function getEventsUser($id){
        
        $res['data'] = user_event::with('users','event')->where('user_id','=',$id)->orderBy('date','desc')->get();
        $res['userName'] = users::find($id); 
        
        return view('layouts.resultEmployee',['users_event'=>$res['data'],
            'userName'=>$res['userName']]);
    }
}
