<?php
namespace Model;
class Menu extends \CI_Model{
    static $menu;
    public function  getmenu(){
        global $login;
        if(! empty(self::$menu)){
            return self::$menu;
        }
        return
            self::$menu=
                $this->db->select("p.AdminRoleid ,m.MenuController  ,k.MenuName as TMenuName,m.MenuName")
                    ->from(PREFIX."power p")
                    ->join(PREFIX."menu m","m.MenuID=p.MenuID","inner")
                    ->join(PREFIX."admin a","a.AdminRoleid=p.BelongAdminRoleid ","inner")
                    ->join (" (select MenuName,MenuId from  ".PREFIX."menu where frommenuid is null) k","k.MenuId=m.FromMenuId","inner")
                    ->where("p.PowerEffective=1 and p.BelongAdminRoleid=". $login['roleid'])
                    ->get()->result_array();
    }
}

