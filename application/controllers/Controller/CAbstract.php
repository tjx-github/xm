<?php
use Model\QuerySearchBlock ;
//use Model\Menu;
abstract class CAbstract   implements InterfaceProductListShow  {
    protected $search=[];
    static $searchdata=[];   
    private $select=[];

    public  function SearchHeader() {
        if(! empty(self::$searchdata)   || empty($this->search) ){
            return ;
        }
        $this->CI_obj() -> load->model("QuerySearchBlock","obj");
//        $obj = new QuerySearchBlock();
        foreach ($this->search as $TableName =>$data){
            self::$searchdata[$TableName]=  $this->CI_obj()->obj ->searchquery(PREFIX.$TableName, $data['column'] ,$data['where'],$data['order']  );
//            self::$searchdata[$TableName]= $obj ->searchquery(PREFIX.$TableName, $data['column'] ,$data['where'],$data['order']  );
        }
     
        return self::$searchdata= json_encode(self::$searchdata);
    }
    public  function updae_p(){}  
    public  function updae_a(){}  
    public  function showoneaview(){}  
    public  function showonepview(){}  
    public  function delete_(){} 
    public  function showallview(){} 
    public  function showpview(){} 
    

}

