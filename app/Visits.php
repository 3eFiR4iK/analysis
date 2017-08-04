<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Visits extends Model
{
    protected  $table = 'visits';
    public $timestamps = false;
    
    public function sites (){
        return $this->belongsTo(\App\Sites::class,'id_site','id');
    }
    
    public function raw(){
        $visits = DB::selectRaw("group_concat(sites.nameSite,' ',visits.count,';') as visits");
        return $visits;
    }
}
