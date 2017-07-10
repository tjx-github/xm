<?php
use Model\Menu;
trait Trait_  {
    static protected $ci;
    protected  $login;
    public  function  ci(CI_Controller $objcet){
        global $login;
        $this->login=$login;
        self::$ci=$objcet;
    }
    public function CI_obj(){
        return self::$ci;
    }
    public function MenuView() {
        $d=(new Menu())->getmenu();
        $b=[];
        foreach($d as $va){
            $b[$va['TMenuName']][] =$va;
        }
        return self::$ci->load->view("menu",['menu'=>$b],true );
    }
    
    static public function page_html($function,$count){
            self::$ci->load->library('pagination');
            
            $config['base_url'] =site_url($function);
            $config['total_rows'] = (int)$count;
           return self::$ci->pagination
                ->initialize(
                        array_merge(self::$ci->config->item("page_config") , $config)
                 )
                ->create_links();
    }

}

