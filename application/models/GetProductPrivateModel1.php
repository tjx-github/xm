<?php
class GetProductPrivateModel1 extends CI_Model{
    private $count=0;
    static private $where=[
        ""
    ];
    
    public function __construct() {
        parent::__construct();
        
        
        
    }

    public function GetData($page,$z=20){
        $this->count=$this->db->from("uz_product p")
                    ->select(" count(p.id) as count")
                    ->join("uz_store s","s.id=p.storeid")
                    ->join("uz_city c","c.id=p.cityid ")
                    ->join("uz_product_status pr","pr.id=p.status")
                    ->where("p.siteid=0")
                    ->where(self::$where)
                    ->get()
                    ->result_array();
        return
            $this->db->from("uz_product p")
                    ->select(" p.id,p.pid ,p.title,p.size,p.facephoto,p.saletype,p.costprice,c.name as cname,s.name as sname,p.storedate,pr.name as prname,p.id as key ")
                    ->join("uz_store s","s.id=p.storeid")
                    ->join("uz_city c","c.id=p.cityid ")
                    ->join("uz_product_status pr","pr.id=p.status")
                    ->where("p.siteid=0 ")->where(self::$where)
                    ->order_by("p.id desc")
                    ->limit($z, $page > 1 ? ($page-1) * $z:0 )
                    ->get()
                    ->result_array();
    }
    public function Download(){
        
    }
    public function GetCount(){
        if(empty($this->count)){
            return $this->count;
        }else{
            return $this->count[0]['count'];
        }
    }
}
//select 
//            p.id,p.pid ,p.title,p.size,p.facephoto,p.costprice,c.name as cname,s.name as sname,p.storedate,pr.name as prname
//from
//            uz_product p
//        inner join uz_store s on s.id=p.storeid
//        inner join uz_city  c on c.id=p.cityid
//        inner join uz_product_status pr on pr.id=p.status
//    where p.siteid=0  and p.pid='BE226'