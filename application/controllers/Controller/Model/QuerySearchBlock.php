<?php

namespace Model;
class QuerySearchBlock extends \CI_Model{
     public function searchquery($table,$column ,$where,$order){
        $this->db->select($column);
        if(! empty($where)){
            $this->db->where($where);
        }
        if(!empty($order)){
            $this->db->order_by($order);
        }
        return $this-> db  -> get($table)->result_array();
    }
    
    
}

