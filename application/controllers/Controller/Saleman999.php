<?php

class Saleman999 extends CAbstract{
    use Trait_;
    public function showpview() {
        self::$ci->load->model("SalemanModel999");

        
        
        return self::$ci->load->view("auxiliary/SalemanView999",[
            "nav"=> $this->MenuView(),
            "saleman"=>self::$ci->SalemanModel999->showlist( (int) self::$ci->uri->segment(3),self::$PageNumber),
            "count"=> self::$ci->SalemanModel999->GetCount(),
            "pagehtml"=>$this->page_html("home/saleman_list", self::$ci->SalemanModel999->GetCount()),
        ]);
        
        
    }
}

