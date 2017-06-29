<?php

class UserUpdatePasswordModel extends CI_Model{
    
    public function UpdatePass($id, $pass,$key){
        global $login;
        $up= md5($pass.$key);
        $this->db->where('id',$id);
        $this->db->set('password', $up );
        $p= $this->db->update(PREFIX.'user');
        if($p){
//            $dx=$this->db->query("select * from ".PREFIX.'user  where id={$id}')->result_array();
            
            
            return TRUE;
        }
    }

}
