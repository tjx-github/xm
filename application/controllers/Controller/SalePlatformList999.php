<?php

class SalePlatformList999 extends CAbstract{
    use Trait_;
    public function showpview() {

        return 
            self::$ci->load->view("sale/SalePlatformListView999",[
                "nav"=>$this->MenuView(),
                "platform"=> self::$ci->db->query("SELECT * FROM `". PREFIX ."sale_platform` WHERE siteid =". SITEID ." order by ordernum asc")->result_array()
            ]);
    }
}
