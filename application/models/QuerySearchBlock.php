<?php

class QuerySearchBlock extends \CI_Model{
    public function searchquery($table,$column ,$where='',$order='',$or_where=[]){
        $this->db->select($column);
        if(! empty($where)){
            $this->db->where($where);
        }
        if(!empty($order)){
            $this->db->order_by($order);
        }
        if(!empty($or_where)){
            $this->db->or_where($or_where);
        }
        return $this-> db  -> get($table)->result_array();
    }
    
}

