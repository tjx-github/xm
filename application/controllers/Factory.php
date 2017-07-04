<?php

spl_autoload_register(function ($class) {
//    echo $class."<br>\n";
//    echo str_replace("\\","/",  __DIR__."/showdata/".$class . ".php<br>");
    if(is_file(str_replace("\\","/",  __DIR__."/Controller/".$class . ".php") )){
         include_once str_replace("\\","/",  __DIR__."/Controller/".$class . ".php");
    } else {
        die("错误  不存在". str_replace("\\","/",  __DIR__."/Controller/".$class . ".php"). "文件！");
    }
});
//按角色 显示 
final class Factory  {
    
    static private $object=[];
/*
 *  $roleide  用户权限码
 *  $name      方法类型
 *
 */
    public static function GetObject($roleide,$name,$ci_obj){  #返回对象
        $classname= $name .$roleide;
        if(array_key_exists(md5($classname), self::$object)){
            return self::$object[md5($classname)];  
        }
            return  self::Set(new $classname() , md5($classname) ,$ci_obj);
    }
    
    static private function Set(InterfaceProductListShow $obj ,$key ,$ci){
        self::$object[$key]=$obj;
        $obj->ci($ci);
        return $obj;
    }
    static public function del($name) {
        unset(self::$object[md5($name)]);
    }
    
}

