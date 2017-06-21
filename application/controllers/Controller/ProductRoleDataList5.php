<?php

class ProductRoleDataList5 extends CAbstract{
    use Trait_;
    protected $search=[
        "product_status"=>  [ "column"=>[ "id","name" ],  "where"=>[],"order"=>"ordernum asc" ], #库存状态
        "category"=>        ["column"=>["id","name"] ,    "where"=>[],"order" =>"ordernum asc" ], #物品类别
        "city"=>            ["column"=>["id","name"] ,    "where"=>[],"order"=>"ordernum asc" ],#地址
        "store"=>           ["column"=>["id","name"] ,    "where"=>["siteid"=>SITEID],"order" =>"ordernum asc" ] ,#厂库
        "user"=>            ["column"=>["fullname","id"], "where"=>["roleid"=>3] ,"order"=>"id asc" ],#用户
        "city"=>            ["column"=>["name","id"], "where"=>[]            ,"order"=>"ordernum asc" ], # 地点，城市
        "sale_payment"=>["column"=>['id','name'] ,"where"=>[],"order"=>"ordernum asc" ]
    ];
    public function showviewdata() {
        
    }
    public function GetSearchBlock() {
        
    }

    public function searchview() {
        
    }

}

