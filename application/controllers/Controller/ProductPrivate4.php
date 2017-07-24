<?php
global $login;
#合作商  
class ProductPrivate4 extends CAbstract{
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
    ];
    public function __construct() {
        global $login;
        $this->search['store']['or_where']['siteid']= $login['id'];
        $this->search['sale_payment']['or_where']['siteid']= $login['id'];
        $this->search['sale_platform']['or_where']['siteid']= $login['id'];
    }
    public function showpview(){
        self::$ci->load->model("GetProductPrivateModel4"); 
        self::DownloadXml($this->login['id']);
        if(self::$ci->input->is_ajax_request()){
            return self::PushAjaxView($this->login['id']);
        }
        return self::$ci->load->view(
                "product_list/GetProductPrivateView4",[
                "data"=> json_encode(
                        self::$ci->GetProductPrivateModel4->ProductAll( $this->login['id'] , 
                                (int) self::$ci->uri->segment(3)  , 
                                self::$PageNumber )),
                "menu"=>$this->MenuView(),
                "page"=> self::page_html("/home/product_private_list", self::$ci->GetProductPrivateModel4->GetCount() ),
                "search"=> $this->SearchHeader(),
                "count"=> self::$ci->GetProductPrivateModel4->GetCount()
        ]);
    }
    private static function PushAjaxView($loginid){
        return self::$ci->load->view(
            "product_list/GetProductPrivateViewajax4",[
                "data"=> json_encode(self::$ci->GetProductPrivateModel4->ProductAll( $loginid , 
                                (int) self::$ci->uri->segment(3)  , 
                                self::$PageNumber ) ,true),
                "page"=> self::page_html("/home/product_private_list", self::$ci->GetProductPrivateModel4->GetCount()),
                "count"=> self::$ci->GetProductPrivateModel4->GetCount()
            ]);
    }
    private static function DownloadXml($id){
        if(isset($_GET['download'])){
            \CExport::downloadxml([
                'id','商品编号','产品名称','配件款式','成本价','销售价','所在城市','所属仓库','入库日期','状态'
                ], self::$ci->GetProductPrivateModel4->download($id)
            );
        }
    }
    public function showonepview(){
        self::$ci->load->model("GetProductPrivateModel4");
        $data=self::$ci->GetProductPrivateModel4->ProductOne( $this->login['id'] ,(int) self::$ci->uri->segment(3) );
        
        if(empty($data)){
            header("location: /home/product_private_list");
            exit;
        }
        $this->CI_obj()->load->view("product_list/ProductShowOneView4",[
            "menu"=>$this->MenuView(),
            "product"=> $data[0]  ,
            "search" => json_decode($this->SearchHeader(),true)
        ]);
    }
    public function updae_p(){
        self::$ci->load->model("GetProductPrivateModel4");   
        self::$ci-> GetProductPrivateModel4 ->update_p($this->login['id']);

    }
}


