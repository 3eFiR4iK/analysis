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
            if($site->category_id == 0)
                $count++;
        }
        return $count;
    }
    
    public function getAllSites(){
        $res = Sites::with('categories')->where('category_id','<>','0')->get();
        return $res;
    }
    
    public static function getCategories(){
        $categories = Categories::get();
        return $categories;
    }

    public function show(){ 
        $res = Sites::where('category_id', '=', 0)->get();
        
        return view('sites',['sites'=>$res,'new'=>$this->newSite(),'categories'=>$this->getCategories(),'old'=>$this->getAllSites()]);
    }
    
    public function deleteCategory(Request $request){
        if ($request->input('category')){
            Categories::where('id','=',$request->input('category'))->delete();
        }
        return back();
    }
}
