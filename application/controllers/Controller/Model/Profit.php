<?php
namespace Model;
class Profit extends \CI_Model{
    private static $obj=[];
    static public $People;

//    private function __construct() { #ci的是public。。无法使用private。除非不继承ci。。
//         
//    }
    static public function RObj(){
        if(empty(self::$obj)){
            return self::$obj=new self();
        } else {
            return self::$obj;
        }
    }
    public function GetPeople(){
        if(empty(self::$People)){
            foreach ($this->db->query("select name,siteid from uz_saleman ") ->result_array() as $arr){
                self::$People[$arr['name']] =$arr['siteid'];
            }
            return self::$People;
        }else{
            return self::$People;
        }
    }
    public function rivalprice($pid){
        $data=$this->db->query("select rivalprice from uz_product where pid='{$pid}' limit 1") ->result_array();
        if(empty($data)){
            return 0;
        }else{
            return $data[0]['rivalprice'];
        }
    }
}

