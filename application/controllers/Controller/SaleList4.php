<?php

class SaleList4 extends CAbstract{
    use Trait_;
    protected $search=[
        "sale_payment"=>    ["column"=>['id','name'] ,    "where"=>["siteid"=>0  ],"order"=>"ordernum asc" ],
        "saleman"=>    ["column"=>['id','name'] ,    "where"=>[ ],"order"=>"ordernum asc" ],
        "product_status"=>  ["column"=>[ "id","name" ],  "where"=>[],"order"=>"ordernum asc" ], #库存状态
        "sale_platform"=>   ["column"=>['id','name'] ,   "where"=>["siteid"=>0],"order"=>"ordernum asc" ],
        "user"=>        ["column"=>["id","fullname"] ,    "where"=>["roleid"=>3],"order" =>"" ], #物品类别
//        "city"=>            ["column"=>["id","name"] ,    "where"=>[],"order"=>"ordernum asc" ],#地址

    ];
    public function __construct() {
        global $login;
        $this->search['sale_payment']['or_where']['siteid']= $login['id'];
        $this->search['sale_platform']['or_where']['siteid']= $login['id'];
//        $this->search['store']['or_where']['siteid']= $login['id'];
        
    }
    public function showpview(){

        self::$ci->load->model("SaleModel4");
        if(self::$ci->input->is_ajax_request()){
            return self::NIUNIU($this->login['id']);
        }
        self::DownloadXml($this->login['id']);
        return
            self::$ci->load->view("sale/SaleListView4",[
                "data"=> json_encode(
                        self::$ci->SaleModel4->GetSalePList(
                                $this->login['id'] , 
                                (int) self::$ci->uri->segment(3), 
                                self::$PageNumber )
                        ),
                "menu"=>$this->MenuView(),
                "page"=> self::page_html("/home/sale_list", self::$ci->SaleModel4::GetCount() ),
                "search"=> $this->SearchHeader(),
                "count"=> self::$ci->SaleModel4::GetCount()
            ]);
    }
    private static function NIUNIU($id){
        return self::$ci->load->view("sale/SaleListViewAJAX4",[
            "data"=> json_encode(
                        self::$ci->SaleModel4->GetSalePList(
                                $id , 
                                (int) self::$ci->uri->segment(3), 
                                self::$PageNumber )
                        ),
            "count"=> self::$ci->SaleModel4::GetCount(),
            "page"=> self::page_html("/home/sale_list", self::$ci->SaleModel4::GetCount() ),
        ]);
    }
    static private function DownloadXml($id){
        if(! isset($_GET['download'])){
            return;
        }
        
        \CExport::downloadxml(["id","商品编号","产品名称","状态","售价","销售价","定金","销售员","其他费用","快递费","总部利润","入库日期"], 
            self::$ci->SaleModel4->GetSalePList(
                $id , 
                (int) self::$ci->uri->segment(3), 
                self::$PageNumber )  ,["siteid","cid","agentid","saletype","carefee","platformfee","saleplatform","saleman",
"receiver","kuaidicompany","kuaidinum","agentprofit","payment","content","saletime","ispayback","datetime","HistoricalRate","plname","paname"]  
            );
    }



}
