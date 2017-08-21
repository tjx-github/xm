<?php
use Model\IsOrGet as B;
class GetProductAllModel999 extends CI_Model{
     private  $count=0;
    public function ProductAll($title,$pid,$cityid,$page,$z=20,$boo=false){
        $where=[
            "p.status"=>1, #在库
            "p.datetime  < "=>  strtotime("-1 day") , #发布时间超过24小时的
        ];
            
            $title && $where["p.title  like "]="%" . addslashes($title) . "%";
            $pid && $where['p.pid']=addslashes($pid);
            $cityid && $where["p.cityid"]=addslashes($cityid);
//            isset($_GET['storeid']) and $_GET['storeid'] and $where['p.storeid']=(int)$_GET['storeid'] ;
            B::set($where);
            B::get("storeid",$where['p.storeid'],"p.storeid") ;
            B::get("category",$where['p.category'],"p.category");
            if(B::get("desc")){
                if(B::get("desc") == 1){
                    $or="p.saleprice desc";
                }else{
                    $or="p.saleprice asc";
                }
            }else{
                $or="p.id desc";
            }
            $this->count=
                    $this->db->from(PREFIX."product p")
                    ->select("count(p.id) as count")
                    ->join(PREFIX."store s","s.id=p.storeid","inner")
                    ->join(PREFIX."category ca","ca.id=p.category")
                    ->join(PREFIX."city  c","c.id=p.cityid","inner")
                    ->where($where)
                    ->get()
                    ->result_array();
            if($boo){
                return 
                    $this->db->from(PREFIX."product p")
                            ->select("p.pid ,p.title ,ca.name as caname,p.rivalprice ,p.saleprice,c.name as cname,p.id")
                            ->join(PREFIX."store s","s.id=p.storeid","inner")
                            ->join(PREFIX."category ca","ca.id=p.category")
                            ->join(PREFIX."city  c","c.id=p.cityid","inner")
                            ->where($where)
                            ->order_by($or)
                            ->get()
                            ->result_array();
            }
        return
            $this->db->from(PREFIX."product p")
                    ->select("p.pid ,p.title,p.facephoto,ca.name as caname,p.rivalprice ,p.saleprice,c.name as cname,p.id")
                    ->join(PREFIX."store s","s.id=p.storeid","inner")
                    ->join(PREFIX."category ca","ca.id=p.category")
                    ->join(PREFIX."city  c","c.id=p.cityid","inner")
                    ->where($where)
                    ->order_by($or)
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
        $where=[
            "p.id"=>(int)$id, #在库
            "p.datetime  < "=>  strtotime("-1 day") , #发布时间超过24小时的
        ];
        return
            $this->db->from(PREFIX."product p")
                    ->select("p.*,ca.name as caname,c.name as cname,pr.name as prname")
                    ->join(PREFIX."store s","s.id=p.storeid","inner")
                    ->join(PREFIX."category ca","ca.id=p.category","inner")
                    ->join(PREFIX."city  c","c.id=p.cityid","inner")
                    ->join(PREFIX."product_status pr","p.status=pr.id")
                    ->where($where)
                    ->get()
                    ->result_array();
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
