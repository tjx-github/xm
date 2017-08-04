<?php

class SaleList2 extends CAbstract{
    use Trait_;
//    protected $search=[
//        "product_status"=>  [ "column"=>[ "id","name" ],  "where"=>[],"order"=>"ordernum asc" ], #库存状态
//        "category"=>        ["column"=>["id","name"] ,    "where"=>[],"order" =>"ordernum asc" ], #物品类别
//        "city"=>            ["column"=>["id","name"] ,    "where"=>[],"order"=>"ordernum asc" ],#地址
//        "store"=>           ["column"=>["id","name"] ,    "where"=>["siteid"=>SITEID],"order" =>"ordernum asc" ] ,#厂库
//        "city"=>            ["column"=>["name","id"], "where"=>[]            ,"order"=>"ordernum asc" ], # 地点，城市
//        "sale_payment"=>["column"=>['id','name'] ,"where"=>["siteid"=>SITEID  ],"order"=>"ordernum asc" ],
//        "saleman"=>["column"=>['id','name'] ,"where"=>[],"order"=>"ordernum asc" ],
//        "sale_platform"=>["column"=>['id','name'] ,"where"=>[],"order"=>"ordernum asc" ],
//        "user_role"=>["column"=>['roleid','rolename'] ,"where"=>[],"order"=>"" ],
//        
//    ];
    public function showpview() {
        self::$ci->load->model("SaleModel2");
        $this->Download();

        $config=self::$ci->config->item("page_config");
        
        $data=self::$ci->SaleModel2->getdata($this->login['id'],(int) self::$ci->uri->segment(3),$config['per_page']);
        return
            self::$ci->load->view(
                "sale/SaleListView3",
                [
                    "search"=>  $this->SearchHeader(),
                    "body"=>json_encode($data),
                    "count"=>self::$ci->SaleModel2->getcount(),
                    "pagehtml"=> self::page_html("home/sale_list", self::$ci->SaleModel2->getcount()),
                    "menu"=>$this->MenuView()
                ]
            );
        
    }
    private function Download(){
        if(isset($_GET['download'])){
            \CExport::downloadxml([
                "id","产品货号","产品名称","状态","售价","代理价","定金","销售员","其他费用","快递费","利润","日期"
            ], 
                 self::$ci->SaleModel2->GetDownloadData($this->login['id'] )   
            );
        }
    }
}