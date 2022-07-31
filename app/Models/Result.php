<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Result extends Model
{
    protected $table = 'result';
    
    protected $fillable = [
        'gameid', 'result', 'created_at',
    ];
}
