<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use App\Sites;

class AddController extends Controller
{
    protected  $nameCategory;
    
    public function __construct(Request $request) {
            $this->nameCategory = $request->input('name');
    }
    
    public function addCategory(){
        $message = ['message'=>'Добавлено','error'=>false];
        if(!$this->find($this->nameCategory)){
            $category = new Categories();
            $category->name_category = $this->nameCategory;
            $category->save();
            return redirect('/?&message=Добавлено&error=false');
        } else 
            return redirect('/?&message=Такая категория уже существует&error=true');
        
    } 
    
    protected function find($str){
    $res='';
    if(is_string($str)){
        $res = Categories::where('name_category','=',$str)->get();
    }
    if (count($res)>0)
        return true;
    else
        return false;
}

public function CatInSite(Request $request){
    $res = Sites::where('nameSite','=',$request->input('site'))->get();
    foreach ($res as $site){
        if($request->input('categories')!=NULL)
        $site->category_id = $request->input('categories');
        if($request->input('access')){
            $site->access = 0;
        } else $site->access = 1;
        if($request->input('access_prepods')){
            $site->access_prepods = 0;
        } else $site->access_prepods = 1;
        if($request->input('visible')) $site->visible=0; else $site->visible=1;
        $site->save();
    }
    //dump($request);
   return back();
    
}

public function addCab(Request $request){
    
    if ($request->input('nameCab')){
        
    }
    return back();
}

}
