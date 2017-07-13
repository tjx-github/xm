<?php
use Model\IsOrGet as GT;
class SaleModel3 extends CI_Model{
    public $count=[];
    static $where=[];
    public function __construct() {
        parent::__construct();
        GT::set(self::$where);
        GT::get("title")  &&  self::$where['s.title like']= "%".GT::get("title")  ."%";
        GT::get('pid',self::$where['s.pid'],'s.pid');
        GT::get('receiver',self::$where['s.receiver'],"s.receiver");
        GT::get("saleman",self::$where['s.saleman'],"s.saleman" );
        GT::get("cid",self::$where['s.cid'],"s.cid");
        GT::get('saletype',self::$where['s.saletype'],"s.saletype");
        GT::get("saleplatform",self::$where['s.saleplatform'],"s.saleplatform");
        GT::get('payment',self::$where['s.payment'],"s.payment");
        GT::get("ispayback",self::$where['s.ispayback'],"s.ispayback");
    }
    public function getdata($userid,$page,$z=20){
        self::$where["s.siteid"] =$userid;
        
        if(isset($_GET['startday']) and strtotime($_GET['startday']) and isset($_GET['enddate']) and strtotime($_GET['enddate'])){
            self::$where["s.datetime > "] =strtotime($_GET['startday']);
            self::$where["s.datetime < "] =strtotime($_GET['enddate']); 
        }
        $this->count=
            $this->db->from("uz_sale s")
                ->select("count(*) as count")
                ->join("uz_sale_platform pl ","s.saleplatform =pl.id","left")
                ->join("uz_sale_payment pa " ,"pa.id=s.payment","left")
                ->join("uz_product_status st ","st.id=s.saletype ","left")
                ->where(self::$where)
                ->get()->result_array();
        return
            $this->db->from("uz_sale s")
                ->select("s.* ,pl.name as plname,pa.name as paname,st.name as stname")
                ->join("uz_sale_platform pl ","s.saleplatform =pl.id","left")
                ->join("uz_sale_payment pa " ,"pa.id=s.payment","left")
                ->join("uz_product_status st ","st.id=s.saletype ","left")
                ->where(self::$where)
                ->order_by("s.id desc")
                ->limit($z, $page > 1 ? ($page-1) * $z:0 )
                ->get()
                ->result_array();
    }
    public function getcount(){
        if(empty( $this->count )){
            return 0;
        }else{
            return $this->count[0]['count'];
        }
    }
    public function GetDownloadData($id){
        self::$where["s.siteid"] =$id;
        if(isset($_GET['startday']) and strtotime($_GET['startday']) and isset($_GET['enddate']) and strtotime($_GET['enddate'])){
            self::$where["s.datetime > "] =strtotime($_GET['startday']);
            self::$where["s.datetime < "] =strtotime($_GET['enddate']);
        }
        return
            $this->db->from("uz_sale s")
                ->select("s.id,s.pid,s.title,st.name as stname,s.price,s.costprice,s.preprice,s.saleman,s.otherfee,s.kuaidifee,s.siteprofit,FROM_UNIXTIME(s.saletime) as saletime")
                ->join("uz_sale_platform pl ","s.saleplatform =pl.id","left")
                ->join("uz_sale_payment pa " ,"pa.id=s.payment","left")
                ->join("uz_product_status st ","st.id=s.saletype ","left")
                ->where(self::$where)
                ->order_by("s.id desc")
                ->get()
                ->result_array();
    }
}

/*select s.* ,pl.name as plname,pa.name as paname,st.name as stname  from uz_sale s
    left join uz_sale_platform pl on s.saleplatform =pl.id
    left join uz_sale_payment pa on pa.id=s.payment
    left join uz_product_status st on st.id=s.saletype 
where s.siteid =75 
    
 */
