<?php
spl_autoload_register(function ($class) {
//    echo str_replace("\\","/",  __DIR__."/showdata/".$class . ".php<br>");
    if(is_file(str_replace("\\","/",  __DIR__."/showdata/".$class . ".php") )){
         include_once str_replace("\\","/",  __DIR__."/showdata/".$class . ".php");
    } 
});
//按角色 显示 
final class Factory  {
    static private $object=[];
    static private $prefixname=[
        1=>"ProductRoleDataList", # Product_list
        "SaleRoleDataList",       #sale_list
        "SaleRoleDataEdit"
    ];
/*
 *  $roleide  用户权限码
 *  $tpye      方法类型
 *
 */
    public static function GetObject($roleide,$tpye,$ci_obj){  #返回对象
        $classname= self::$prefixname[$tpye] .$roleide;
        if(array_key_exists(md5($classname), self::$object)){
            return self::$object[md5($classname)];  
        }
        if(preg_match("/^". self::$prefixname[$tpye] ."[0-9]+$/",$classname)){
            return  self::Set(new $classname() , md5($classname) ,$ci_obj);
        } else {
            exit("错误");
        }
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
