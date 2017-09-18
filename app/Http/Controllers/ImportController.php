<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Categories;
use App\Sites;
use App\Visits;
use App\VisitsPrepods as PrepodsVisits;

class ImportController extends Controller
{
    protected $date;
    protected $file;
    protected $fileName = 'file';
    protected $id = NULL;


    public function __construct(Request $request) {
        $this->date = $request->input('date');
        $this->file = $request->input('f');
    }   
    
    public function addFile(Request $request){
        $dir = 'temp/';
        
        if($request->isMethod('post')){

            if($request->hasFile('f')) {
                $file = $request->file('f');
                $file->move(public_path() . '/temp',$this->fileName);
                $this->fileName = $dir.$this->fileName;
                
                return true;
            }
         }
         return false;
    }
    
    public function import (Request $request){
        if($this->addFile($request) == true){
           $file = Excel::load($this->fileName)->toArray();
        }
        $id=NULL;
        $count=0;
        foreach($file as $k => $v){
            if($this->find($v['sayt']) == true){
                
                $model = new Visits();
                $model->count = $v['poseshcheniya'];
                $model->date = $this->date;
                $model->id_site = $this->getSiteId($v['sayt']);
                $model->save();
            } else {
                
                $model = new Sites();
                $model->nameSite = $v['sayt'];
                $model->save();
                $id = $model->id;
                $model2 = new Visits();
                $model2->count = $v['poseshcheniya'];
                $model2->date = $this->date;
                $model2->id_site = $id;
                $model2->save();
            }
        }   
        return back();
    }
    
protected function find($site){
    $res='';
    if(is_string($site)){
        $res = Sites::where('nameSite','=',$site)->get();
    }
    if (count($res)>0)
        return true;
    else
        return false;
}

protected function getSiteId($site){
    $id=NULL; 
    $res = Sites::where('nameSite','=',$site)->get();
     foreach ($res as $site){
         $id = $site->id;
     }
     return $id;
}

    public function importPrepods (Request $request){
        if($this->addFile($request) == true){
           $file = Excel::load($this->fileName)->toArray();
        }
        
        $id=NULL;
        $count=0;
        foreach($file as $k => $v){
            if($this->find($v['sayt']) == true){
               
                $model = new PrepodsVisits();
                $model->count = $v['poseshcheniya'];
                $model->date = $this->date;
                $model->id_site = $this->getSiteId($v['sayt']);
                $model->save();
            } else {
               
                $model = new Sites();
                $model->nameSite = $v['sayt'];
                $model->save();
                $id = $model->id;
                $model2 = new PrepodsVisits();
                $model2->count = $v['poseshcheniya'];
                $model2->date = $this->date;
                $model2->id_site = $id;
                $model2->save();
            }
        }   
        dump($file);
        return back();
    }

}
