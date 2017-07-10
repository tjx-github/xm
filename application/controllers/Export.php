<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('PRC');
class Export extends CI_Controller {

	function __construct()
	{
        global $login;
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_model');
        $this->load->model('home_model');
        $this->load->model('sms_model');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->library('pagination');
        $this->user_model->checklogin();
        require_once dirname(__FILE__) . '/../libraries/PHPExcel.php';
        
        if($login['roleid']==0)
        {
            exit('��û��Ȩ�� <a href="'.site_url("user/logout").'">�˳�</a>');
        }else
        {
            if($login['roleid']==5)
            {
                define("SITEID", 0);
            }
            else
            {
                define("SITEID", $login['id']);
            }
        }

	}



	public function index()
	{
		echo 'OK';
	}
    static private function str_sort(CI_Controller $object){  #����
        $order=[1=>"desc","asc"];
        $str="order by  ";
        if(array_key_exists((int) $object->input->get("datetime_sort"),$order ) ){
            $str .="  datetime ".$order[(int) $object->input->get("datetime_sort")];
        }
        if(array_key_exists((int) $object->input->get("costprice_sort"),$order ) ){
            if(mb_strlen($str) == 10){
                $str .="  costprice ".$order[(int) $object->input->get("costprice_sort")];
            } else {
                $str .=" , costprice ".$order[(int) $object->input->get("costprice_sort")];
            }
        }
        if(mb_strlen($str) == 10){
            return false;
        }else{
            return $str;
        }
    }
     /* ������Ʒ */
    public function product(){
        global $login;
        $data['login']=$login;
        $titlesql='';
        $pidsql='';
        $categorysql='';
        $saletypesql='';
        $sizesql='';
        $storeidsql='';
        $statussql='';
        $cityidsql='';
        $agentidsql='';
        $receiversql='';
        $ownersql='';
        $storedatesql='';
        $havephotosql='';
        $startdaysql='';
        $enddaysql='';
        $startday='';
        $endday='';
        $storedate='';
        $paymentsql='';

  
        $title = $this->input->get('title', true);
        $pid = $this->input->get('pid', true);
        $saletype = $this->input->get('saletype', true);
        $category = $this->input->get('category', true);

        $size = $this->input->get('size', true);
        $storeid = $this->input->get('storeid', true);
        $status = $this->input->get('status', true);
        $cityid = $this->input->get('cityid', true);
        $agentid = $this->input->get('agentid', true);
        $receiver = $this->input->get('receiver', true);
        $owner = $this->input->get('owner', true);
        
        $havephoto = $this->input->get('havephoto', true);

        $startday = $this->input->get('startday', true);
      
        $endday= $this->input->get('endday', true);
        $payment= $this->input->get('payment', true);
         
       
        
        $searchstr='';
        $search=array('title'=>$title,'pid'=>$pid,'category'=>$category,
            'saletype'=>$saletype,'size'=>$size,'storeid'=>$storeid,'status'=>$status,
            'cityid'=>$cityid,'agentid'=>$agentid,'receiver'=>$receiver,'owner'=>$owner,
            'startday'=>$startday,'endday'=>$endday,'havephoto'=>$havephoto,
            'payment'=>$payment);
//        print_r($_GET);
//        print_r($search);
//        print_r(array_diff_key($_GET,$search));
        
        
        foreach ($search as $key => $value) {
            $searchstr=$searchstr.'&'.$key.'='.$value;
        }
        

        if($title){ $titlesql=" and  title like '%".$title."%' ";}
        if($pid){ $pidsql=" and  pid like '%".$pid."%' " ;}
        if($saletype){ $saletypesql=" and  saletype= '".$saletype."' " ;}
        if($category>0){ $categorysql=" and  category= ".$category." " ;}
        if($size){ $sizesql=" and  size like '%".$size."%' " ;}
        if($storeid){ $storeidsql=" and  storeid= ".$storeid." " ;}
        if($status){ $statussql=" and  status= ".$status." " ;}
        if($cityid){ $cityidsql=" and  cityid= ".$cityid." " ;}
        if($agentid){ $agentidsql=" and  agentid= ".$agentid." " ;}
        if($receiver){ $receiversql=" and  receiver= '".$receiver."' " ;}
        if($owner){ $ownersql=" and  owner like '%".$owner."%' " ;}
        if($storedate){ $storedatesql=" and  storedate= '".$storedate."' " ;}
        if($havephoto<>''){ $havephotosql=" and  havephoto= ".$havephoto." " ;}
        if($payment){ $paymentsql=" and  payment= ".$payment." " ;}
        
       
        if($this->input->get("video") == 1){
            $video =" and video !=''  ";
        }elseif($this->input->get("video") == 2 ){
            $video ="and video =''  ";
        }else{
            $video ="";
        }
        
        
        if($startday){
            $starttime=strtotime($startday);
            $startdaysql=" and  storedate >=".$starttime." ";
        }

        if($endday){
            $endtime=strtotime($endday);
            $enddaysql=" and  storedate <=".$endtime." ";
        }

        $sqlstr=$titlesql.$pidsql.$categorysql.$saletypesql.$sizesql.$storeidsql.$statussql.$cityidsql.$agentidsql.$receiversql.$ownersql.$storedatesql.$havephotosql.$startdaysql.$enddaysql.$paymentsql.$video;
        
        self::str_sort($this) ? $order_by=self::str_sort($this) : $order_by = ' order by id desc';


        
//        $sql = "select * from " . PREFIX . "product  where siteid=".SITEID." ".$sqlstr.$orderstr;
        if(SITEID === 0 ){
            
            if($sqlstr){
//               $sql = 'select id from ' . PREFIX . 'product where  1'. $sqlstr;
               $sql = "select * from " . PREFIX . "product  where 1  ".$sqlstr.$order_by;
           }else{
               
               $sql = "select * from " . PREFIX . "product     ".$order_by;
           }
        }else{
            $sql = "select * from " . PREFIX . "product  where siteid=".SITEID." ".$sqlstr.$order_by;
        }

       
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("����Ʒ")
                                     ->setLastModifiedBy("����Ʒ")
                                     ->setTitle("����Ʒ�ļ�")
                                     ->setSubject("����ƷExcel�ļ�")
                                     ->setDescription("����Ʒ�ļ���������վϵͳ")
                                     ->setKeywords("����Ʒ")
                                     ->setCategory("����Ʒ");

        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', '����')
                    ->setCellValue('B1', '����')
                    ->setCellValue('C1', '���')
                    ->setCellValue('D1', '���')
                    ->setCellValue('E1', '������')
                    ->setCellValue('F1', '�ֿ�')
                    ->setCellValue('G1', '����')
                    ->setCellValue('H1', '�ɱ���')
                    ->setCellValue('I1', '���ۼ�')
                    ->setCellValue('J1', 'ͬ�м�')
                    ->setCellValue('K1', '������')
                    ->setCellValue('L1', '��������')
                    ->setCellValue('M1', '״̬')
                    ->setCellValue('N1', '������')
                    ->setCellValue('O1', '�ջ���')
                    ->setCellValue('P1', '�ͻ�')
                    ->setCellValue('Q1', '�������')
                    ->setCellValue('R1', '�Ƿ�����')
                    ->setCellValue('S1', '���ʽ')
                    ->setCellValue('T1', '��ע');
                    
 
 


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
            $arr[$key]['agentname']=$this->home_model->getC($value['agentid'], 'id', 'fullname', PREFIX.'user');
            # code...
        }


         foreach ($arr as $key => $value) {
            $arr[$key]['statusname']=$this->home_model->getC($value['status'], 'id', 'name', PREFIX.'product_status');
            # code...
        }

         foreach ($arr as $key => $value) {
            $arr[$key]['payment']=$this->home_model->getC($value['payment'], 'id', 'name', PREFIX.'sale_payment');
            # code...
        }

    foreach ($arr as $key => $value) {
            if($value['havephoto']==1){
                $arr[$key]['havephoto']='��';
            }else
            {
                 $arr[$key]['havephoto']='��';
            }
             
        }


        foreach ($arr as $key => $value) {

            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.($key+2), $value['title'])
            ->setCellValue('B'.($key+2), $value['pid'])
            ->setCellValue('C'.($key+2), $value['categoryname'])
            ->setCellValue('D'.($key+2), $value['size'])
            ->setCellValue('E'.($key+2), $value['saletype'])
            ->setCellValue('F'.($key+2), $value['storename'])
            ->setCellValue('G'.($key+2), $value['city'])
            ->setCellValue('H'.($key+2), $value['costprice'])
            ->setCellValue('I'.($key+2), $value['saleprice'])
            ->setCellValue('J'.($key+2), $value['rivalprice'])
            ->setCellValue('K'.($key+2), $value['holdprice'])
            ->setCellValue('L'.($key+2), $value['otherfee'])
            ->setCellValue('M'.($key+2), $value['statusname'])
            ->setCellValue('N'.($key+2), $value['agentname'])
            ->setCellValue('O'.($key+2), $value['receiver'])
            ->setCellValue('P'.($key+2), $value['owner'])
            ->setCellValue('Q'.($key+2), date('Y-m-d',$value['storedate']))
            ->setCellValue('R'.($key+2), $value['havephoto'])
            ->setCellValue('S'.($key+2), $value['payment'])
            ->setCellValue('T'.($key+2), $value['content']);
           
        }
        
    $filename = date('YmdHis').'.xlsx'; //�����ļ���  
    $updir = './uploads/csv/';

    // Rename worksheet
    $objPHPExcel->getActiveSheet()->setTitle('Simple');
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    // Redirect output to a client��s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
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
    


  /* ������Ʒ */
    public function care(){
        global $login;
        $data['login']=$login;



   /////////
        $order_by = 'order by datetime desc';
       // $config['base_url'] = site_url('home/care_list');


        $titlesql='';
        $pidsql='';
        $codesql='';
        $orderfromsql='';
        $mobilesql='';
        $usernamesql='';
        $statussql='';
        $agentidsql='';
        $getwaysql='';
        $sentwaysql='';
        $urgentsql='';
        $startdaysql='';
        $enddaysql='';
        $ispaybacksql='';



        $title = $this->input->get('title', true);
        $pid = $this->input->get('pid', true);
        $code = $this->input->get('code', true);

        $orderfrom = $this->input->get('orderfrom', true);
        $mobile = $this->input->get('mobile', true);
         $username = $this->input->get('username', true);
        $status = $this->input->get('status', true);
        $agentid = $this->input->get('agentid', true);
  
        $getway = $this->input->get('getway', true);
        $sentway = $this->input->get('sentway', true);
        
        $urgent = $this->input->get('urgent', true);

        $startday = $this->input->get('startday', true);
        $endday= $this->input->get('endday', true);

        $ispayback = $this->input->get('ispayback', true);
         
        $searchstr='';
        $search=array('title'=>$title,'pid'=>$pid,'code'=>$code,'orderfrom'=>$orderfrom,'mobile'=>$mobile,'username'=>$username,'status'=>$status, 'agentid'=>$agentid,'getway'=>$getway,'sentway'=>$sentway,'urgent'=>$urgent,'endday'=>$endday,'startday'=>$startday,'ispayback'=>$ispayback);
        foreach ($search as $key => $value) {
            $searchstr=$searchstr.'&'.$key.'='.$value;
        }
        

        if($title){ $titlesql=" and  title like '%".$title."%' ";}
        if($pid){ $pidsql=" and  pid like '%".$pid."%' " ;}
        if($code){ $codesql=" and  code= '".$code."' " ;}

        if($orderfrom){ $orderfromsql=" and  orderfrom like '%".$orderfrom."%' " ;}

        if($mobile){ $mobilesql=" and  mobile= '".$mobile."' " ;}
         if($username){ $usernamesql=" and  username like '%".$username."%' " ;}
        if($status){ $statussql=" and  status= ".$status." " ;}
        
        if($agentid){ $agentidsql=" and  agentid= ".$agentid." " ;}
        
        if($urgent){ $urgentsql=" and  urgent= '".$urgent."' " ;}

        if($ispayback){ $ispaybacksql=" and ispayback= ".$ispayback." " ;}
       

        if($startday){
            $starttime=strtotime($startday);
            $startdaysql=" and  datetime >=".$starttime." ";
        }

        if($endday){
            $endtime=strtotime($endday);
            $enddaysql=" and  datetime <=".$endtime." ";
        }

        $sqlstr=$titlesql.$pidsql.$codesql.$orderfromsql.$mobilesql.$usernamesql.$statussql.$agentidsql.$getwaysql.$sentwaysql.$urgentsql.$startdaysql.$enddaysql;

        // ������ҳ��
        $wd = $this->uri->segment(4, '0');
        
        $sql = 'select * from ' . PREFIX . 'care where siteid='.SITEID.' '.$sqlstr;
         
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("����Ʒ")
                                     ->setLastModifiedBy("����Ʒ")
                                     ->setTitle("����Ʒ�ļ�")
                                     ->setSubject("����ƷExcel�ļ�")
                                     ->setDescription("����Ʒ�ļ���������վϵͳ")
                                     ->setKeywords("����Ʒ")
                                     ->setCategory("����Ʒ");

        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', '����')
                    ->setCellValue('B1', '����')
                    ->setCellValue('C1', '���')
                    ->setCellValue('D1', '�ͻ�����')
                    ->setCellValue('E1', '�ֻ�����')
                    ->setCellValue('F1', '��Ʒ���')
                    ->setCellValue('G1', 'Ʒ��')
                    ->setCellValue('H1', '������Դ')
                    ->setCellValue('I1', '���')
                    ->setCellValue('J1', '��������')
                    ->setCellValue('K1', '����ɱ�')
                    ->setCellValue('L1', '�����')
                    ->setCellValue('M1', 'ȡ������')
                    ->setCellValue('N1', '��������')
                    ->setCellValue('O1', '�Ƿ�Ӽ�')
                    ->setCellValue('P1', '�Ӽ�ԭ��')
                    ->setCellValue('Q1', '�ռ���ʽ')
                    ->setCellValue('R1', 'ȡ����ݹ�˾')
                    ->setCellValue('S1', 'ȡ����ݵ���')
                    ->setCellValue('T1', '�ͼ���ʽ')
                    ->setCellValue('U1', '�ͼ���ݹ�˾')
                    ->setCellValue('V1', '�ͼ���ݺ�')
                    ->setCellValue('W1', '��ע')
                    ->setCellValue('X1', '������')
                    ->setCellValue('Y1', '����״̬')
                    ->setCellValue('Z1', '���״̬')
                    ->setCellValue('AA1', '��������');
                    
  

        //$sql='select * from '.PREFIX.'product';
        $rsobj=$this->db->query($sql);
        $arr=$rsobj->result_array();


          foreach ($arr as $key => $value) {
            $arr[$key]['categoryname']=$this->home_model->getC($value['category'], 'id', 'name', PREFIX.'category');
            # code...
        }


     
   

           foreach ($arr as $key => $value) {
            $arr[$key]['agentname']=$this->home_model->getC($value['agentid'], 'id', 'fullname', PREFIX.'user');
            # code...
        }


         foreach ($arr as $key => $value) {
            $arr[$key]['statusname']=$this->home_model->getC($value['status'], 'id', 'name', PREFIX.'care_code');
            # code...
        }

    foreach ($arr as $key => $value) {
            if($value['urgent']==1){
                $arr[$key]['urgent']='��';
            }else
            {
                 $arr[$key]['urgent']='��';
            }
             
        }


            foreach ($arr as $key => $value) {
            if($value['ispayback']==1){
                $arr[$key]['ispayback']='��';
            }else
            {
                 $arr[$key]['ispayback']='��';
            }
             
        }


        foreach ($arr as $key => $value) {

          
                  // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.($key+2), $value['title'])
                    ->setCellValue('B'.($key+2), $value['pid'])
                    ->setCellValue('C'.($key+2), $value['code'])
                    ->setCellValue('D'.($key+2), $value['username'])
                    ->setCellValue('E'.($key+2), $value['mobile'])
                    ->setCellValue('F'.($key+2), $value['categoryname'])
                    ->setCellValue('G'.($key+2), $value['brandname'])
                    ->setCellValue('H'.($key+2), $value['orderfrom'])
                    ->setCellValue('I'.($key+2), $value['accessory'])
                    ->setCellValue('J'.($key+2), $value['carecontent'])
                    ->setCellValue('K'.($key+2), $value['cost'])
                    ->setCellValue('L'.($key+2), $value['fee'])
                    ->setCellValue('M'.($key+2), $value['getkuaidifee'])
                    ->setCellValue('N'.($key+2), $value['kuaidifee'])
                    ->setCellValue('O'.($key+2), $value['urgent'])
                    ->setCellValue('P'.($key+2), $value['urgentreason'])
                    ->setCellValue('Q'.($key+2), $value['getway'])
                    ->setCellValue('R'.($key+2), $value['getkuaidicompany'])
                    ->setCellValue('S'.($key+2), $value['getkuaidi'])
                    ->setCellValue('T'.($key+2), $value['sentway'])
                    ->setCellValue('U'.($key+2), $value['kuaidicompany'])
                    ->setCellValue('V'.($key+2), $value['kuaidi'])
                    ->setCellValue('W'.($key+2), $value['content'])
                    ->setCellValue('X'.($key+2), $value['agentname'])
                    ->setCellValue('Y'.($key+2), $value['statusname'])
                    ->setCellValue('Z'.($key+2), $value['ispayback'])
                    ->setCellValue('AA'.($key+2), date('Y-m-d',$value['datetime']));
 
           
        }
        
    $filename = date('YmdHis').'.xlsx'; //�����ļ���  
    $updir = './uploads/csv/';

    // Rename worksheet
    $objPHPExcel->getActiveSheet()->setTitle('Simple');
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    // Redirect output to a client��s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
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



     public function sale(){

     	global $login;
        $data['login']=$login;

     	
        $titlesql='';
        $pidsql='';
        $saletypesql='';
        $cidsql='';
        $salemansql='';
        $receiversql='';
        $saleplatformsql='';
        $startdaysql='';
        $enddaysql='';
        $checktimesql='';
        $ispaybacksql='';

        $title = $this->input->get('title', true);
        $pid = $this->input->get('pid', true);
        $saletype = $this->input->get('saletype', true);
        $cid = $this->input->get('cid', true);
        $saleman = $this->input->get('saleman', true);
        $receiver = $this->input->get('receiver', true);
        $saleplatform = $this->input->get('saleplatform', true);
        $startday = $this->input->get('startday', true);
        $endday = $this->input->get('endday', true);
        $checktime = $this->input->get('checktime', true);
        $ispayback = $this->input->get('ispayback', true);

        $searchstr='';
        $search=array('title'=>$title,'pid'=>$pid,'saletype'=>$saletype,'cid'=>$cid,'saleman'=>$saleman,'receiver'=>$receiver,'saleplatform'=>$saleplatform,'startday'=>$startday,'endday'=>$endday,'checktime'=>$checktime,'ispayback'=>$ispayback);
        foreach ($search as $key => $value) {
            $searchstr=$searchstr.'&'.$key.'='.$value;
        }
         

        if($title){ $titlesql=" and  title like '%".$title."%' ";}
        if($pid){ $pidsql=" and  pid like '%".$pid."%' " ;}
        if($saletype){ $saletypesql=" and  saletype= ".$saletype." " ;}
        if($saleman){ $salemansql=" and  saleman = '".$saleman."' " ;}
        if($receiver){ $receiversql=" and  receiver = '".$receiver."' " ;}
        if($saleplatform){ $saleplatformsql=" and  saleplatform = '".$saleplatform."' " ;}

        //if($ispayback){ $ispaybacksql=" and  ispayback = ".$ispayback." " ;}

        if(is_numeric($ispayback)){ $ispaybacksql=" and ispayback= ".$ispayback." " ;}

        if($startday){
            $starttime=strtotime($startday);
            $startdaysql=" and  saletime >=".$starttime." ";
        }

        if($endday){
            $endtime=strtotime($endday);
            $enddaysql=" and  saletime <=".$endtime." ";
        }

        if($checktime=='today'){
            $time1='';
            $time2='';
            $tt='';
            $oldtime=strtotime("-7 days",time());
            $time1=date('Y-m-d',''.$oldtime);
           
  
            $time1=strtotime($time1);
            $time2=strtotime("+1 days",$time1);
            $checktimesql="and (saletime >=".$time1." and saletime <".$time2.")";
        }


        $sqlstr=$titlesql.$pidsql.$saletypesql.$salemansql.$receiversql.$cidsql.$saleplatformsql.$startdaysql.$enddaysql.$checktimesql.$ispaybacksql;
        $orderstr=' order by id desc';
        $sql = "select * from " . PREFIX . "sale  where siteid=".SITEID." ".$sqlstr.$orderstr;
        

                // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("����Ʒ")
                                     ->setLastModifiedBy("����Ʒ")
                                     ->setTitle("����Ʒ�ļ�")
                                     ->setSubject("����ƷExcel�ļ�")
                                     ->setDescription("����Ʒ�ļ���������վϵͳ")
                                     ->setKeywords("����Ʒ")
                                     ->setCategory("����Ʒ");

        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
                   
                    ->setCellValue('A1', '����')
                    ->setCellValue('B1', '����')
                    ->setCellValue('C1', '�ͻ����')
                    ->setCellValue('D1', '������')
                    ->setCellValue('E1', '��������')
                    ->setCellValue('F1', '�۳�ƽ̨')
                    ->setCellValue('G1', '�ۼ�')
                    ->setCellValue('H1', '����')
                    ->setCellValue('I1', '�ɱ�')
                    ->setCellValue('J1', '��������')
                    ->setCellValue('K1', '�������')
                    ->setCellValue('L1', 'ƽ̨������')
                    ->setCellValue('M1', '��ݷ�')
                    ->setCellValue('N1', '����')
                    ->setCellValue('O1', '����Ա')
                    ->setCellValue('P1', '�ջ���')
                    ->setCellValue('Q1', '֧����ʽ')
                    ->setCellValue('R1', '��ݹ�˾')
                    ->setCellValue('S1', '��ݵ���')
                    ->setCellValue('T1', '���״̬')
                    ->setCellValue('U1', '�۳�ʱ��');
        
        $rsobj=$this->db->query($sql);
        $arr=$rsobj->result_array();

        foreach ($arr as $key => $value) {

           $arr[$key]['platformname']=$this->home_model->getC($value['saleplatform'], 'id', 'name', PREFIX.'sale_platform');
        }


    foreach ($arr as $key => $value) {
            $arr[$key]['agentname']=$this->home_model->getC($value['agentid'], 'id', 'fullname', PREFIX.'user');
            # code...
        }


 foreach ($arr as $key => $value) {
            $arr[$key]['saletype']=$this->home_model->getC($value['saletype'], 'id', 'name', PREFIX.'product_status');
            # code...
        }


             foreach ($arr as $key => $value) {
            if($value['ispayback']==1){
                $arr[$key]['ispayback']='��';
            }else
            {
                 $arr[$key]['ispayback']='��';
            }
             
        }



        foreach ($arr as $key => $value) {
         $col=array();

              $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.($key+2), $value['title'])
                    ->setCellValue('B'.($key+2), $value['pid'])
                    ->setCellValue('C'.($key+2), $value['cid'])
                    ->setCellValue('D'.($key+2), $value['agentname'])
                    ->setCellValue('E'.($key+2), $value['saletype'])
                    ->setCellValue('F'.($key+2), $value['platformname'])
                    ->setCellValue('G'.($key+2), $value['price'])
                    ->setCellValue('H'.($key+2), $value['preprice'])
                    ->setCellValue('I'.($key+2), $value['costprice'])
                    ->setCellValue('J'.($key+2), $value['otherfee'])
                    ->setCellValue('K'.($key+2), $value['carefee'])
                    ->setCellValue('L'.($key+2), $value['platformfee'])
                    ->setCellValue('M'.($key+2), $value['kuaidifee'])
                    ->setCellValue('N'.($key+2), $value['siteprofit'])
                    ->setCellValue('O'.($key+2), $value['saleman'])
                    ->setCellValue('P'.($key+2), $value['receiver'])
                    ->setCellValue('Q'.($key+2), $value['payment'])
                    ->setCellValue('R'.($key+2), $value['kuaidicompany'])
                    ->setCellValue('S'.($key+2), $value['kuaidinum'])
                     ->setCellValue('T'.($key+2), $value['ispayback'])
                    ->setCellValue('U'.($key+2), date('Y-m-d',$value['saletime']));
 
        }

    
    $filename = date('YmdHis').'.xlsx'; //�����ļ���  
    $updir = './uploads/csv/';

    // Rename worksheet
    $objPHPExcel->getActiveSheet()->setTitle('Simple');
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    // Redirect output to a client��s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
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




 /* ������Ʒ */
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
        

  
            // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("����Ʒ")
                                     ->setLastModifiedBy("����Ʒ")
                                     ->setTitle("����Ʒ�ļ�")
                                     ->setSubject("����ƷExcel�ļ�")
                                     ->setDescription("����Ʒ�ļ���������վϵͳ")
                                     ->setKeywords("����Ʒ")
                                     ->setCategory("����Ʒ");

        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
                   
                    ->setCellValue('A1', '�ͻ����')
                    ->setCellValue('B1', '����')
                    ->setCellValue('C1', '΢����')
                    ->setCellValue('D1', '΢�ź�')
                    ->setCellValue('E1', '�ֻ���')
                    ->setCellValue('F1', '�ջ���ַ')
                    ->setCellValue('G1', '�����˻�')
                    ->setCellValue('H1', '��������')
                    ->setCellValue('I1', '��ͥ���')
                    ->setCellValue('J1', 'ְҵ��Ϣ')
                    ->setCellValue('K1', '������Ϣ')
                    ->setCellValue('L1', '�Ƽ���Դ')
                    ->setCellValue('M1', '��ע');
                   

        //$sql='select * from '.PREFIX.'product';
        $rsobj=$this->db->query($sql);
        $arr=$rsobj->result_array();

   


  foreach ($arr as $key => $value) {
                  
  // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
                   
                    ->setCellValue('A'.($key+2), $value['cid'])
                    ->setCellValue('B'.($key+2), $value['fullname'])
                    ->setCellValue('C'.($key+2), $value['weixinname'])
                    ->setCellValue('D'.($key+2), $value['weixinid'])
                    ->setCellValue('E'.($key+2), $value['mobile'])
                    ->setCellValue('F'.($key+2), $value['address'])
                    ->setCellValue('G'.($key+2), $value['payaccount'])
                    ->setCellValue('H'.($key+2), $value['personal'])
                    ->setCellValue('I'.($key+2), $value['family'])
                    ->setCellValue('J'.($key+2), $value['career'])
                    ->setCellValue('K'.($key+2), $value['tradeinfo'])
                    ->setCellValue('L'.($key+2), $value['channel'])
                    ->setCellValue('M'.($key+2), $value['content']);

        }

    $filename = date('YmdHis').'.xlsx'; //�����ļ���  
    $updir = './uploads/csv/';

    // Rename worksheet
    $objPHPExcel->getActiveSheet()->setTitle('Simple');
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    // Redirect output to a client��s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
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



	  
}