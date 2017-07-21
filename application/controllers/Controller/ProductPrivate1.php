<?php
#美工
class ProductPrivate1 extends CAbstract{
    use Trait_;
    protected $search=[
        "product_status"=>  ["column"=>[ "id","name" ],  "where"=>[],"order"=>"ordernum asc" ], #库存状态
        "category"=>        ["column"=>["id","name"] ,    "where"=>[],"order" =>"ordernum asc" ], #物品类别
        "city"=>            ["column"=>["id","name"] ,    "where"=>[],"order"=>"ordernum asc" ],#地址
        "store"=>           ["column"=>["id","name"] ,    "where"=>["siteid"=>0],"order" =>"ordernum asc" ] ,#厂库,美工只能修改总部库存。所以给0
        "city"=>            ["column"=>["name","id"],     "where"=>[]            ,"order"=>"ordernum asc" ], # 地点，城市
        "sale_payment"=>    ["column"=>['id','name'] ,    "where"=>["siteid"=>0  ],"order"=>"ordernum asc" ],
        "saleman"=>         ["column"=>['id','name'] ,    "where"=>[],"order"=>"ordernum asc" ],
        "sale_platform"=>   ["column"=>['id','name'] ,   "where"=>[],"order"=>"ordernum asc" ],
        "user_role"=>       ["column"=>['roleid','rolename'] ,"where"=>[],"order"=>"" ],
    ];
    public function showpview() {
        self::$ci->load->model("GetProductPrivateModel1");
        if(self::$ci->input->is_ajax_request()){
            return self::ajax_data();
        }
        $dat=self::$ci->GetProductPrivateModel1->GetData((int) self::$ci->uri->segment(3), self::$PageNumber );
        self::$ci->load->view(
             "product_list/GetProductPrivateView1",
             [
                 "menu"=>$this->MenuView(),
                 "data"=> json_encode($dat),
                 "pagelink"=> self::page_html("/home/product_private_list",self::$ci->GetProductPrivateModel1->GetCount() ),
                 "search"=> $this->SearchHeader()
             ]
        );
    }
    private static function ajax_data(){
        return
                self::$ci->load->view(
                     "product_list/GetProductPrivateViewajax1",
                     [
                         "data"=> json_encode(self::$ci->GetProductPrivateModel1->GetData(0,self::$ci->config->item("page_config")['per_page'])),
                         "pagelink"=> self::page_html("/home/product_private_list",self::$ci->GetProductPrivateModel1->GetCount() ),
                     ]
                );
    }

    public function showonepview() {
        self::$ci->load->model("GetProductPrivateModel1");
        $data=self::$ci-> GetProductPrivateModel1->GetOne((int)self::$ci->uri->segment(4));
        if(empty($data)){
            header("location: /home/product_private_list");
            exit;
        }
        return  self::$ci->load->view("product_list/ProductShowOneP1",array_merge([
                "menu"=>$this->MenuView(),
                "product"=>$data[0]
            ], json_decode($this->SearchHeader(),true)  ));
    }
    public function updae_p(){
        self::$ci->load->model("GetProductPrivateModel1");
        self::$ci-> GetProductPrivateModel1->UpdateOne((int) Model\IsOrGet::post("id"));
    }
}
