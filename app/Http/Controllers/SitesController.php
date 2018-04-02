<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sites;
use App\Categories;

class SitesController extends Controller
{
    
     public static function newSite(){
        $sites = Sites::get();
        $count=0;
        foreach ($sites as $site){
            if($site->category_id == 0)
                $count++;
        }
        return $count;
    }
    
    public static function getAllSites(){
        $res = Sites::with('categories')->where('category_id','<>','0')->orderBy('id','desc')->paginate(5000);
        return $res;
    }
    
    public static function getCategories(){
        $categories = Categories::orderBy('name_category')->get();
        return $categories;
    }

    public function show(){ 
        $res = Sites::where('category_id', '=', 0)->orderBy('id','desc')->paginate(5000);
        
        return view('sites',['sites'=>$res,'new'=>$this->newSite(),'categories'=>$this->getCategories(),'old'=>$this->getAllSites(),'search'=>' ']);
    }
    
    public function deleteCategory(Request $request){
        if ($request->input('category')){
            Categories::where('id','=',$request->input('category'))->delete();
        }
        return back();
    }
}
