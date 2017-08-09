<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sites;
use App\Categories;

class SitesController extends Controller
{
    
     public function newSite(){
        $sites = Sites::get();
        $count=0;
        foreach ($sites as $site){
            if($site->category_id == NULL)
                $count++;
        }
        return $count;
    }
    
    public function show(){
        $res = Sites::where('category_id', '=', NULL)->get();
        $categories = Categories::get();
        return view('sites',['sites'=>$res,'new'=>$this->newSite(),'categories'=>$categories]);
    }
}
