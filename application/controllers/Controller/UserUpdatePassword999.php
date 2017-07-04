<?php


class UserUpdatePassword999 extends CAbstract{
    use Trait_;
    
    public function updae_p() {
        self::$ci->load->model("UserUpdatePasswordModel","UP");
        if(empty($this->login)){
            return json_encode(["data"=>"严重错误！请先登录！"]);
        }
//        print_r($_SESSION);
//        die;
        return json_encode(["data"=>
            self::$ci->UP->UpdatePass($this->login['id'] , self::$ci->input->get("pass") , $this->login['salt'])   ?  "密码修改成功！" : "密码修改失败！！"]
        );
    }
}
