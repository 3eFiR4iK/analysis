<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalEvent extends Model
{
    protected $connection = 'mysql2';
    public $timestamps = false;
    protected  $table = 'event';
    
        public function categories(){
        return $this->belongsTo(\App\JournalCategory::class,'category_id');
    }
}
