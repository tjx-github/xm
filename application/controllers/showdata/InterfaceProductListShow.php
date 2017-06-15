<?php
//接口
interface InterfaceProductListShow{
    public  function showviewdata();  #返回veiw加工过的数据
    public  function GetSearchBlock(); #获取搜索栏数据
    public  function searchview(); #返回搜索内容
}
