<?php
#全网库存，非超级管理员 的角色全部按该方法处理
class Product999 extends CAbstract{
    use Trait_;
    protected $search=[
        "city"=>            ["column"=>["name","id"], "where"=>[] ,"order"=>"ordernum asc" ], # 地点，城市
    ];
 
    public function showallview() {
        $this->CI_obj()->load->model("GetProductAllModel999","all");
        if(isset($_GET["download"])){
            \ CExport::downloadxml([
                "商品编号","产品名称","产品类别","销售价","代理价","地点"
                ], $this->getdata(TRUE),['id']);
        }

        $this->CI_obj()->load->view("product_list/ProductViewList999",[
            "menu"=>$this->MenuView(),
            "data"=>$this->getdata(),
            "search"=> $this->SearchHeader(),
            "count"=>$this->CI_obj()->all->get_count() ,
            "page"=> self::page_html("home/product_list",  $this->CI_obj()->all->get_count()  )
        ]);
    }
    public function getdata($boo=false) {
       $data=$this->CI_obj()->all->ProductAll(
               self::$ci->input->get("title") ,
               self::$ci->input->get("pid") ,
               self::$ci->input->get("cityid") ,(int) self::$ci->uri->segment(3)
              );
       if($boo){
            $data=$this->CI_obj()->all->ProductAll(
               self::$ci->input->get("title") ,
               self::$ci->input->get("pid") ,
               self::$ci->input->get("cityid") ,(int) self::$ci->uri->segment(3),self::$PageNumber,1
              );
           return $data;
       }
       return json_encode($data);
    }
    
    public function showoneaview() {
        $this->CI_obj()->load->model("GetProductAllModel999","all");
        $data=$this->CI_obj()->all->getaone(  $this->CI_obj()->input->get("pid") );
        empty($data) && exit("抱歉。找不到相应数据");
        $this->CI_obj()->load->view(
                "product_list/ProductOneAView999",
                ["data"=> json_encode($data[0])]
                );
        
    }


}

