<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('APP_ID', 'wx8e0c7ad92efabd69');//改成自己的APPID
define('APP_SECRET', 'd7449bb9b59828a8d4f9260e80f430db');//改成自己的APPSECRET 

date_default_timezone_set('PRC');
class Weixin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_model');
		$this->load->library('qr_code_lib');
	}

	public function index(){
		$url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.APP_ID.'&redirect_uri=http://wx.uzhengpin.com/weixin/reg&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect';
		header('location:'.$url);
		 
	}

 
 
	public function check_user()
	{
		global $user;

		$openid=$this->input->cookie('openid');
		if($openid)
		{
			$this->db->where('openid',$openid);
			$this->db->from('users');
			$rsobj=$this->db->get();
			$rsarr=$rsobj->result_array();
			$user=$rsarr[0];
		}else
		{
			$err['msg']='您还不是会员，现在注册会员';
			$err['url']=site_url('weixinuser/');
			$err_json=json_encode($err);
			$this->input->set_cookie("err",$err_json,600);
	 		header('location:'.site_url('weixinuser/msg'));
		}
		

	}

	public function reg(){
	
			$openarr=$this->get_open_id();
		 	

			$token=$openarr['access_token'];
			//$token=$this->get_access_token();
			$openid=$openarr['openid'];
			
			//$arr=$this->refresh_token($openarr['refresh_token']);

			//$token=$arr['access_token'];
			//$openid=$arr['openid'];

			 
			$user=$this->get_user_info($token,$openid);
			print_r($user);

			 
	}

	///执行登陆
	private function do_login($openid)
	{
		$this->input->set_cookie("openid",$openid,36000);
		header('location:'.site_url('weixinuser/my'));
	}


	///注册保持
	public function reg_save(){
		$data['openid']=$this->input->post('openid',true);

		if($this->check_user_exist($data['openid'])==true){
			
			$err['msg']='您已经是会员，点确定直接进入会员中心';
			$err['url']='/';
			$err_json=json_encode($err);
			$this->input->set_cookie("err",$err_json,600);
	 		header('location:'.site_url('weixinuser/msg'));

		}else{
			$data['nickname']=$this->input->post('nickname',true);
			$data['sex']=$this->input->post('sex',true);
			$data['mobile']=$this->input->post('mobile',true);
			$data['city']=$this->input->post('city',true);
			$data['birthday']=$this->input->post('birthday',true);
			$data['pic']=$this->input->post('pic',true);
			$data['datetime']=time();
	 		$this->db->insert('users',$data);

	 		$this->input->set_cookie("openid",$data['openid'],36000);

			$err['msg']='注册成功！';
			$err['url']=site_url('weixinuser/my');
			$err_json=json_encode($err);
			$this->input->set_cookie("err",$err_json,600);
	 		header('location:'.site_url('weixinuser/msg'));
 		}
 		
	}




	///消息
	public function msg(){

		$err=$this->input->cookie("err");
		$arr=json_decode($err,true);
		$data['err']=$arr;
		$this->load->view('user/wx_msg',$data);

	}



	private function check_user_exist($openid){
		$this->db->where('openid',$openid);
		$num=$this->db->count_all_results('users');
		if($num>0){
			return true;
		}else
		{
			return false;
		}
	}

 	
 	private function https_request($url, $data = null)
		{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (!empty($data)){
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($curl);
			curl_close($curl);
			return $output;
		}

	private function get_access_token()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APP_ID."&secret=".APP_SECRET;
        $data = json_decode(file_get_contents($url),true);
        if($data['access_token']){
            return $data['access_token'];
        }else{
            return "获取access_token错误";
        }
    }

   private function get_open_id(){
			$code=$_GET['code'];
			$url='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.APP_ID.'&secret='.APP_SECRET.'&code='.$code.'&grant_type=authorization_code';
			$content=$this->https_request($url);
			$arr=json_decode($content,true);
			return $arr;
    }

    private function get_user_info($token,$openid){
    	//公众号授权方式
    	//$url='https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$token.'&openid='.$openid;
    	
    	//网页授权方式
    	$url='https://api.weixin.qq.com/sns/userinfo?access_token='.$token.'&openid='.$openid.'&lang=zh_CN';
    	$content=$this->https_request($url);
    	$arr=json_decode($content,true);
    	return $arr;
    }	


       private function refresh_token($refresh_token){
    	$url='https://api.weixin.qq.com/sns/oauth2/refresh_token?appid='.APP_ID.'&grant_type=refresh_token&refresh_token='.$refresh_token;
    	$content=$this->https_request($url);
    	$arr=json_decode($content,true);
    	return $arr;
    }	


}
