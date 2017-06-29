<?php
class StoreListModel999 extends CI_Model{
    public function GetToreList($userid){
        return 
        $this->db->query("SELECT s.* , COUNT(p.id) as `count` FROM  `".PREFIX."store` as s 
                            left  join ". PREFIX."product p on p.storeid=s.id where s.siteid={$userid}  GROUP by s.id")->result_array();
    }
}

