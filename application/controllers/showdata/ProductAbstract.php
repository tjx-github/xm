<?php
use model\QuerySearchBlock ;
abstract class ProductAbstract  implements InterfaceProductListShow  {
    private $search=[];
    static $tabledata=[];
//    abstract function search(); #搜索。
    
    public  function GetSearchBlock() {
        if(! empty(self::$tabledata)   || empty($this->table) ){
            return ;
        }
        $obj = new QuerySearchBlock();
        foreach ($this->table as $TableName =>$data){
            self::$tabledata[$TableName]= $obj ->searchquery(PREFIX.$TableName, $data['column'] ,$data['where'],$data['order']  );
        }
//        return self::$tabledata;
    }
    

}

