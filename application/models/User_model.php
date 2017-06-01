<?php
class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    
    ///检查 是否 登录
	function checklogin()
	{
		global $login;

		/* 获取 cookies*/
		$uid=$this->session->uid;
		$v=$this->session->v;
		
		if( strlen($v)!=26)
		{
			header('location:'.site_url('user/login')); 
			exit();
		}
		$lastlogin=substr($v, -10,10);


		/*读取数据库*/
		//若要限制登录设备 只允许一台
		//$sql='select * from '.PREFIX.'user where id='.$uid.' and lastlogin='.$lastlogin;

		$sql='select * from '.PREFIX.'user where id='.$uid;
		$rsobj=$this->db->query($sql);
		$arr=$rsobj->result_array();
		$login=$arr[0];

		if(substr($login['password'], 0,16)!=substr($v, 0,16))
		{
			header('location:'.site_url('user/login')); 
			exit();
		} 
		/*验证完毕*/


		
		/*判断用户角色 如果是管理员  细分权限名*/
		if($login['roleid']==5)
		{
			$idstr=substr($login['adminrole'], 1,-1);
			$idlist=str_replace('-', ',', $idstr);
			$this->session->adminrole=$idlist;
			$rolename=$this->get_admin_role($idlist);
			$login['idlist']=$idlist;
		}else
		{
			$rolename=$this->get_user_role($login['roleid']);
		}

		$login['rolename']=$rolename;

	  

 		 
	}



	/*管理员的权限控制*/
	function need_admin_role($rolelist)
	{
		global $login;

		$idstr=substr($login['adminrole'], 1,-1);
		$myrole=explode('-', $idstr);

		 
		$needrole=explode(',', $rolelist);
		 
		foreach ($myrole as $key => $value) {
			# code...
			if(in_array($value, $needrole))
			{
				return true;
			}
		}
		exit('没有权限');
		//return false;
	}

	//需要管理员权限
	function need_admin()
	{
		global $login;
		if($login['roleid']==5)
		{
			return true;
		}else{
			exit('需要管理权限');
		}

	}

	function get_admin_role($idlist){
		 
			$sql="select * from ".PREFIX."admin_role where roleid in (".$idlist.")";

			$rsobj=$this->db->query($sql);
			$rs=$rsobj->result_array();
			$i=0;
			$rolename='';
			foreach ($rs as $key => $value) {
				 
				if($i==0){
					$rolename=$rolename.$value['rolename'];
				}else
				{
					$rolename=$rolename.','.$value['rolename'];
				}
				$i++;

			}
			return $rolename;

		 
	}


	function get_user_role($id){
		$this->db->from(PREFIX.'user_role');
		$this->db->select('rolename');
		$this->db->where('roleid',$id);
		$obj=$this->db->get();
		$rs=$obj->row_array();
		return $rs['rolename'];	 
	}

	function createsalt(){ 
		$length=4;
		$str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';//62个字符 
		$strlen = 62; 
		while($length > $strlen){ 
		$str .= $str; 
		$strlen += 62; 
		} 
		$str = str_shuffle($str); 
		return substr($str,0,$length); 
	} 

	    ///判断是否是微信浏览器
    function isweixin(){
    if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
            return true;
    }
    return false;
}




}