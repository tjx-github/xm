<?php
use Model\IsOrGet as IG;
class GetProductPrivateModel4 extends CI_Model{
    use \Model\Trait_Count,  \Model\Trait_Img;
    static private $where=[];
    static private $count=0;
    
    public function ProductOne($UserCode,$id){
        return
            $this->db
                ->from("uz_product p")
                ->select("p.*,ca.name as caname,c.name as cname,pr.name as prname,st.name as stname")
                ->join("uz_store s","s.id=p.storeid","inner")
                ->join("uz_category ca","ca.id=p.category")
                ->join("uz_city  c","c.id=p.cityid","inner")
                ->join("uz_product_status pr","pr.id=p.status")
                ->join("uz_store st","st.id=p.storeid")
                ->where(["p.siteid"=>$UserCode,'p.id'=>$id])
                ->limit(1)
                ->get()
                ->result_array();
    }
    
    
    public function ProductAll($siteid,$page,$z=20){
        self::$where=["p.siteid"=>$siteid];
        self::wh();
        self::$count= $this->db
                ->from("uz_product p")
                ->select("count(p.pid) as count")
                ->join("uz_store s","s.id=p.storeid","inner")
                ->join("uz_category ca","ca.id=p.category")
                ->join("uz_city  c","c.id=p.cityid","inner")
                ->where(self::$where)
                ->get()
                ->result_array();

        return
            $this->db
                ->from("uz_product p")
                ->select("p.*,ca.name as caname,c.name as cname,pr.name as prname,st.name as stname")
                ->join("uz_store s","s.id=p.storeid","inner")
                ->join("uz_category ca","ca.id=p.category")
                ->join("uz_city  c","c.id=p.cityid","inner")
                ->join("uz_product_status pr","pr.id=p.status")
                ->join("uz_store st","st.id=p.storeid")
                ->where(self::$where)
                ->limit($z, $page > 1 ? ($page-1) * $z:0 )
                ->order_by(IG::date_sort( "get")? IG::date_sort( "get","p.") : "p.id desc")
                ->get()
                ->result_array();
    }

    public function download($id){
        self::$where=["p.siteid"=>$id];
        self::wh();
        return
            $this->db
                ->from("uz_product p")
                ->select("p.id,p.pid,p.title,p.size,p.costprice,p.saleprice,ca.name as caname,st.name as stname ,FROM_UNIXTIME(p.storedate) as p,pr.name as prname")
                ->join("uz_store s","s.id=p.storeid","inner")
                ->join("uz_category ca","ca.id=p.category")
                ->join("uz_city  c","c.id=p.cityid","inner")
                ->join("uz_product_status pr","pr.id=p.status")
                ->join("uz_store st","st.id=p.storeid")
                ->where(self::$where)
                ->order_by(IG::date_sort( "get")? IG::date_sort( "get","p.") : "p.id desc")
                ->get()
                ->result_array();
    }
    static public function wh(){
        IG::set(self::$where);
        IG::set(self::$where);
        IG::get("title") and self::$where['p.title LIKE  '] ="%". IG::get("title") ."%";
//        IG::get("pid", self::$where['p.pid'],'p.pid' );
        IG::get("pid") and self::$where['p.pid like'] =IG::get("pid") ."%" ;
        
        IG::get("size", self::$where['p.size'],"p.size" );
        IG::get("saletype", self::$where['p.saletype'],"p.saletype" );
        IG::get("category", self::$where['p.category'],"p.category" );
        IG::get("storeid", self::$where['p.storeid'],"p.storeid" );
        IG::get("status", self::$where['p.status'],"p.status" );
        IG::get("cityid", self::$where['p.cityid'],"p.cityid" );
        if(IG::get("video")){
            if((int) IG::get("video") == 1){
                self::$where['p.video  !='] ="";
            }else{
                self::$where['p.video'] ="";
            }
        }
        IG::get("havephoto", self::$where['p.havephoto'],"p.havephoto" );
        IG::get("payment", self::$where['p.payment'],"p.payment" );
        IG::get("receiver") && self::$where['p.receiver LIKE  '] = "%".IG::get("receiver") ."%";
        IG::get("owner") && self::$where['p.owner LIKE  '] = "%".IG::get("owner") ."%";
        IG::get("bz") && self::$where['p.content LIKE  '] = "%".IG::get("bz") ."%";
        IG::get("startday") && strtotime(IG::get("startday")) && self::$where['p.datetime >  '] = strtotime(IG::get("startday"));
        IG::get("endday") && strtotime(IG::get("endday")) && self::$where['p.datetime  <  '] = strtotime(IG::get("endday"));
    }
    
    public  function update_p($uid){
        $data=[];
        $b=$this->db->from(PREFIX.'product')->where([
            "id"=>IG::post("id"),
            "siteid"=>$uid,
            "datetime  >" => strtotime("-1 day")
        ])->get()-> result_array();
        if(empty($b)){
            exit("不可修改！发布已超24小时！");
        }

        IG::set($data);
        IG::post("facephoto") and  $data["facephoto"]=self::imgjson($_POST['facephoto']);
        if(isset($_POST['img']) and !empty($_POST['img']) ){
            self::imgjson($_POST['img']);
            $data['photos']= json_encode($_POST['img']);
        }
        IG::post("title",$data['title'],"title" );
        IG::post("size",$data['size'],"size" );
        IG::post("category",$data['category'],"category" );
        IG::post("saletype",$data['saletype'],"saletype" );
        IG::post("storeid",$data['storeid'],"storeid" );
        IG::post("costprice",$data['costprice'],"costprice" );
        IG::post("saleprice",$data['saleprice'],"saleprice" );
        IG::post("rivalprice",$data['rivalprice'],"rivalprice" );
        IG::post("holdprice",$data['holdprice'],"holdprice" );
        IG::post("otherfee",$data['otherfee'],"otherfee" );
        IG::post("status",$data['status'],"status" );
        IG::post("cityid",$data['cityid'],"cityid" );
        IG::post("receiver",$data['receiver'],"receiver" );
        IG::post("owner",$data['owner'],"owner" );
        IG::post("payment",$data['payment'],"payment" );
        IG::post("storedate") AND  $data['storedate'] = strtotime($_POST['storedate']) ;
        IG::post("havephoto",$data['havephoto'],"havephoto" );
        IG::post("content",$data['content'],"content" );
        IG::post("pvideo",$data['video'],"video" );
        $this->db->where([
            "id"=>IG::post("id"),
            "siteid"=>$uid
        ]);
        $bool= $this->db->update(PREFIX.'product',$data);
       if($bool){
           echo "更改成功";
       }else{
           echo "更改失败";
       }
    }
    
    
    
}

