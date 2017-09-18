<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sites;
use App\Visits;
use App\Categories;
use DB;

class HomeController extends Controller
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
        $res = DB::table('sites')->select('visits.date',DB::raw("group_concat(sites.nameSite,' ',visits.count,' ',sites.category_id,' ',sites.access,' ',sites.visible) as visits"))
                ->join('visits','visits.id_site','=','sites.id')
                ->groupBy('visits.date')
                ->paginate(10);
            $collection=collect();
            $collect = collect();
        foreach($res as $k => $v){
            $array = explode(',',$v->visits);
            
            foreach($array as $k2 => $v2){
                $foo = explode(' ', $v2);
                $collection->push(['site' => $foo[0],'count'=> $foo[1],'category'=>$this->getCategory($foo[2]),'access'=>$foo[3],'visible'=>$foo[4]]);  
            }
            $sort = $collection->sortByDesc('count');
            $collect->push(['date'=>$v->date,$sort->values()->all()]);
            $collection = collect();
        }
        return view('home',['sites'=>$collect,'paginate' => $res,'new'=>$this->newSite(),'categories'=> \App\Http\Controllers\SitesController::getCategories()]);
    }
    
        public function showPrepods(){
        $res = DB::table('sites')->select('visits_prepods.date',DB::raw("group_concat(sites.nameSite,' ',visits_prepods.count,' ',sites.category_id,' ',sites.access,' ',sites.visible) as visits"))
                ->join('visits_prepods','visits_prepods.id_site','=','sites.id')
                ->groupBy('visits_prepods.date')
                ->paginate(10);
            $collection=collect();
            $collect = collect();
        foreach($res as $k => $v){
            $array = explode(',',$v->visits);
            
            foreach($array as $k2 => $v2){
                $foo = explode(' ', $v2);
                $collection->push(['site' => $foo[0],'count'=> $foo[1],'category'=>$this->getCategory($foo[2]),'access'=>$foo[3],'visible'=>$foo[4]]);  
            }
            $sort = $collection->sortByDesc('count');
            $collect->push(['date'=>$v->date,$sort->values()->all()]);
            $collection = collect();
        }
        return view('homePrepods',['sites'=>$collect,'paginate' => $res,'new'=>$this->newSite(),'categories'=> \App\Http\Controllers\SitesController::getCategories()]);
    }
    
    protected function getCategory($cat){
        if ($cat == 0){
            return "без категории";
        } else{
            $res = Categories::where('id','=',$cat)->get();
            foreach ($res as $category){return $category->name_category;}
        }
        
    }
    
    
}
