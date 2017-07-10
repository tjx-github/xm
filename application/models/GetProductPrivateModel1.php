<?php
use Model\IsOrGet as IG;
class GetProductPrivateModel1 extends CI_Model{
    use Trait_Img;
    private $count=0;
    static private $where=[
        "p.siteid"=>0 , # 美工只允许修改属于总部的库存
    ];
    
    public function __construct() {
        parent::__construct();
        IG::set(self::$where);
        IG::get("title") and self::$where['p.title LIKE  '] ="%". IG::get("title") ."%";
        IG::get("pid", self::$where['p.pid'],'p.pid' );
        IG::get("size", self::$where['p.size'],"p.size" );
        IG::get("saletype", self::$where['p.saletype'],"p.saletype" );
        IG::get("category", self::$where['p.category'],"p.category" );
        IG::get("storeid", self::$where['p.storeid'],"p.storeid" );
        IG::get("status", self::$where['p.status'],"p.status" );
        IG::get("cityid", self::$where['p.cityid'],"p.cityid" );
        IG::get("havephoto", self::$where['p.havephoto'],"p.havephoto" );
        IG::get("payment", self::$where['p.payment'],"p.payment" );
        IG::get("receiver") && self::$where['p.receiver LIKE  '] = IG::get("receiver") ."%";
        IG::get("owner") && self::$where['p.owner LIKE  '] = IG::get("owner") ."%";
        IG::get("bz") && self::$where['p.content LIKE  '] = "%".IG::get("bz") ."%";
        IG::get("startday") && strtotime(IG::get("startday")) && self::$where['p.datetime >  '] = strtotime(IG::get("startday"));
        IG::get("endday") && strtotime(IG::get("endday")) && self::$where['p.datetime  <  '] = strtotime(IG::get("endday"));
    }
    

    public function GetData($page,$z=20){
        $this->count=$this->db->from("uz_product p")
                    ->select(" count(p.id) as count")
                    ->join("uz_store s","s.id=p.storeid")
                    ->join("uz_city c","c.id=p.cityid ")
                    ->join("uz_product_status pr","pr.id=p.status")
                    ->where(self::$where)
                    ->get()
                    ->result_array();
        return
            $this->db->from("uz_product p")
                    ->select(" p.id,p.pid ,p.title,p.size,p.facephoto,p.saletype,p.costprice,c.name as cname,s.name as sname,p.storedate,pr.name as prname,p.id as key ")
                    ->join("uz_store s","s.id=p.storeid")
                    ->join("uz_city c","c.id=p.cityid ")
                    ->join("uz_product_status pr","pr.id=p.status")
                    ->where(self::$where)
                    ->order_by(IG::date_sort( "get")? IG::date_sort( "get") : "p.id desc")
                    ->limit($z, $page > 1 ? ($page-1) * $z:0 )
                    ->get()
                    ->result_array();
    }
//    public function Download(){ #美工不需要下载
//        
//    }
    public function GetCount(){
        if(empty($this->count)){
            return $this->count;
        }else{
            return $this->count[0]['count'];
        }
    }
    public  function boo($id){
        return  $this->db->from("uz_product p")
                    ->select(" c.name as cname,s.name as sname,pr.name as prname,p.* ")
                    ->join("uz_store s","s.id=p.storeid")
                    ->join("uz_city c","c.id=p.cityid ")
                    ->join("uz_product_status pr","pr.id=p.status")
                    ->where("p.siteid=0 and p.id='{$id}'")
                    ->limit(1)
                    ->get()
                    ->result_array();
    }
    public function GetOne(int $id){
            return $this->boo($id );
    }
    public function UpdateOne($id){
        if(! empty($this->boo($id))){
            $data=[];
            IG::set($data);
            IG::post("content",$data['content'],"content" );
            IG::post("facephoto") && $data['facephoto']=self::imgjson($_POST['facephoto']) ;
            self::imgjson($_POST['img']);
            if(isset($_POST['img']) and !empty($_POST['img']) ){
                $data['photos']= json_encode($_POST['img']);
            }
            $this->db->where(['id'=>$id,"siteid"=>0]);
            if($this->db->update(PREFIX.'product',$data)){
                echo "更改成功";
            }else{
                echo "错误！更改失败，请联系程序员^_^";
            }
        }else{
            echo "错误！不存在该数据";
        }
    }
}
