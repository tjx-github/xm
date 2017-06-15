<?php

class ProductRoleDataList5 extends ProductAbstract{
    use Trait_;
    public function __construct() {
        $this->GetSearchBlock();
    }
    protected $table=[
        "product_status"=>  [ "column"=>[ "id","name" ],  "where"=>[],"order"=>"ordernum asc" ], #库存状态
        "category"=>        ["column"=>["id","name"] ,    "where"=>[],"order" =>"ordernum asc" ], #物品类别
        "city"=>            ["column"=>["id","name"] ,    "where"=>[],"order"=>"ordernum asc" ],#地址
        "store"=>           ["column"=>["id","name"] ,    "where"=>["siteid"=>SITEID],"order" =>"ordernum asc" ] ,#厂库
        "user"=>            ["column"=>["fullname","id"], "where"=>["roleid"=>3] ,"order"=>"id asc" ],#用户
        "city"=>            ["column"=>["name","id"], "where"=>[]            ,"order"=>"ordernum asc" ], # 地点，城市
        "sale_payment"=>["column"=>['id','name'] ,"where"=>[],"order"=>"ordernum asc" ]
    ];
    public function showviewdata() {
//      echo $this->NavigateView;
//      print_r(self::$tabledata);
        
        $this->ci->load->view("product_list/productsubject",[
            "search"=>$this->ci->load->view("product_list/productsearch5",["sea" => self::$tabledata] ,true ),
            "navigateview"=>$this->NavigateView,
            "table"=>$this->ci->load->view("product_list/ProductViewList5",[],true  )
        ]);
        echo "
            <script>
                console.log( ". json_encode(self::$tabledata)  .")
            </script>
            
";

    }

    public function searchview() {
        
    }

}

