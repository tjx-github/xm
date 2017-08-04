<?php

class Share extends CI_Controller{
    public function GetData(){
        $this->load->model("GetProductAllModel999","all");
        $data=$this->all->getaone(  $this->input->get("pid") );
        empty($data) && exit("抱歉。找不到相应数据");
        $this->load->view(
                "mobile/ShareShowOneView",
                ["v"=> $data[0] ]
        );
    }
}

