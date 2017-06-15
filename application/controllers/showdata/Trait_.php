<?php
trait Trait_  {
    public  $ci;
    public  $NavigateView;
    protected  $login;
    public  function  ci(CI_Controller $objcet){
        global $login;
        $this->login=$login;
            $this->ci=$objcet;
            $this->NavigateView = $this->ci->load->view("home/nav",["login"=>$login] ,true);
    }
}

