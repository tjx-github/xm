<?php

class StoreList999 extends CAbstract{
    use Trait_;

    public function showpview() {
         self::$ci->load->model("StoreListModel999");
        self::$ci->load->view("store/storelistview999",
                [
                    "menu"=> $this->MenuView(),
                    "store"=>self::$ci-> StoreListModel999->GetToreList(SITEID)
                ]);
    }
    
    
}
