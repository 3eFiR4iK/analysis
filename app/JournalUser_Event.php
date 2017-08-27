<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalUser_Event extends Model
{
    protected $connection = 'mysql2';
    public $timestamps = false;
    protected  $table = 'users_event';
    
    public function users(){
        return $this->belongsTo(\App\JournalUser::class,'user_id');
    }
    public function event(){
        return $this->belongsTo(\App\JournalEvent::class,'event_id');
    }
}
