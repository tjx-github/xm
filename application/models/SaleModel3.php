<?php

class SaleModel3 extends CI_Model{
    public $count=[];
    public function getdata($userid,$page,$z=20){
        $where["s.siteid"] =$userid;
        isset($_GET['title']) && $_GET['title'] && $where['s.title like']= "%".addslashes($_GET['title']) ."%";
        isset($_GET['pid']) && $_GET['pid'] && $where['s.pid']= addslashes($_GET['pid']);
        isset($_GET['receiver']) && $_GET['receiver'] && $where['s.receiver']= addslashes($_GET['receiver']);
        isset($_GET['saleman']) && $_GET['saleman'] && $where['s.saleman']= addslashes($_GET['saleman']);
        isset($_GET['cid']) && $_GET['cid'] && $where['s.cid']= addslashes($_GET['cid']);
        isset($_GET['saletype']) && $_GET['saletype'] && $where['s.saletype']= (int) $_GET['saletype'];
        isset($_GET['saleplatform']) && $_GET['saleplatform'] && $where['s.saleplatform']= (int) $_GET['saleplatform'];
        isset($_GET['payment']) && $_GET['payment'] && $where['s.payment']= (int) $_GET['payment'];
        isset($_GET['ispayback']) && $_GET['ispayback'] && $where['s.ispayback']= addslashes($_GET['ispayback']);
        if(isset($_GET['startday']) and strtotime($_GET['startday']) and isset($_GET['enddate']) and strtotime($_GET['enddate'])){
            $where["s.datetime > "] =strtotime($_GET['startday']);
            $where["s.datetime < "] =strtotime($_GET['enddate']);
            
        }
        $this->count=
            $this->db->from("uz_sale s")
                ->select("count(*) as count")
                ->join("uz_sale_platform pl ","s.saleplatform =pl.id","left")
                ->join("uz_sale_payment pa " ,"pa.id=s.payment","left")
                ->join("uz_product_status st ","st.id=s.saletype ","left")
                ->where($where)
                ->get()->result_array();
        return
            $this->db->from("uz_sale s")
                ->select("s.* ,pl.name as plname,pa.name as paname,st.name as stname")
                ->join("uz_sale_platform pl ","s.saleplatform =pl.id","left")
                ->join("uz_sale_payment pa " ,"pa.id=s.payment","left")
                ->join("uz_product_status st ","st.id=s.saletype ","left")
                ->where($where)
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
        $where["s.siteid"] =$id;
        isset($_GET['title']) && $_GET['title'] && $where['s.title like']= "%".addslashes($_GET['title']) ."%";
        isset($_GET['pid']) && $_GET['pid'] && $where['s.pid']= addslashes($_GET['pid']);
        isset($_GET['receiver']) && $_GET['receiver'] && $where['s.receiver']= addslashes($_GET['receiver']);
        isset($_GET['saleman']) && $_GET['saleman'] && $where['s.saleman']= addslashes($_GET['saleman']);
        isset($_GET['cid']) && $_GET['cid'] && $where['s.cid']= addslashes($_GET['cid']);
        isset($_GET['saletype']) && $_GET['saletype'] && $where['s.saletype']= (int) $_GET['saletype'];
        isset($_GET['saleplatform']) && $_GET['saleplatform'] && $where['s.saleplatform']= (int) $_GET['saleplatform'];
        isset($_GET['payment']) && $_GET['payment'] && $where['s.payment']= (int) $_GET['payment'];
        isset($_GET['ispayback']) && $_GET['ispayback'] && $where['s.ispayback']= addslashes($_GET['ispayback']);
        if(isset($_GET['startday']) and strtotime($_GET['startday']) and isset($_GET['enddate']) and strtotime($_GET['enddate'])){
            $where["s.datetime > "] =strtotime($_GET['startday']);
            $where["s.datetime < "] =strtotime($_GET['enddate']);
        }
        return
            $this->db->from("uz_sale s")
//                ->select("s.* ,pl.name as plname,pa.name as paname,st.name as stname")
                ->select("s.id,s.pid,s.title,st.name as stname,s.price,s.costprice,s.preprice,s.saleman,s.otherfee,s.kuaidifee,s.siteprofit,FROM_UNIXTIME(s.saletime) as saletime")
                ->join("uz_sale_platform pl ","s.saleplatform =pl.id","left")
                ->join("uz_sale_payment pa " ,"pa.id=s.payment","left")
                ->join("uz_product_status st ","st.id=s.saletype ","left")
                ->where($where)
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
