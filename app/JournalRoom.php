<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalRoom extends Model
{
    protected $connection = 'mysql2';
    public $timestamps = false;
    protected  $table = 'room';
}
