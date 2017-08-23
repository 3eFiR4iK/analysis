<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Categories;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller {

    protected $sites;

    public function export(Request $request) {
       $sites = $this->getSites($request->input('mounth'));
       $ex = Excel::create('отчет по сайтам за '.$request->input('mounth'),function($excel) use($sites){
           $excel->setCompany('SPBKK');
           $excel->sheet('Sheetname', function($sheet) use($sites){
               $sheet->cell('A1',function ($cell){
                    $cell->setValue('Название сайта');
                    $cell->setAlignment('center'); 
                    $cell->setFont(['bold'=>true]);
                });
                $sheet->cell('B1',function ($cell){
                    $cell->setValue('Кол-во посещений');
                    $cell->setAlignment('center'); 
                    $cell->setFont(['bold'=>true]);
                });
                $sheet->cell('C1',function ($cell){
                    $cell->setValue('Категория');
                    $cell->setAlignment('center'); 
                    $cell->setFont(['bold'=>true]);
                });
                $sheet->cell('D1',function ($cell){
                    $cell->setValue('Доступ');
                    $cell->setAlignment('center'); 
                    $cell->setFont(['bold'=>true]);
                });
                $sheet->fromArray($sites, null, 'A2', true, false);    
           });
       })->export('xls');
       return redirect()->back();
    }
    
    protected function getSites($mounth){
        $sites = collect();
        if($mounth){
        $res = DB::table('sites')->select('visits.date', DB::raw("group_concat(sites.nameSite,' ',visits.count,' ',sites.category_id,' ',sites.access,' ',sites.visible) as visits"))
                        ->join('visits', 'visits.id_site', '=', 'sites.id')
                        ->where('visits.date', '>=', date('Y') . '-' . $mounth . '-01')
                        ->where('visits.date', '<=', date('Y') . '-' . $mounth . '-31')
                        ->where('sites.visible','=','1')
                        ->groupBy('visits.date')->get();
        } else {
        $res = DB::table('sites')->select('visits.date', DB::raw("group_concat(sites.nameSite,' ',visits.count,' ',sites.category_id,' ',sites.access,' ',sites.visible) as visits"))
                        ->join('visits', 'visits.id_site', '=', 'sites.id')
                        ->where('visits.date', '>=', date("Y-m-d"))
                        ->where('sites.visible','=','1')
                        ->where('sites.access','=','0')
                        ->groupBy('visits.date')->get();            
        }
        $collection = collect();
        $collect = collect();
        foreach ($res as $k => $v) {
            $array = explode(',', $v->visits);

            foreach ($array as $k2 => $v2) {
                $foo = explode(' ', $v2);
                $collection->push(['site' => $foo[0], 'count' => $foo[1], 'category' => $this->getCategory($foo[2]), 'access' => ($foo[3]==1)?'разрешен':'нет', 'visible' => $foo[4]]);
            }
            $sort = $collection->sortByDesc('count');
            $collect->push($sort->values()->all());
            $collection = collect();
        }
        $this->sites = $collect;

        for ($i = 0; $i < $this->sites->count(); $i++) {
            $mas = $collect[$i];
            foreach ($mas as $k => $v) {
                $name = $v['site'];
                $count = $this->foundCountSites($name, $v['count'], $i);
                $sites->push(['site' => $name, 'count' => (int)$count, 'category' => $v['category'], 'access' => $v['access']]);
            }
        }
        return $sites;
    }

    protected function foundCountSites($name, $count, $id) {
        for ($i = 0; $i < $this->sites->count(); $i++) {
            if ($id != $i){
            $mas = $this->sites[$i];
            foreach ($mas as $k => $v) {
                if ($v['site'] == $name) {
                    $count += $v['count'];
                    $sites = $this->sites->get($i);
                    array_pull($sites, $k);
                    $this->sites[$i]=$sites;
                    break;
                }
            }
            
                }
        }
        return $count;
    }

    protected function getCategory($cat) {
        if ($cat == 0) {
            return "без категории";
        } else {
            $res = Categories::where('id', '=', $cat)->get();
            foreach ($res as $category) {
                return $category->name_category;
            }
        }
    }
    
    public function thisDay(){}

}
