<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sites;
use App\Visits;
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
        $res = DB::table('sites')->select('visits.date',DB::raw("group_concat(sites.nameSite,' ',visits.count) as visits"))
                ->join('visits','visits.id_site','=','sites.id')
                ->groupBy('visits.date')
                ->paginate(10);
            $collection=collect();
            $collect = collect();
        foreach($res as $k => $v){
            $array = explode(',',$v->visits);
            
            foreach($array as $k2 => $v2){
                $foo = explode(' ', $v2);
                $collection->push(['site' => $foo[0],'count'=> $foo[1]]);  
            }
            $sort = $collection->sortByDesc('count');
            $collect->push(['date'=>$v->date,$sort->values()->all()]);
            $collection = collect();
        }
        return view('home',['sites'=>$collect,'paginate' => $res,'new'=>$this->newSite()]);
    }
    
}
