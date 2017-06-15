<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('PRC');
class Test extends CI_Controller {
            function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_model');
		$this->load->model('home_model');
		$this->load->model('sms_model');
		$this->load->library('qr_code_lib');
		$this->load->library('upload');

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


	public function domore()
	{
		exit();
		$sql="select distinct(pid) as pid ,title from uz_product where pid like 'w%'";
		$obj=$this->db->query($sql);
		$arr=$obj->result_array();
		$i=1;
		foreach ($arr as $key => $value) {
			# code...

			   echo $i .' '.$value['pid'].'  '.$value['title'].' ';

				$sql="select id from uz_product where pid='".trim($value["pid"])."' order by id asc";
				$obj=$this->db->query($sql);
				$myarr=$obj->result_array();
				$id=$myarr[0]['id'].' ';

				$sql="delete from uz_product where pid='".$value['pid']."' and id<>".$id;
				$this->db->query($sql);
				echo '<br/>';
			$i++;
		}
	}

	public function test()
	{
		 $data='';
		 $this->load->view('home/test',$data);

	}

		public function hr()
	{
		$data='';
		 $this->load->view('home/hr',$data);

	}


	public function select(){
		$data='';
		 $this->load->view('home/test',$data);
	}


	public function run(){
		$sql="select * from product ";
		$obj=$this->db->query($sql);
		$arr=$obj->result_array();
		foreach ($arr as $key => $value) {
			//$title=$value['title'];
			//echo $value['pid'];
			$daystr=strtotime($value['storedate']);
			$daystr=date('Y-m-d',$daystr);
			 
			$sql="update product set storedate='".$daystr."' where id=".$value['id'];
			 $this->db->query($sql);
		}

	}

	public function copy(){
		exit();
		$sql="select * from product";
		$obj=$this->db->query($sql);
		$arr=$obj->result_array();
		$M=array();
		foreach ($arr as $key => $value) {
			$M['title']=$value['title'];
			$M['pid']=$value['pid'];
			$M['size']=$value['size'];
			$M['title']=$value['title'];
			$M['costprice']=$value['costprice'];
			$M['saleprice']=$value['saleprice'];
			$M['holdprice']=$value['holdprice'];
			$M['cityid']=$value['city'];
			$M['receiver']=$value['receiver'];
			$M['owner']=$value['owner'];
			$M['storedate']=$value['storedate'];
			 
			if($value['havephoto']<>1)
			{
				$value['havephoto']=0;
			}

			$M['havephoto']=$value['havephoto'];

			$this->db->insert(PREFIX.'product',$M);

		}

		$this->db->query('delete from product');

		$this->db->query("update ".PREFIX."product set saletype='回收' where pid like 'A%'");
		$this->db->query("update ".PREFIX."product set saletype='寄售' where pid like 'B%'");
		echo '处理完毕';

	}



	public function readcsv(){
 		exit();
 		require_once dirname(__FILE__) . '/../libraries/PHPExcel.php';
		$filename = 'E:\UPUPW\vhosts\admin.uzhengpin.com\3.xlsx';
 $objPHPExcelReader = PHPExcel_IOFactory::load($filename);  //加载excel文件

 foreach($objPHPExcelReader->getWorksheetIterator() as $sheet)  //循环读取sheet
 {
     foreach($sheet->getRowIterator() as $row)  //逐行处理
     {
         if($row->getRowIndex()<2)  //确定从哪一行开始读取
         {
             continue;
         }
         $M=array();
          
         foreach($row->getCellIterator() as $key=> $cell)  //逐列读取
         {
             $data = $cell->getValue(); //获取cell中数据
             $M[]=$data;
         }
          $D['title']=$M[0];
          $D['pid']=$M[1];
          $D['size']=$M[2];
          $D['costprice']=$M[4];
          $D['saleprice']=$M[5];
          $D['rivalprice']=$M[6];
          $D['holdprice']=$M[7];
          $D['city']=$brandname = $this->home_model->getC($M[8], 'name', 'id', PREFIX . 'city');
          $D['receiver']=$M[9];
          $D['owner']=$M[10];
          $D['storedate']=$M[9];
          if(strpos($M[11],'是')>-1)
          {
          	 $D['havephoto']=1;
          }else
          {
          	 $D['havephoto']=0;
          }
          $timestr=str_replace('(是)', '', $M[11]);
          $timestr=str_replace('（是）', '', $timestr);

          if(strlen($timestr)>5)
          {
          	$storedate=strtotime($timestr);
          }else
          {
          	$storedate=time();
          }

          $D['storedate']=$storedate;
          $this->db->insert('product',$D);    
     }
      //echo '处理完毕';
      //echo '<br/>';
     header('location:'.site_url('test/copy'));
 }

echo 'OK';

	}

 
 


	public function index()
	{
		exit();
		require_once dirname(__FILE__) . '/../libraries/PHPExcel.php';
		

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("优正品")
							 ->setLastModifiedBy("优正品")
							 ->setTitle("优正品文件")
							 ->setSubject("优正品Excel文件")
							 ->setDescription("优正品文件，来自网站系统")
							 ->setKeywords("优正品")
							 ->setCategory("优正品");
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '标题')
            ->setCellValue('B1', '类别')
            ->setCellValue('C1', '价格')
            ->setCellValue('D1', '日期!');

 $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', '香奈儿2016款')
            ->setCellValue('B2', '包')
            ->setCellValue('C2', '25000')
            ->setCellValue('D2', '2016-12-01');
 
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

	}


	public function makecsv()
	{

		$str='';
 	 	$sql='select title,payment,price from '.PREFIX.'sale limit 0,10';
 	 	$rsobj=$this->db->query($sql);
 	 	$arr=$rsobj->result_array();
 	 	foreach ($arr as $key => $value) {
				$title = iconv('utf-8','gb2312',$value['title']); //中文转码  
				$payment = iconv('utf-8','gb2312',$value['payment']);  
				$price = iconv('utf-8','gb2312',$value['price']);  
				$str .= $title.";".$payment.";".$price."\n"; //用引文逗号分开  
 	 	}
 	 	$filename = date('YmdHis').'.csv'; //设置文件名  
 	 	$updir = './uploads/csv/';
 	 	
 	 	$fp = fopen($updir.$filename,"a");
 	 	fwrite($fp,$str);
 	 	fclose($fp);
 	 	echo "生成成功";
    	//$this->export_csv($filename,$str); //导出 

	}

	public function export_csv($filename,$data) {  
	    header("Content-type:text/csv");  
	    header("Content-Disposition:attachment;filename=".$filename);  
	    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');  
	    header('Expires:0');  
	    header('Pragma:public');  
	    echo $data;  
}

	public function file()
	{
		 $a = file('./品牌-首饰.txt');
  	 	$i=1;
    	foreach($a as $line => $content){
    	//echo '<li><span class="num top1">'.$i.'</span><a  title="'.$content.'" href="/so/'.$content.'.html">'.$content.'</a> </li>';
       	//echo $content;
       	
       	$this->db->set('cid',2);
       	$this->db->set('brandname',$content);
       	$this->db->insert(PREFIX.'brand');
       	$i++;
    }

    echo 'OK';

	}

	public function qrcode()
	{
		//生成二维码
		//生成文件
		//$this->qr_code_lib->png('http://www.baidu.com','images/123.png');

		//直接显示
		$this->qr_code_lib->png('http://uz.laikan.me');
		//$this->load->view('test');
	}

	public function setsession(){
		$this->session->username='xiaoxiong';
		$this->session->sess_expiration=10;
		echo 'OK';
	}

	public function viewsession(){
		//echo $this->session;
		print_r($_SESSION);
	}

	public function delsession(){
		unset($_SESSION['username']);
		unset($_SESSION['adminrole']);
	}

	public function getadmin()
	{
		echo $this->user_model->get_user_role(3);
	}

	public function gorand(){

		$numbers = range (1,50); 
		//shuffle 将数组顺序随即打乱 
		shuffle ($numbers); 
		//array_slice 取该数组中的某一段 
		$num=6; 
		$result = array_slice($numbers,0,$num); 
		print_r($result); 
 
	}

	 public function dojob()
	 {
	 	exit();
	 	$sql='select * from '.PREFIX.'consult';
	 	$rs=$this->db->query($sql)->result_array();
	 	foreach ($rs as $key => $value) {
	 		$d['job']=1;
	 		$d['cid']=$value['id'];
	 		$d['datetime']=time();
	 		$this->db->insert(PREFIX.'consult_job',$d);
	 	}
	 }
	  
}