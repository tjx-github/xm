<?php
class Sms_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
     
    function create_sms_code($mobile,$smstype)
    {
    	$data['smstype']=$smstype;
    	$data['mobile']=$mobile;
    	$data['code']=rand(100000,999999);
    	$data['datetime']=time();

    	$this->db->insert(PREFIX.'sms_code',$data);
    	return $this->db->insert_id();
    }


    //订单回复通知短信 cid 为订单ID
     function create_notice_sms($mobile,$cid)
    {
        $data['smstype']='notice';
        $data['mobile']=$mobile;
        $data['code']=$cid;
        $data['datetime']=time();

        $this->db->insert(PREFIX.'sms_code',$data);
        return $this->db->insert_id();
    }


     //订单回复通知短信 cid 为订单ID
     function create_newconsult_sms($cid)
    {
        $data['smstype']='newconsult';
        $data['mobile']=ADMINMOBILE;
        $data['code']=$cid;
        $data['datetime']=time();

        $this->db->insert(PREFIX.'sms_code',$data);
        return $this->db->insert_id();
    }


    function send($codeid){
    	$url=site_url('/').'alisms/?id='.$codeid;
    	$this->get_url_html($url);
    }

        /*
    	获取远程网页的内容
    */
     function get_url_html($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //scurl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)");
        $result = curl_exec($ch);
        return $result;
    }
}