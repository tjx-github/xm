<?php

class  UpdateSaleOrProductModel extends CI_Model{
    #修改 Sale 表
    public  function UpdateSale($where,$data){
        $this->db->where($where);
        $b=$this->db->update(PREFIX."sale",$data);
    }
    #修改 product表
    public  function UpdateProduct($where,$data){
        $this->db->where($where);
        $this->db->update(PREFIX."product",$data)  ;
    }
    
    #更新 product表status字段的状态码
    public function UpdateProductStatus($array){
        switch ($array['status']){
            case 2:
                $code=2;# 2在库存代表护理中
                break;
            case 4: #4在洗护表代表已发货
                $code=1; # 1在库存代表在库
                break;
            case 1: #1在洗护表代表 已接收
                $code=2; 
                break;
            default :
                return ;  
        }
        $this->db->where("pid" ,$array['pid']);
        $this->db->update(PREFIX."product",[
            "status"=>$code
        ]);
    }
    
    
    
    
}
