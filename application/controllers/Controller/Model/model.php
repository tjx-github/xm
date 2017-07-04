<?php
namespace model;
class model extends \CI_Model{
    public function i(){
        return $this->db->query("select * from uz_user") ->result_array();
    }
    
}

