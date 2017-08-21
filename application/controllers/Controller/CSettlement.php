<?php
//结算
use Model\Profit as Lr;
class CSettlement  {
    private static $saleman=[]; // 销售人
    private static $data;
/*
 * $ren_column   销售人字段
 * $siteprofit    利润。  有可能查询时用 as  改名称的情况。
 * 
 */
    public static function  TakeMoney(&$data,$ren_column="saleman",$siteprofit="siteprofit"){
        global $login;
        self::$data=&$data;
        call_user_func_array("self::Rule".$login['roleid'],[$ren_column,$siteprofit]);
    }
    private static function IsAdmin($name){ 
    // 判断是总部售出,是总部售出得先期抽取差价。然后再抽取利润的30%。
    //不过这不需要管。得财务管。程序无需管
        if(array_key_exists($name, Lr::RObj()->GetPeople())){
            if(Lr::RObj() ->GetPeople()[$name] === "0" ){
                return true;
            }
        }
                return false;
    }
    private static function IsOwn($siteid){ // 判断是否是自己的商品。是自己的商品无需计算
        if($siteid == 0 ){
            return FALSE; //自己商品
        }else{
            return TRUE; //不是自己商品。并且是总部售出。这时得先期提取差价   差价 =  最终售价-同行价
                            # 提成  =（最终售价-同行价） * 30% ； 这个由财务管。。程序无需管
        }
    }

    //适用于管理员规则
    private static function Rule5($ren_column,$siteprofit){
        foreach (self::$data as &$arr){
            if(self::IsAdmin($arr[$ren_column]) && self::IsOwn($arr['siteid'])){
                $arr[$siteprofit] =  $arr['price']-Lr::RObj()->rivalprice($arr['pid'])  ;// 差价 =  最终售价-同行价
            }
        }
        
    }
    //适用于合作商规则
    private static function Rule4(){
        
    }
    //适用代理商规则
    private static function Rule3(){
        
    }
    //适用加盟商规则
    private static function Rule6($ren_column,$siteprofit){
        foreach (self::$data as &$arr){
            if(self::IsAdmin($arr[$ren_column]) && self::IsOwn($arr['siteid'])){
                echo Lr::RObj()->rivalprice($arr['pid']) ."\n";
                $arr[$siteprofit."___"] =  $arr['price']-Lr::RObj()->rivalprice($arr['pid'])  ;// 差价 =  最终售价-同行价
            }
        }

    }
    public static function __callStatic($name, $arguments) {
        return self::Rule5($arguments);  #不存在时，的默认方法
    }
}

//一先判断是否为总部售出。
//二 是总部售出时替换利润