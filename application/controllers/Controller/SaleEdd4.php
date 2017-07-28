<?php

class SaleEdd4 extends CAbstract{
    use Trait_;
    protected $search=[
        "product_status"=>  ["column"=>[ "id","name" ],  "where"=>[],"order"=>"ordernum asc" ], #库存状态
        "category"=>        ["column"=>["id","name"] ,    "where"=>[],"order" =>"ordernum asc" ], #物品类别
        "city"=>            ["column"=>["id","name"] ,    "where"=>[],"order"=>"ordernum asc" ],#地址
        "store"=>           ["column"=>["id","name"] ,    "where"=>["siteid"=>0] ,"order" =>"ordernum asc" ] ,#厂库,美工只能修改总部库存。所以给0
//        "city"=>            ["column"=>["name","id"],     "where"=>[]            ,"order"=>"ordernum asc" ], # 地点，城市
        "sale_payment"=>    ["column"=>['id','name'] ,    "where"=>["siteid"=>0  ],"order"=>"ordernum asc" ],
        "saleman"=>         ["column"=>['id','name'] ,    "where"=>[],"order"=>"ordernum asc" ],
        "sale_platform"=>   ["column"=>['id','name'] ,   "where"=>["siteid"=>0],"order"=>"ordernum asc" ],
        "user_role"=>       ["column"=>['roleid','rolename'] ,"where"=>[],"order"=>"" ],
        "kuaidi_company"=>       ["column"=>['id','name'] ,"where"=>[],"order"=>"ordernum" ],
        
    ];
    public function __construct() {
        global $login;
        $this->search['store']['or_where']['siteid']= $login['id'];
        $this->search['sale_payment']['or_where']['siteid']= $login['id'];
        $this->search['sale_platform']['or_where']['siteid']= $login['id'];
    }
    
    public function showonepview() {
        $proobj= self::$ci->db->from(PREFIX.'sale')->where([
            'id'=>addslashes(self::$ci->uri->segment(3)) ,
            "siteid"=> $this->login['id'] ])->get()->result_array();
        if(empty($proobj)){
            header("Location:/home/sale_list/");exit;
        }
        $carefee=self::$ci->db->from(PREFIX.'care')->where(['pid'=>addslashes(self::$ci->uri->segment(3))    ,"siteid"=> $this->login['id']      ] )->get()->result_array();
        if(empty($carefee)){
            $carefee=0;
        } else {
            $carefee=$carefee[0];
        }
        
        return 
            self::$ci->load->view("sale/SaleEddView4",array_merge ([
                "menu"=>$this->MenuView(),
                "product"=>$proobj[0],
                "carefee"=>$carefee,
            ],json_decode($this->SearchHeader(),true) ) );

    }
    public function updae_p() {
        self::$ci->load->model("SaleModel4");
        self::$ci->SaleModel4->PUpdate($this->login['id']);
    }
}

