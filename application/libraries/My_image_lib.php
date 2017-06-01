<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 

class MY_Image_lib extends CI_Image_lib {

	public function __construct()
    {
        
        
    }

    //创建缩略图
	function make_small($filepath,$newdir){
			$config=array(); 
			$config['image_library'] = 'gd2';
			$config['source_image'] =$filepath;
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 400;
			$config['height'] = 400;
			$config['thumb_marker']='_small';
			$config['new_image']=$newdir;
			$this->initialize($config);
          	$this->resize();

          	$facepic=str_replace('./uploads', '/uploads', $filepath);
          	$facepic=str_replace('.', '_small.', $facepic);
          	 
          	return '.'.$facepic;
          	 

		}



}