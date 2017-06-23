<?php
#全网库存，非超级管理员 的角色全部按该方法处理
class Product999 extends CAbstract{
    use Trait_;
    protected $search=[
        "city"=>            ["column"=>["name","id"], "where"=>[] ,"order"=>"ordernum asc" ], # 地点，城市
    ];
    public function showallview() {
        $this->SearchHeader();
        $this->CI_obj()->load->view("product_list/ProductViewList999",[
            "menu"=>$this->MenuView(),
            "data"=>$this->getdata(),
            "search"=> self::$searchdata,
            "page"=> self::page_html("home/product_list",  $this->CI_obj()->all->get_count()  )
        ]);
    }
    public function getdata() {
       $this->CI_obj()->load->model("GetProductAll","all");
       $data=$this->CI_obj()->all->ProductAll(
               self::$ci->input->get("title") ,
               self::$ci->input->get("pid") ,
               self::$ci->input->get("cityid") ,(int) self::$ci->uri->segment(3)
              );
       return json_encode($data);
    }



}

