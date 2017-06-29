<?php

class SalePaymentList999 extends CAbstract{
    use Trait_;
    function showpview() {
        
        return self::$ci->load->view("sale/SalePaymentListView999",[
           "nav" => $this->MenuView(),
            "payment"=> self::$ci->db->query("select * from ".PREFIX."sale_payment  where siteid=".SITEID ." order by ordernum asc" ) ->result_array()
        ]);
    }
}

