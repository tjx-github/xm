<?php
namespace Model;
class IsOrGet{
    static private $set;
    static public function set(&$set){
        self::$set=&$set;
    }
    static public function addslashes(&$var){
        if(is_array($var)){
            foreach($var as &$value){
                self::addslashes($value);
            }
        } else {
            $var= addslashes(strip_tags($var));
        }
        
    }
    static function get($varname,&$get=false,$key=false){
//        if(isset($_GET[$varname]) && ! empty($_GET[$varname]) ) {
        if(isset($_GET[$varname]) && $_GET[$varname] !== "" ) {
            is_array($_GET[$varname]) and exit("不允许 array 类型");
            if($get !== false){
                $get= addslashes( strip_tags($_GET[$varname]));
            }
            return addslashes( strip_tags($_GET[$varname]));
        }else{
            if($key !== FALSE){
                unset(self::$set[$key]);
            }
            return FALSE;
        }
    }

    static public function post($varname,&$get=false,$key=false){
        
//        if(isset($_POST[$varname]) && ! empty($_POST[$varname])  ) {
        if(isset($_POST[$varname]) && $_POST[$varname] !== "" ) {
                is_array($_POST[$varname]) and exit("不允许 array 类型");
            if($get !== false){
                $get= addslashes(strip_tags($_POST[$varname]));
            }
            return addslashes(strip_tags($_POST[$varname]));
        }else{
            if($key !== FALSE){
                unset(self::$set[$key]);
            }
            return FALSE;
        }
    }
    static public function date_sort($function,$ta=''){  #排序
        
        $order=[1=>"desc","asc"];
        $str="";
        if(array_key_exists((int) self::$function("datetime_sort") ,$order ) ){
            $str .="  {$ta}datetime ".$order[ self::$function("datetime_sort")];
        }
        if(array_key_exists((int) self::$function("costprice_sort"),$order ) ){
            if(mb_strlen($str) == ""){
                $str .="  {$ta}costprice ".$order[ self::$function("costprice_sort")];
            } else {
                $str .=" , {$ta}costprice ".$order[ self::$function("costprice_sort")];
            }
        }
        if($str){
            return $str;
        }else{
            return false;
        }
    }
}

