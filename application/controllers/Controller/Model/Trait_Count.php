<?php
namespace Model;
trait Trait_Count{
    static private $count=0;
    public static function GetCount(){
        if(is_array(self::$count)){
            return self::$count[0]['count'];
        } else {
            return self::$count;
        }
    }
}

