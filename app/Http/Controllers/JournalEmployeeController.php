<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JournalUser;
use App\JournalUser_Event;

class JournalEmployeeController extends Controller
{
    public function show(){
        $res = JournalUser_Event::with('users','event')->get();
        dump($res);
    }
}
