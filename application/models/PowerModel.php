<?php

class PowerModel extends CI_Model{
    public function IfPower($controller,$siteid){
        return 
            $this->db->select("p.AdminRoleid")
                ->from(PREFIX."power p")
                ->join(PREFIX."menu m","m.MenuID=p.MenuID","inner")
                ->join(PREFIX."admin a","a.AdminRoleid=p.BelongAdminRoleid ","inner")
                ->join (" (select MenuName,MenuId from  ".PREFIX."menu where frommenuid is null) k","k.MenuId=m.FromMenuId","inner")
                ->where("p.PowerEffective=1")  #是否有效
                ->where(" p.BelongAdminRoleid=". $siteid ) #属于谁的权限
                ->where("m.MenuController='{$controller}'") #要访问的控制器
                ->limit(1)
                ->get()
                ->result_array();
    }
    public function  IsExistence(){
        return $this->db->select("MenuID")->from(PREFIX."menu")->where(["MenuController" => preg_filter("/^\//",""  ,$_SERVER['REQUEST_URI'])  ])->limit(1)->get()->result_array();
    }
}

