<?php

class GetProductPrivateModel3 extends CI_Model{
    private  $count=0;
    public function ProductAll($title,$pid,$cityid,$page,$z=20){
        global $login;
        $where=[
            "p.siteid"=>$login['id'], #用户id
//            "p.datetime  < "=>  strtotime("-1 day") , #发布时间超过24小时的
        ];
            $title && $where["p.title  like "]="%" . addslashes($title) . "%";
            $pid && $where['p.pid']=addslashes($pid);
            $cityid && $where["p.cityid"]=addslashes($cityid);
            $this->count=
                    $this->db->from("uz_product p")
                    ->select("count(p.id) as count")
                    ->join("uz_store s","s.id=p.storeid","inner")
                    ->join("uz_category ca","ca.id=p.category")
                    ->join("uz_city  c","c.id=p.cityid","inner")
                    ->where($where)
                    ->get()
                    ->result_array();

        return
            $this->db->from("uz_product p")
                    ->select("p.pid ,p.title,ca.name as caname,p.rivalprice ,p.saleprice,c.name as cname,p.id")
                    ->join("uz_store s","s.id=p.storeid","inner")
                    ->join("uz_category ca","ca.id=p.category")
                    ->join("uz_city  c","c.id=p.cityid","inner")
                    ->where($where)
                    ->order_by("p.id desc")
                    ->limit($z, $page > 1 ? ($page-1) * $z:0 )
                    ->get()
                    ->result_array();
                    
    }
    public  function get_count(){
        if(empty($this->count)){
            return 0;
        } else {
            return $this->count[0]['count'];
        }
    }
    public function getaone($id){
        global $login;
        $where=[
            "p.id"=>(int)$id, #在库
            "p.siteid"=>$login['id'], #用户id
//            "p.datetime  < "=>  strtotime("-1 day") , #发布时间超过24小时的
        ];
        return
            $this->db->from("uz_product p")
                    ->select("p.*,ca.name as caname,c.name as cname,pr.name as prname")
                    ->join("uz_store s","s.id=p.storeid","inner")
                    ->join("uz_category ca","ca.id=p.category","inner")
                    ->join("uz_city  c","c.id=p.cityid","inner")
                    ->join("uz_product_status pr","p.status=pr.id")
                    ->where($where)
                    ->get()
                    ->result_array();
    }
    public function GetDownloadData($title,$pid,$cityid){
        global $login;
        $where=[
            "p.siteid"=>$login['id'], #用户id
//            "p.datetime  < "=>  strtotime("-1 day") , #发布时间超过24小时的
        ];
        $title && $where["p.title  like "]="%" . addslashes($title) . "%";
        $pid && $where['p.pid']=addslashes($pid);
        $cityid && $where["p.cityid"]=addslashes($cityid);
        return
            $this->db->from("uz_product p")
                    ->select("p.pid ,p.title,ca.name as caname,p.rivalprice ,p.saleprice,c.name as cname,p.id")
                    ->join("uz_store s","s.id=p.storeid","inner")
                    ->join("uz_category ca","ca.id=p.category")
                    ->join("uz_city  c","c.id=p.cityid","inner")
                    ->where($where)
                    ->order_by("p.id desc")
                    ->get()
                    ->result_array();
            
    }
    
}