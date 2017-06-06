<?php

#同步库存
class Updateproduct_model extends CI_Model{
//    状态为护理中或已发货时修改库存表
    public  function update($array ){
        switch ($array['status']){
            case 2:
                $code=2;
                break;
            case 4: #4在洗护表代表已发货
                $code=1; # 1在库存代表在库
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
