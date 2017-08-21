<?php
use Model\QuerySearchBlock ;
//use Model\Menu;
abstract class CAbstract    implements InterfaceProductListShow  {
    protected $search=[];
    static $searchdata=[];   
    private $select=[];
    public  function SearchHeader() {
        if(! empty(self::$searchdata)   || empty($this->search) ){
            return ;
        }
        $this->CI_obj() -> load->model("QuerySearchBlock","obj");
        foreach ($this->search as $TableName =>$data){
            array_unshift($data,PREFIX.$TableName );
            self::$searchdata[$TableName]=call_user_func_array([
                 $this->CI_obj()->obj,
                "searchquery"
            ], $data);
        }
        return self::$searchdata= json_encode(self::$searchdata);
    }
    public  function __call($name, $arguments) {
       exit;
    }
    static function __callStatic($name, $arguments) {
        exit;
    }

    public  function updae_p(){}  
    public  function updae_a(){}  
    public  function showoneaview(){}  
    public  function showonepview(){}  
    public  function delete_(){} 
    public  function showallview(){} 
    public  function showpview(){} 
    

}

