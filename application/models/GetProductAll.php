<?php

class GetProductAll extends CI_Model{
     private  $count=0;
    public function ProductAll($title,$pid,$cityid,$page,$z=20){
        $where=[
            "p.status"=>1, #在库
            "p.datetime  < "=>  strtotime("-1 day") , #发布时间超过24小时的
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
    /*
         * 
desc select p.pid ,p.title ,p.saleprice,s.name as sname ,c.name as cname ,pr.name as prname,sa.name as saname from
            uz_product p
        inner join uz_store s on s.id=p.storeid
        inner join uz_city  c on c.id=p.cityid
        inner join uz_product_status pr on pr.id=p.status
        inner join uz_sale_payment sa on sa.id =p.payment
    where p.status=1 and   p.datetime < 1498023411  ORDER by p.id desc limit 34,3
         */
}
