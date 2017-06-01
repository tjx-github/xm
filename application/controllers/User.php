<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('APP_ID', 'wx8e0c7ad92efabd69');//改成自己的APPID
define('APP_SECRET', 'd7449bb9b59828a8d4f9260e80f430db');//改成自己的APPSECRET 

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_model');
		$this->load->model('sms_model'); 
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		echo 'OK';
	}

	public function login(){
	 
		$this->load->view('user/login');
		 

	}


///跳转微信授权
	public function weixin_jump($url){
		$url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.APP_ID.'&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect';
		header('location:'.$url);
	}


	public function weixinlogin(){
	 
		$openarr=$this->get_open_id();
		$openid=$openarr['openid'];
		$token=$openarr['access_token'];

		$this->db->where('openid',$openid);
		$userarr=$this->db->get(PREFIX.'user')->result_array();
	 
		if(count($userarr)>0)
		{
			$rs=$userarr[0];
			$lasttime=time();
			$this->session->uid=$rs['id'];
			$this->session->v=substr($rs['password'],0,16).$lasttime;
			$this->session->sess_expiration=31536000;//一年后过期
			$this->db->query('update '.PREFIX.'user set lastlogin='.$lasttime.' where id='.$rs['id']);
			//echo 'OK';
			header('location:'.site_url('/'));

		}else
		{
			$user=$this->get_user_info($token,$openid);
		 
			$this->session->openid=$user['openid'];
			$this->session->nickname=$user['nickname'];
			$this->session->headimgurl=$user['headimgurl'];
			$this->session->sex=$user['sex'];
			$this->session->country=$user['country'];
			$this->session->province=$user['province'];
			if($user['province']=='北京'||$user['province']=='上海'||$user['province']=='天津'||$user['province']=='重庆'){
				
				$this->session->city=$user['province'];
				$this->session->area=$user['city'];
			}
			else
			{
				$this->session->city=$user['city'];
				$this->session->area='';
			}
			$this->session->sess_expiration=3600;//一
			header('location:'.site_url('user/reg'));
			//print_r($user);

		}


		
		//$token=$this->get_access_token();
		//$arr=$this->refresh_token($openarr['refresh_token']);
		//$token=$arr['access_token'];
		//$openid=$arr['openid'];
		

	}


	public function check_mobile_exist()
	{
		$mobile=$this->uri->segment(3,0);
		$mobile=substr($mobile, 0,11);
		$obj=$this->db->from(PREFIX.'user')->where('username', $mobile)->get()->result_array();
		if(count($obj)<1)
       	{
       		//exit('ERROR');
       		echo 'ERROR';
       	}else
       	{
       		echo 'OK';
       	}
	}



	 public function sendsms(){
	 	$codeid=$this->uri->segment(3,0);
    	$url=site_url('/').'alisms/?id='.$codeid;
    	$this->sms_model->get_url_html($url);
    	echo 'OK';

    }
	public function loginsms(){
		$step=1;
		$data['step']=$step;
		$this->load->view('user/user_login_sms',$data);
	}

	public function sendpass(){
		 
		 
		$mobile=$this->input->post('mobile',true);
		$this->session->mobile=$mobile;
		$codeid=$this->sms_model->create_sms_code($mobile,'sendpass');
		//发送短信
		$this->sms_model->send($codeid);
		$this->session->codeid=$codeid;
		header('location:'.site_url('user/login_sms_2'));
		 
	}

	public function login_sms_2()
	{
		$data['step']=2;
		$mobile=$this->session->mobile;
		$data['mobile']=$mobile;
		$this->load->view('user/user_login_sms',$data);
	}

	public function checklogin(){
		//echo $_POST['username'];
		if(isset($_POST['username']))
		{
			$username=$this->input->post('username',true);
			$password=$this->input->post('password',true);

			$this->db->from(PREFIX.'user');
			$this->db->where('username',$username);
			
			//$this->db->where('roleid',5);
			//$this->db->where('roleid',5);
			//$this->db->or_where('roleid',3);
			$rsobj=$this->db->get();
			$user=$rsobj->row_array();
			if($user)
			{
				//echo 'user is ok';
				$newpass=md5($password.$user['salt']);
				$oldpass=$user['password'];
				
				if($newpass==$oldpass)
				{

					$lasttime=time();
					$this->session->uid=$user['id'];
					$this->session->v=substr($user['password'],0,16).$lasttime;
					$this->session->sess_expiration=31536000;//一年后过期
					$this->db->query('update '.PREFIX.'user set lastlogin='.$lasttime.' where id='.$user['id']);
					echo 'OK';
				}
				else{
					//密码错误
					 echo 'PASSWRONG';
				}


			}else
			{
				 	//用户不存在
					 echo 'NOUSER';
					 
			}


			 

		}else
		{
			exit('请输入账号');
		}
		
 
	}


	public function checkloginsms(){
		//echo $_POST['username'];
		 
			$mobile=$this->input->post('mobile',true);
			$password=$this->input->post('password',true);

			//$mobile=$this->input->get('mobile',true);
			//$password=$this->input->get('password',true);

			$sql="select * from ".PREFIX."sms_code where mobile='".$mobile."' and code=".$password." and ck=0 and smstype='sendpass'";
			 
			$obj=$this->db->query($sql);
			$codearr=$obj->result_array();
			 
			if(count($codearr)>0)
			{
				$this->db->from(PREFIX.'user');
				$this->db->where('username',$mobile);
				$rsobj=$this->db->get();
				$user=$rsobj->row_array();
				
				//print_r($user);
				//exit();

				if($user)
				{
					$lasttime=time();
					$this->session->uid=$user['id'];
					$this->session->v=substr($user['password'],0,16).$lasttime;
					$this->session->sess_expiration=31536000;//一年后过期
					$this->db->query('update '.PREFIX.'user set lastlogin='.$lasttime.' where id='.$user['id']);
					$this->db->query('update '.PREFIX.'sms_code set ck=1 where id='.$codearr[0]['id']);
					echo 'OK';
				}else{
				 	//用户不存在
					 echo 'NOUSER';
					 
				}

			}else
			{
				 echo 'PASSWRONG';
			}

	 
 
	}



	 

	//用户推荐注册跳转部分
	public function promote(){
		//用户推荐注册
		$rid=$this->uri->segment(3,0);
		$this->session->rid=$rid;
		$this->session->sess_expiration=2592000;
		header('location:'.site_url('user/login'));

	}

	///用户注册
	public function reg(){
		//用户推荐注册
			// echo '欢迎你注册，你的推荐人是'.$rid;
			$data['step']=1;
			$this->load->view('user/user_reg',$data);
		 
	}

	///接受 手机号码  发送验证码
	public function reg_1_save(){
		$mobile=$this->input->post('mobile',true);
		$codeid=$this->sms_model->create_sms_code($mobile,'reg');
		 
		//发送短信
		$this->sms_model->send($codeid);

		$this->session->mobile=$mobile;
		header('location:'.site_url('user/reg_2'));

	}

	public function reg_2(){
		//用户推荐注册
		$mobile=$this->session->mobile;
		$data['mobile']=$mobile;
		$data['step']=2;
		$this->load->view('user/user_reg',$data);
		 
	}

		public function reg_2_save(){
		//用户推荐注册
		$mobile=$this->session->mobile;
		$code=$this->input->post('code',true);
		$sql="select id from ".PREFIX."sms_code where mobile='".$mobile."' and code=".$code." and ck=0";
		
		 
		$arr=$this->db->query($sql)->result_array();
		if(count($arr)>0)
		{
			$codeid=$arr[0]['id'];
			$this->db->query('update '.PREFIX.'sms_code set ck=1 where id='.$codeid);
			
			//echo '验证成功'; 微信自动获取信息
			//header('location:'.site_url('user/regform'));

		/*处理用户推荐*/
		$rid=$this->session->rid;
    	if(is_numeric($rid))
    	{
    		$obj=$this->db->from(PREFIX.'user')->where('id', $rid)->get()->result_array();
    		if(count($obj)>0)
    		{ 
    			$ruser=$obj[0];
    			if($ruser['roleid']==3)
    			{
    				$data['agentid']=$rid;
    			}else
    			{
    				$data['rid']=$rid;
    			}
    		} 
    	}

    		$salt=$this->user_model->createsalt();
    		$lasttime=time();

    		$sex=$this->session->sex;
    		switch ($sex) {
    			case '1':
    				$sex='男';
    				break;

    			case '2':
    				$sex='女';
    				break;
    			
    			case '2':
    				$sex='保密';
    				break;
    		}
			/*注册入库*/

			$data['mobile']=$this->session->mobile;
			$data['username']=$this->session->mobile;
			$data['facepic']=$this->session->headimgurl;
			$data['password']=md5(md5($code).$salt);
			$data['openid']=$this->session->openid;
			$data['nickname']=$this->session->nickname;
			$data['fullname']=$this->session->nickname;
			$data['sex']=$sex;
			$data['country']=$this->session->country;
			$data['province']=$this->session->province;
			$data['city']=$this->session->city;
			$data['area']=$this->session->area;
    		$data['salt']=$salt;
    		$data['regtime']=$lasttime;
    		$data['lastlogin']=$lasttime;
    		//写入数据
    		$this->db->insert(PREFIX.'user',$data);

	    	//开始登陆
	    	$userid=$this->db->insert_id();
	    	$lasttime=time();
			$this->session->uid=$userid;
			$this->session->v=substr($password,0,16).$lasttime;
			$this->session->sess_expiration=31536000;//一年后过期
			header('location:'.site_url('home/'));


		}else
		{
			echo '验证码错误或过期';
		}
	}




	public function regform(){
		$mobile=$this->session->mobile;
		$data['mobile']=$mobile;
		$data['step']=3;
		$this->load->view('user/user_reg',$data);
		 
	}




    function reg_save()
    {
    	$mobile=$this->session->mobile;

    	/* 处理用户推荐注册模块 */
    	$rid=$this->session->rid;
    	if(is_numeric($rid))
    	{
    		$obj=$this->db->from(PREFIX.'user')->where('id', $rid)->get()->result_array();
    		if(count($obj)>0)
    		{ 
    			$ruser=$obj[0];
    			if($ruser['roleid']==3)
    			{
    				$data['agentid']=$rid;
    			}else
    			{
    				$data['rid']=$rid;
    			}
    		} 
    	}
    	/* 处理用户推荐模块 结束 */

    	$data['username']=$mobile;
    	$data['mobile']=$mobile;
    	$data['fullname']=$this->input->post('fullname',true);
    	$data['sex']=$this->input->post('sex',true);
    	
    	$data['country']='中国';
    	$citystr=$this->input->post('city',true);
    	$cityarr=explode(' ', trim($citystr));
    	if(count($cityarr)==3)
    	{
    		$data['province']=$cityarr[0];
    		$data['city']=$cityarr[1];
    		$data['area']=$cityarr[2];
    	}else
    	{
    		$data['province']=$cityarr[0];
    		$data['city']=$cityarr[0];
    		$data['area']=$cityarr[1];
    	}

    	$salt=$this->user_model->createsalt();
    	$data['salt']=$salt;
    	$userpass=$this->input->post('password',true);
    	$password=md5($userpass.$salt);
    	$data['password']=$password;
    	$lasttime=time();
    	$data['regtime']=$lasttime;
    	$data['lastlogin']=$lasttime;
    	//写入数据
    	$this->db->insert(PREFIX.'user',$data);

    	//开始登陆
    	$userid=$this->db->insert_id();
    	$lasttime=time();
		$this->session->uid=$userid;
		$this->session->v=substr($password,0,16).$lasttime;
		$this->session->sess_expiration=31536000;//一年后过期
		header('location:'.site_url('/'));
    }


	public function logout(){
		unset($_SESSION['uid']);
		unset($_SESSION['v']);
	 	
		header('location:'.site_url('user/login'));

	}


/**
微信部分
**/

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

    	private function check_openid_exist($openid){
		$this->db->where('openid',$openid);
		$num=$this->db->count_all_results('users');
		if($num>0){
			return true;
		}else
		{
			return false;
		}
	}

}