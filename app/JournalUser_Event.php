<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalUser_Event extends Model
{
    protected $connection = 'mysql2';
    public $timestamps = false;
    protected  $table = 'users_event';
}
