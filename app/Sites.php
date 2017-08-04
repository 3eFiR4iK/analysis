<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sites extends Model
{
    protected $table = 'sites';
    public $timestamps = false;
    
    public function categories(){
        return $this->belongsTo(\App\Categories::class,'category_id','id');
    }
}
