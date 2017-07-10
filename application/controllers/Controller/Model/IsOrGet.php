<?php
namespace Model;
class IsOrGet{
    static private $set;
    static public function set(&$set){
        self::$set=&$set;
    }
    static function get($varname,&$get=false,$key=false){
        if(isset($_GET[$varname]) && ! empty($_GET[$varname])) {
            if($get !== false){
                $get= addslashes($_GET[$varname]);
            }
            return addslashes($_GET[$varname]);
        }else{
            if($key !== FALSE){
                unset(self::$set[$key]);
            }
            return FALSE;
        }
    }

    static public function post($varname,&$get=false,$key=false){
        if(isset($_POST[$varname]) && ! empty($_POST[$varname])) {
            if($get !== false){
                $get= addslashes($_POST[$varname]);
            }
            return addslashes($_POST[$varname]);
        }else{
            if($key !== FALSE){
                unset(self::$set[$key]);
            }
            return FALSE;
        }
    }
    static public function date_sort($function){  #排序
        
        $order=[1=>"desc","asc"];
        $str="";
        if(array_key_exists((int) self::$function("datetime_sort") ,$order ) ){
            $str .="  datetime ".$order[ self::$function("datetime_sort")];
        }
        if(array_key_exists((int) self::$function("costprice_sort"),$order ) ){
            if(mb_strlen($str) == ""){
                $str .="  costprice ".$order[ self::$function("costprice_sort")];
            } else {
                $str .=" , costprice ".$order[ self::$function("costprice_sort")];
            }
        }
        if($str){
            return $str;
        }else{
            return false;
        }
    }
}

