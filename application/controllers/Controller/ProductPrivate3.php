<?php
#代理商，我的库存列表
class ProductPrivate3 extends CAbstract{
    use Trait_;
    protected $search=[
        "city"=>            ["column"=>["name","id"], "where"=>[]            ,"order"=>"ordernum asc" ], # 地点，城市
    ];
    public function showpview() {
        $this->CI_obj()->load->model("GetProductPrivateModel3");
        $this->download();
        $this->SearchHeader();
        $this->CI_obj()->load->view("product_list/ProductPrivateViewList3",[
            "menu"=>$this->MenuView(),
            "data"=>$this->getdata(),
            "search"=> self::$searchdata,
            "page"=> self::page_html("home/product_private_list",  $this->CI_obj()->GetProductPrivateModel3->get_count()  ),
            "count"=> $this->CI_obj()->GetProductPrivateModel3->get_count()  
        ]);
//         $this->MenuView();
    }
    public function download(){
    if(isset($_GET['download'])){
        \CExport::downloadxml([  "商品编号","产品名称","产品类别","销售价","代理价","地点"], 
            $this->CI_obj()->GetProductPrivateModel3->GetDownloadData(
               self::$ci->input->get("title") ,
               self::$ci->input->get("pid") ,
               self::$ci->input->get("cityid") 
              )
                , ["id"]);
        }
    }
    public function getdata() {
       $data=$this->CI_obj()->GetProductPrivateModel3->ProductAll(
               self::$ci->input->get("title") ,
               self::$ci->input->get("pid") ,
               self::$ci->input->get("cityid") ,(int) self::$ci->uri->segment(3)
              );
       return json_encode($data);
    }
    public function showonepview() {
        $this->CI_obj()->load->model("GetProductPrivateModel3");
        $data=$this->CI_obj()->GetProductPrivateModel3->getaone(  $this->CI_obj()->input->get("pid") );
        empty($data) && exit("抱歉。找不到相应数据");
        $this->CI_obj()->load->view(
                "product_list/ProductOnePrivateView3",
                ["data"=> json_encode($data[0])]
                );
    }
   
}
