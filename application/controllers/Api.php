<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Api extends CI_Controller {

		function __construct()
		{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('user_model');
			$this->load->library('qr_code_lib');
		}
		public function index()
		{ 
			echo 'API CENTER';
		}

		public function smsinfo()
		{
			$id=$this->uri->segment(3,0);

			$obj=$this->db->from(PREFIX.'sms_code')->where('id', $id)->get()->result_array();
			if(count($obj)<1)
			{
				exit('ERROR');
			}else
			{
				$sms=$obj[0];
			}

			$mobile=$sms['mobile'];
			$code=$sms['code'];
			$smstype=$sms['smstype'];
			$str=array('mobile'=>$mobile,'code'=>$code,'smstype'=>$smstype);
			echo json_encode($str);
		}

		/*
		生成二维码
		*/
		public function qrcode()
		{
			//生成二维码
			//生成文件
			//$this->qr_code_lib->png('http://www.baidu.com','images/123.png');

			//直接显示
			$this->user_model->checklogin();
			global $login;

			$url=site_url('/user/promote/').$login['id'];
		
			
			$this->qr_code_lib->png($url);
			//$this->load->view('test');
		}

		public function category(){
			$query = $this->db->query("select * from ".PREFIX."category  order by ordernum asc");
			$arr=$query->result_array();
			$json=json_encode($arr);
			echo $json;
		}

		public function brandlist(){
			$cid=$this->uri->segment(3,'1');
			
			$query = $this->db->query("select * from ".PREFIX."brand  where cid=".$cid." order by ordernum asc");
			$arr=$query->result_array();
			$json=json_encode($arr);
			echo $json;
		}


	
	}