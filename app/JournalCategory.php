<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalCategory extends Model
{
    protected $connection = 'mysql2';
    public $timestamps = false;
    protected  $table ='categories';
}
