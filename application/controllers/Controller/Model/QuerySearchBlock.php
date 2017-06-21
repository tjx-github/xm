<?php

namespace model;
class QuerySearchBlock extends \CI_Model{
    public function searchquery($table,$column ,$where,$order){
        $this->db->select($column);
        if(! empty($where)){
            $this->db->where($where);
        }
        return $this->db->order_by($order)-> get($table)->result_array();
    }
    
}

