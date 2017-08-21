<?php
class OwnerSearchDownload extends CI_Model{
    static $set;
    static function get($varname,&$get=false,$key=false){
//        if(isset($_GET[$varname]) && ! empty($_GET[$varname]) ) {
        if(isset($_GET[$varname]) && $_GET[$varname] !== "" ) {
            is_array($_GET[$varname]) and exit("不允许 array 类型");
            if($get !== false){
                $get= addslashes( strip_tags($_GET[$varname]));
            }
            return addslashes( strip_tags($_GET[$varname]));
        }else{
            if($key !== FALSE){
                unset(self::$set[$key]);
            }
            return FALSE;
        }
    }
    
    public function DownloadData(){
    
        $where=[];
        self::$set=&$where;
        self::get("title") && $where['s.title like'] = "%". self::get("title") ."%";
        self::get("pid") && $where['s.pid like'] = "%". self::get("pid") ."%";
        
        self::get("receiver",$where['s.receiver'],"s.receiver");
        self::get("saleman",$where['s.saleman'],"s.saleman");
        self::get("cid",$where['s.cid'],"s.cid" );
        self::get("saletype",$where['s.saletype'] ,"s.saletype");
        self::get("saleplatform",$where['s.saleplatform'],"s.saleplatform");
        self::get("agentid",$where['s.agentid'],"s.agentid");
        self::get("payment",$where['s.payment'],"s.payment");
        if(self::get("admin")){
            if(self::get("admin") == 'false'){
                $where['s.siteid'] =0;
            }
        }
        self::get("ispayback",$where['s.ispayback'],"s.ispayback");
        if(isset($_GET['startday']) and strtotime($_GET['startday'])){
             $where["s.datetime > "] =strtotime($_GET['startday']);
        }
        if(isset($_GET['endday']) and strtotime($_GET['endday'])){
             $where["s.datetime < "] =strtotime($_GET['enddate']);
        }
        if(self::get("checktime") and $_GET['checktime'] == "today"){
            $where['saletime >='] =strtotime("-7 day");
            $where['saletime <'] =strtotime("-6 day");
        }
        self::get("owner",$where['p.owner'],"p.owner" );
//        return 
        return
            $this->db->from("uz_sale s")
//                ->select("s.pid,s.title,s.cid,a.AdminExplain")
                ->select("s.pid,s.title,s.cid,if(u.fullname is null ,'总部',u.fullname) as fullname ,pr.name as prname,
                            pl.name as xx,
                            s.price,
                         s.preprice,s.costprice,s.otherfee,s.carefee,s.platformfee  ,
                         s.kuaidifee,s.siteprofit,s.saleman,s.receiver,sa.name as zfname,
                         s.kuaidicompany,s.kuaidinum ,if(s.ispayback = 1 ,'已结款','未结款') as zt,
                         from_unixtime(s.saletime) as date,
                    
                ")
                ->join("uz_product p","s.pid=p.pid","left")
                ->join("uz_sale_payment sa","sa.id=p.payment","left")
                ->join("uz_user u","u.id=s.siteid","left")
                ->join("uz_product_status pr","pr.id=s.saletype","left")
                ->join("uz_sale_platform pl","pl.id=s.saleplatform","left")
                ->where($where)
                ->order_by("s.id")
                ->get()
                ->result_array();
    }
}

