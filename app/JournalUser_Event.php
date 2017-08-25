<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalUser_Event extends Model
{
    protected $connection = 'mysql2';
    public $timestamps = false;
    protected  $table = 'users_event';
    
    public function users(){
        return $this->belongsToMany(\App\JournalUser::class, 'users_event', 'id','user_id');
    }
    public function event(){
        return $this->belongsToMany(\App\JournalEvent::class, 'users_event', 'id','event_id');
    }
}
