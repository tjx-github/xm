<?php
class SalemanModel999 extends CI_Model{
    use \Model\Trait_Count;
    public function  showlist($page ,$mx=20){
        self::$count=$this->db
                ->from(PREFIX."saleman")
                ->select("count(*) as count")
                ->where([
                    "siteid"=>SITEID
                ])
                ->get()
                ->result_array();
      
        return  $this->db
                ->from(PREFIX."saleman")
                ->select("*")
                ->where([
                    "siteid"=>SITEID
                ])
                ->limit($mx, $page > 1 ? ($page-1) * $mx:0 )
                ->order_by("ordernum asc")
                ->get()
                ->result_object();
    }
}
