<?php
use Model\IsOrGet as O;
class CertListModel999 extends CI_Model{
    use \Model\Trait_Count;
    public function showdata($page,$z=20){
        $where=[];
        O::get("search") and $where['brandname  like'] = "%". O::get("search") ."%";
        
        
        self::$count=$this->db->from(PREFIX."cert")
                ->select("count(*) as count")
                ->where($where)
                ->get()->result_array();
        return 
            $this->db->from(PREFIX."cert")
                ->select("*")
                ->where($where)
                ->limit($z, $page > 1 ? ($page-1) * $z:0 )
                ->get()->result_array();
    }
}

