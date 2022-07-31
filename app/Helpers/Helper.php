<?php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
 
class Helper {
    public static function peluang($value,$param) {
        $result = $value-$param;
        
        return $result > 0 ? $result : 0;
    }
}