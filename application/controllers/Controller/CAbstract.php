<?php
use model\QuerySearchBlock ;
abstract class CAbstract   implements InterfaceProductListShow  {
    private $search=[];
    static $searchdata=[];
//    abstract function search(); #搜索。
    
    public  function SearchHeader() {
        if(! empty(self::$searchdata)   || empty($this->search) ){
            return ;
        }
        $obj = new QuerySearchBlock();
        foreach ($this->table as $TableName =>$data){
            self::$searchdata[$TableName]= $obj ->searchquery(PREFIX.$TableName, $data['column'] ,$data['where'],$data['order']  );
        }
//        return self::$searchdata;
    }
    

}

