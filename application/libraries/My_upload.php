<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class MY_Upload extends CI_Upload {
    public function base64_upload ($updir="./uploads/",$base64_image) {
//        parent::base64_upload($updir="./uploads/",$base64_image);
    // $base64_image = str_replace(' ', '+', $base64);
        //post的数据里面，加号会被替换为空格，需要重新替换回来，如果不是post的数据，则注释掉这一行
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image, $result)){
            //匹配成功
            $file_name=date('YmdHis').rand(1,9999);
            if($result[2] == 'jpeg'){
                $image_name = $file_name.'.jpg';
                //纯粹是看jpeg不爽才替换的
            }else{
                $image_name = $file_name.'.'.$result[2];
            }
            $image_file = $updir."{$image_name}";
            //服务器文件存储路径
            if (file_put_contents($image_file, base64_decode(str_replace($result[1], '', $base64_image)))){
                return $image_name;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}