<?php
namespace Model;
trait Trait_Img{
    static public function imgjson(&$data ,$dir='/uploads/product/'){
        if(is_array($data)){
            foreach($data as &$v){
                self::imgjson($v,$dir);
            }
        }else{
            if($data){
                return  $data=self::ti($data,$dir);  
            } else {
                 return false;
            }
        }
    }
    private static function ti($str,$dir){
        $dir2=WEBDIR. $dir.date("Ymd")."/";
        if(is_dir($dir2) === false){
            mkdir($dir2,0777);
        }
        $b=file_put_contents(  $dir2.md5($str).".jpg", base64_decode( preg_filter( "/^.*,/","", $str) ));
        if($b){
            return $dir .date("Ymd")."/". md5($str).".jpg";
        } else {
            return false;
        }
    }
    
}

