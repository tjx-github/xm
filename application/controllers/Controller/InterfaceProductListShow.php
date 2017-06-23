<?php
//接口
interface InterfaceProductListShow{
    public  function showallview();  #显示全网的
    public  function showpview();  #显示私人的
    public  function updae_p(); #更改私人的  
    public  function updae_a();  #更全网/他人的
    public  function showoneaview();  #显示一个，全网的详情
    public  function showonepview();  #显示一个私人的详情
    public  function delete_();  

}
