<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('PRC');
class Export extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_model');
        $this->load->model('home_model');
        $this->load->model('sms_model');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->library('pagination');
        $this->user_model->checklogin();
        
	}

	 


	public function index()
	{
		echo 'OK';
	}
 

     /* 导出产品 */
    public function product(){
        global $login;
        $data['login']=$login;


        $titlesql='';
        $pidsql='';
        $saletypesql='';
        $orderstr='order by id desc';

        $title = $this->input->get('title', true);
        $pid = $this->input->get('pid', true);
        $saletype = $this->input->get('saletype', true);
        

        if($title){ $titlesql=" and  title like '%".$title."%' ";}
        if($pid){ $pidsql=" and  pid = ".$pid." " ;}
        if($saletype){ $saletypesql=" and  saletype= '".$saletype."' " ;}
        
        $sqlstr=$titlesql.$pidsql.$saletypesql;
        $orderstr=' order by id desc';
        $sql = "select * from " . PREFIX . "product  where id>0 ".$sqlstr.$orderstr;
        

  
	     $col['title'] = iconv('utf-8','gb2312','标题');  
		 $col['pid'] = iconv('utf-8','gb2312','货号');    
		 $col['category'] = iconv('utf-8','gb2312','类别'); 
		 $col['size'] = iconv('utf-8','gb2312','规格');    
	     $col['saletype'] = iconv('utf-8','gb2312','出售类型'); 
	     $col['storeid'] = iconv('utf-8','gb2312','仓库');  
	     $col['cityid'] = iconv('utf-8','gb2312','城市');  
	     $col['costprice'] = iconv('utf-8','gb2312','成本价');  
	     $col['saleprice'] = iconv('utf-8','gb2312','销售价');  
		 $col['rivalprice'] = iconv('utf-8','gb2312','同行价'); 
		 $col['holdprice'] = iconv('utf-8','gb2312','保留价');  
		 $col['otherfee'] = iconv('utf-8','gb2312','其他费用'); 
		 $col['status'] = iconv('utf-8','gb2312','状态'); 
		 $col['agentid'] = iconv('utf-8','gb2312','代理商'); 
		 $col['receiver'] = iconv('utf-8','gb2312','收货人'); 
		 $col['owner'] = iconv('utf-8','gb2312','客户');
		 $col['agentid'] = iconv('utf-8','gb2312','代理商');  
		 $col['storedate'] = iconv('utf-8','gb2312','入库日期'); 

		$str='';
		foreach ($col as $key => $value) {
			$str=$str.$value.";";
		}
		$str=$str."\n";


        //$sql='select * from '.PREFIX.'product';
        $rsobj=$this->db->query($sql);
        $arr=$rsobj->result_array();

          foreach ($arr as $key => $value) {
            $arr[$key]['city']=$this->home_model->getC($value['cityid'], 'id', 'name', PREFIX.'city');
            # code...
        }

          foreach ($arr as $key => $value) {
            $arr[$key]['categoryname']=$this->home_model->getC($value['category'], 'id', 'name', PREFIX.'category');
            # code...
        }

          foreach ($arr as $key => $value) {
            $arr[$key]['storename']=$this->home_model->getC($value['storeid'], 'id', 'name', PREFIX.'store');
            # code...
        }

         foreach ($arr as $key => $value) {
            $arr[$key]['statusname']=$this->home_model->getC($value['status'], 'id', 'name', PREFIX.'product_status');
            # code...
        }



        foreach ($arr as $key => $value) {
                 $col['title'] = iconv('utf-8','gb2312',$value['title']);  
				 $col['pid'] = iconv('utf-8','gb2312',$value['pid']);    
				 $col['category'] = iconv('utf-8','gb2312',$value['categoryname']); 
				 $col['size'] = iconv('utf-8','gb2312',$value['size']);    
			     $col['saletype'] = iconv('utf-8','gb2312',$value['saletype']); 
			     $col['storeid'] = iconv('utf-8','gb2312',$value['storename']);  
			     $col['cityid'] = iconv('utf-8','gb2312',$value['city']);  
			     $col['costprice'] = iconv('utf-8','gb2312',$value['costprice']);  
			     $col['saleprice'] = iconv('utf-8','gb2312',$value['saleprice']);  
				 $col['rivalprice'] = iconv('utf-8','gb2312',$value['rivalprice']); 
				 $col['holdprice'] = iconv('utf-8','gb2312',$value['holdprice']);  
				 $col['otherfee'] = iconv('utf-8','gb2312',$value['otherfee']); 
				 $col['status'] = iconv('utf-8','gb2312',$value['statusname']); 
				 $col['agentid'] = iconv('utf-8','gb2312',$value['agentid']); 
				 $col['receiver'] = iconv('utf-8','gb2312',$value['receiver']); 
				 $col['owner'] = iconv('utf-8','gb2312',$value['owner']);
				 $col['agentid'] = iconv('utf-8','gb2312',$value['agentid']);  
				 $col['storedate'] = iconv('utf-8','gb2312',date('Y-m-d',$value['storedate'])); 
				 foreach ($col as $key => $value) {
				 		$str=$str.$value.";";
				 }
				 $str=$str."\n";

        }
        $filename = date('YmdHis').'.csv'; //设置文件名  
        $updir = './uploads/csv/';
        
        $fp = fopen($updir.$filename,"a");
        fwrite($fp,$str);
        fclose($fp);
        //echo "生成成功";

        redirect('/uploads/csv/'.$filename);
     }


     public function sale(){

     	global $login;
        $data['login']=$login;

     	$titlesql='';
        $pidsql='';
        $saletypesql='';
        $cidsql='';
        $salemansql='';
        $saleplatformsql='';
        $startdaysql='';
        $enddaysql='';

        $title = $this->input->get('title', true);
        $pid = $this->input->get('pid', true);
        $saletype = $this->input->get('saletype', true);
        $cid = $this->input->get('cid', true);
        $saleman = $this->input->get('saleman', true);
        $saleplatform = $this->input->get('saleplatform', true);
        $startday = $this->input->get('startday', true);
        $endday = $this->input->get('endday', true);


 		if($title){ $titlesql=" and  title like '%".$title."%' ";}
        if($pid){ $pidsql=" and  pid = ".$pid." " ;}
        if($saletype){ $saletypesql=" and  saletype= '".$saletype."' " ;}
        if($saleman){ $salemansql=" and  saleman = '".$saleman."' " ;}
        if($saleplatform){ $saleplatformsql=" and  saleplatform = '".$saleplatform."' " ;}
        if($startday){
            $starttime=strtotime($startday);
            $startdaysql=" and  saletime >=".$starttime;
        }

        if($endday){
            $endtime=strtotime($endday);
            $enddaysql=" and  saletime <=".$endtime;
        }

        $sqlstr=$titlesql.$pidsql.$saletypesql.$salemansql.$cidsql.$saleplatformsql.$startdaysql.$enddaysql;
        $orderstr=' order by id desc';
        $sql = "select * from " . PREFIX . "sale  where id>0 ".$sqlstr.$orderstr;
        

         
         $col['title'] = iconv('utf-8','gb2312','标题');  
		 $col['pid'] = iconv('utf-8','gb2312','货号');    
		 $col['cid'] = iconv('utf-8','gb2312','客户编号'); 
		 $col['agentid'] = iconv('utf-8','gb2312','代理商');    
         $col['saletype'] = iconv('utf-8','gb2312','出售类型'); 
         $col['platformname'] = iconv('utf-8','gb2312','售出平台');  
         $col['price'] = iconv('utf-8','gb2312','售价');  
         $col['preprice'] = iconv('utf-8','gb2312','定金'); 
         $col['costprice'] = iconv('utf-8','gb2312','成本'); 
         $col['otherfee'] = iconv('utf-8','gb2312','其他费用'); 
         $col['carefee'] = iconv('utf-8','gb2312','护理费用'); 
         $col['platformfee'] = iconv('utf-8','gb2312','平台手续费'); 
		 $col['otherfee'] = iconv('utf-8','gb2312','其他费用'); 
		 $col['kuaidifee'] = iconv('utf-8','gb2312','快递费'); 
         $col['siteprofit'] = iconv('utf-8','gb2312','利润'); 
		 $col['saleman'] = iconv('utf-8','gb2312','销售员'); 
		 $col['payment'] = iconv('utf-8','gb2312','支付方式'); 
		 $col['kuaidicompany'] = iconv('utf-8','gb2312','快递公司'); 
		 $col['kuaidinum'] = iconv('utf-8','gb2312','快递单号');
		 $col['saletime'] = iconv('utf-8','gb2312','售出时间'); 

		$str='';
		foreach ($col as $key => $value) {
			$str=$str.$value.";";
		}
		$str=$str."\n";

       
        $rsobj=$this->db->query($sql);
        $arr=$rsobj->result_array();

        foreach ($arr as $key => $value) {

           $arr[$key]['platformname']=$this->home_model->getC($value['saleplatform'], 'id', 'name', PREFIX.'sale_platform');
        }

        foreach ($arr as $key => $value) {
         $col=array();
         $col['title'] = iconv('utf-8','gb2312',$value['title']);  
		 $col['pid'] = iconv('utf-8','gb2312',$value['pid']);    
		 $col['cid'] = iconv('utf-8','gb2312',$value['cid']); 
		 $col['agentid'] = iconv('utf-8','gb2312',$value['agentid']);    
         $col['saletype'] = iconv('utf-8','gb2312',$value['saletype']); 
         $col['platformname'] = iconv('utf-8','gb2312',$value['platformname']);  
         $col['price'] = iconv('utf-8','gb2312',$value['price']);  
         $col['preprice'] = iconv('utf-8','gb2312',$value['preprice']); 
         $col['costprice'] = iconv('utf-8','gb2312',$value['costprice']); 
         $col['otherfee'] = iconv('utf-8','gb2312',$value['otherfee']); 
         $col['carefee'] = iconv('utf-8','gb2312',$value['carefee']); 
         $col['platformfee'] = iconv('utf-8','gb2312',$value['platformfee']); 
		 $col['otherfee'] = iconv('utf-8','gb2312',$value['otherfee']); 
		 $col['kuaidifee'] = iconv('utf-8','gb2312',$value['kuaidifee']); 
         $col['siteprofit'] = iconv('utf-8','gb2312',$value['siteprofit']); 
		 $col['saleman'] = iconv('utf-8','gb2312',$value['saleman']); 
		 $col['payment'] = iconv('utf-8','gb2312',$value['payment']); 
		 $col['kuaidicompany'] = iconv('utf-8','gb2312',$value['kuaidicompany']); 
		 $col['kuaidinum'] = iconv('utf-8','gb2312',$value['kuaidinum']);
		 $col['saletime'] = iconv('utf-8','gb2312',date('Y-m-d',$value['saletime'])); 

		foreach ($col as $key => $value) {
				$str=$str.$value.";";
			}
			$str=$str."\n";
 
        }

      


         
         
        $filename = date('YmdHis').'.csv'; //设置文件名  
        $updir = './uploads/csv/';
        
        $fp = fopen($updir.$filename,"a");
        fwrite($fp,$str);
        fclose($fp);
        //echo "生成成功";

        redirect('/uploads/csv/'.$filename);


     }




 /* 导出产品 */
    public function customer(){
        global $login;
        $data['login']=$login;

        $fullnamesql='';
        $weixinnamesql='';
        $cidsql='';
        $mobilesql='';
         

        $fullname = $this->input->get('fullname', true);
        $weixinname = $this->input->get('weixinname', true);
        $cid = $this->input->get('cid', true);
        $mobile = $this->input->get('mobile', true);
         
        $searchstr='';
        $search=array('fullname'=>$fullname,'weixinname'=>$weixinname,'cid'=>$cid,'mobile'=>$mobile);
        foreach ($search as $key => $value) {
            $searchstr=$searchstr.'&'.$key.'='.$value;
        }
         

        if($fullname){ $fullnamesql=" and  fullname like '%".$fullname."%' ";}
        if($weixinname){ $weixinnamesql=" and  weixinname like '%".$weixinname."%' ";}
        if($cid){ $cidsql=" and  cid = '".$cid."' " ;}
        if($mobile){ $mobilesql=" and  mobile= '".$mobile."' " ;}

        $sqlstr=$fullnamesql.$weixinnamesql.$cidsql.$mobilesql;

 
        $orderstr=' order by id desc';
        $sql = "select * from " . PREFIX . "customer  where id>0 ".$sqlstr.$orderstr;
        

  
         $col['cid'] = iconv('utf-8','gb2312','客户编号');  
         $col['fullname'] = iconv('utf-8','gb2312','姓名');    
         $col['weixinname'] = iconv('utf-8','gb2312','微信名'); 
         $col['weixinid'] = iconv('utf-8','gb2312','微信号');    
         $col['mobile'] = iconv('utf-8','gb2312','手机号'); 
         $col['address'] = iconv('utf-8','gb2312','收货地址');  
         $col['payaccount'] = iconv('utf-8','gb2312','付款账户');  
         $col['personal'] = iconv('utf-8','gb2312','个人特征');  
         $col['family'] = iconv('utf-8','gb2312','家庭情况');  
         $col['career'] = iconv('utf-8','gb2312','职业信息'); 
         $col['tradeinfo'] = iconv('utf-8','gb2312','交易信息');  
         $col['channel'] = iconv('utf-8','gb2312','推荐来源'); 
         $col['content'] = iconv('utf-8','gb2312','备注'); 
         

        $str='';
        foreach ($col as $key => $value) {
            $str=$str.$value.";";
        }
        $str=$str."\n";


        //$sql='select * from '.PREFIX.'product';
        $rsobj=$this->db->query($sql);
        $arr=$rsobj->result_array();

   


        foreach ($arr as $key => $value) {
                  

                $col['cid'] = iconv('utf-8','gb2312',$value['cid']);  
                $col['fullname'] = iconv('utf-8','gb2312',$value['fullname']);    
                $col['weixinname'] = iconv('utf-8','gb2312',$value['weixinname']); 
                $col['weixinid'] = iconv('utf-8','gb2312',$value['weixinid']);    
                $col['mobile'] = iconv('utf-8','gb2312',$value['mobile']); 
                $col['address'] = iconv('utf-8','gb2312',$value['address']);  
                $col['payaccount'] = iconv('utf-8','gb2312',$value['payaccount']);  
                $col['personal'] = iconv('utf-8','gb2312',$value['personal']);  
                $col['family'] = iconv('utf-8','gb2312',$value['family']);  
                $col['career'] = iconv('utf-8','gb2312',$value['career']); 
                $col['tradeinfo'] = iconv('utf-8','gb2312',$value['tradeinfo']);  
                $col['channel'] = iconv('utf-8','gb2312',$value['channel']); 
                $col['content'] = iconv('utf-8','gb2312',$value['content']); 

                 foreach ($col as $key => $value) {
                        $str=$str.$value.";";
                 }
                 $str=$str."\n";

        }
        $filename = date('YmdHis').'.csv'; //设置文件名  
        $updir = './uploads/csv/';
        
        $fp = fopen($updir.$filename,"a");
        fwrite($fp,$str);
        fclose($fp);
        //echo "生成成功";

        redirect('/uploads/csv/'.$filename);
     }



	  
}