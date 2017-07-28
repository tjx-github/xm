<?php

//证书列表 公共方法
class CertList999 extends CAbstract{
    use Trait_;
    public function showallview() {
        self::$ci->load->model("CertListModel999");
        return self::$ci->load->view("cert/certlistview999",[
            "certlist"=>self::$ci-> CertListModel999->showdata(
                            (int) self::$ci->uri->segment(3)  , 
                            self::$PageNumber 
                    ),
            "pagelink"=> $this->page_html("home/cert_list", self::$ci-> CertListModel999->GetCount()),
            "nav"=>$this->MenuView(),
            "count"=>self::$ci-> CertListModel999->GetCount(),
            "wd"=>"sdd"
        ]);
    }
}

