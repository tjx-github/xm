<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('PRC');
class Home extends CI_Controller
{
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

        if($login['roleid']==0)
        {
            exit('你没有权限 <a href="'.site_url("user/logout").'">退出</a>');
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
        $this->load->model("UpdateSaleOrProductModel","TUpdate");
    }
    /*
    	首页模块
    */
    public function index()
    {
        global $login;
        $data['login']=$login;
        $data['nav']=$this->load->view('home/nav',$data,true);

        $this->load->view('home/index',$data);
    }

    /*
            证书列表
    */

    public function cert_list()
    {
        global $login;
        $data=$this->home_model->cert_list();
        $data['login']=$login;
         $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/cert_list',$data);

    }

    /*
        证书添加页面 
    */
     public function cert_add()
    {
        global $login;
        $data['login']=$login;
        $query = $this->db->query("select * from " . PREFIX . "category  order by ordernum asc");
        $category = $query->result_array();
        $data['category'] = $category;

        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/cert_add',$data);

    }

    public function cert_del(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        $this->db->query('delete from '.PREFIX.'cert where id='.$id);
        header('location:'.site_url('home/cert_list'));
    }


 public function cert_add_save()
    {
        global $login;
        $data['login']=$login;

        $myinput['pid'] = $this->input->post('pid', true);
        $myinput['code'] = $this->input->post('code', true);
        $myinput['category'] = $this->input->post('category', true);

        $myinput['style'] = $this->input->post('style', true);
       // $myinput['material'] = $this->input->post('material', true);
       
        $brandname = $this->input->post('brandname', true);
        $myinput['brandname'] = $brandname;

        $updir = './uploads/cert/';
          ///封面图片
        $faceimg=$this->input->post('facephoto');
        if($faceimg<>''){
          $myinput['facephoto']=$this->upload->base64_upload($updir, $faceimg);
          $myinput['facephoto']='/uploads/cert/'.$myinput['facephoto'];
        }
        

        $imgs = $this->input->post('img');

        if(count($imgs)>0)
        {
          
            $imglist = array();
            foreach ($imgs as $key => $value) {
                $filename = $this->upload->base64_upload($updir, $value);
                $imglist[] = '/uploads/cert/' . $filename;
            }
          

            $jsonstr = json_encode($imglist);
            $myinput['photos'] = $jsonstr;

        }



        $myinput['datetime'] = time();
        $this->db->insert(PREFIX . 'cert', $myinput);
        $cid=$this->db->insert_ID();
        
        header('location:' . site_url('home/cert_list'));

    }



    public function cert_edit()
    {
        global $login;
        $data['login']=$login;

        $id=$this->uri->segment(3);

        ///获取订单信息
        $careobj=$this->db->from(PREFIX.'cert')->where('id',$id)->get()->result_array();
        if(count($careobj)<1)
        {
            exit('该证书不存在');
        }else
        {
            $cert=$careobj[0];
        }
        $data['cert'] = $cert;


        $query = $this->db->query("select * from " . PREFIX . "category  order by ordernum asc");
        $category = $query->result_array();
        $data['category'] = $category;
        $this->db->close();

        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/cert_edit',$data);

    }



    public function cert_edit_save()
    {
        global $login;
        $data['login']=$login;

        $id=$this->input->post('id', true);
        $myinput['pid'] = $this->input->post('pid', true);
        $myinput['code'] = $this->input->post('code', true);
        $myinput['category'] = $this->input->post('category', true);

        $myinput['style'] = $this->input->post('style', true);
       // $myinput['material'] = $this->input->post('material', true);
       
        $brandname = $this->input->post('brandname', true);
        $myinput['brandname'] = $brandname;

        $updir = './uploads/cert/';
          ///封面图片
        $faceimg=$this->input->post('facephoto');
        if($faceimg<>''){
          $myinput['facephoto']=$this->upload->base64_upload($updir, $faceimg);
          $myinput['facephoto']='/uploads/cert/'.$myinput['facephoto'];
        }
        

        $imgs = $this->input->post('img');

        if(count($imgs)>0)
        {
          
            $imglist = array();
            foreach ($imgs as $key => $value) {
                $filename = $this->upload->base64_upload($updir, $value);
                $imglist[] = '/uploads/cert/' . $filename;
            }
          

            $jsonstr = json_encode($imglist);
            $myinput['photos'] = $jsonstr;

        }

 

        $this->db->where('id',$id);
        $this->db->update(PREFIX . 'cert', $myinput);
        $cid=$this->db->insert_ID();
        
        header('location:' . site_url('home/cert_list'));

    }



    public function agree_add(){
        global $login;
        $data['login']=$login;
        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/agree_add',$data);
    }

    public function agree_add_save(){
        global $login;
        $data['login']=$login;

       // $salt=$this->user_model->createsalt();
        $D['code']=date('YmdHi');

        $D['startday'] = $this->input->post('startday', true);
        $D['endday']  = $this->input->post('endday', true); 
      

        $D['startday']=strtotime( $D['startday']);
        $D['endday']=strtotime( $D['endday']);
        $D['datetime']=time();

        $this->db->insert(PREFIX.'agree',$D);
        $ID= $this->db->insert_ID();

        header('location:'.site_url('home/agree/'.$ID));
    }

     public function agree(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
         // 读取订单信息
        $obj=$this->db->from(PREFIX.'agree')->where('id', $id)->get()->result_array();
        if(count($obj)<1)
        {
            exit('协议不存在!');
        }


        $agree=$obj[0];
        $data['agree']=$agree;
        
        $item=$this->db->from(PREFIX.'agree_item')->where('aid', $id)->get()->result();
        $data['item']=$item;

        if($agree['ck']==0)
        {
            $disablestr='';
        }else
        {
            $disablestr='disabled="disabled"';
        }
        $data['disablestr']=$disablestr;

        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/agree',$data);
    }

#协议列表
    public function agree_list(){
        global $login;
//        if(isset($_GET[''])){
//            
//        }else{
//            
//        }
        $data=$this->home_model->agree_list();
        $data['login']=$login;
        
        
        
        
        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/agree_list',$data);
    }


    public function agree_del(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        $this->db->query('delete from '.PREFIX.'agree where id='.$id);
         $this->db->query('delete from '.PREFIX.'agree_item where aid='.$id);
        header('location:'.site_url('home/agree_list'));
    }


/*
    协议作废
*/
    public function agree_cancel(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        $backurl = $_SERVER["HTTP_REFERER"];

        //$this->db->query('delete from '.PREFIX.'care where id='.$id);
        $this->db->query('update  '.PREFIX.'agree set ck=3,canceltime='.time().' where id='.$id);
        header('location:'.$backurl);
    }


/*
    协议作废
*/
    public function agree_copy(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        $backurl = $_SERVER["HTTP_REFERER"];

        $obj=$this->db->from(PREFIX.'agree')->where('id', $id)->get()->result_array();
        if(count($obj)<1)
        {
            exit('协议不存在!');
        }
        $agree=$obj[0];
        
        //原来的ITEM
        $olditem=$this->db->from(PREFIX.'agree_item')->where('aid', $id)->get()->result_array();
       


        $D['code']=$agree['code'].'-2';
        $D['userid']=$agree['userid'];
        $D['mobile']=$agree['mobile'];
        $D['startday']=$agree['startday'];
        $D['endday']=$agree['endday'];
        $D['datetime']=time();
        $this->db->insert(PREFIX.'agree',$D);
        $aid=$this->db->insert_ID();

        foreach ($olditem as $key => $value) {
            $T=array();
            $T['aid']=$aid;
            $T['pid']=$value['pid'];
            $T['brandname']=$value['brandname'];
            $T['site_sale_price']=$value['site_sale_price'];
            $T['amount']=$value['amount'];
            $T['pic']=$value['pic'];
            $this->db->insert(PREFIX.'agree_item',$T);
        }


 
        header('location:'.site_url('home/agree_list'));
    }



    public function agree_set_day(){
         global $login;
        $data['login']=$login;
    
        $aid=$this->input->post('aid',true);
        $D['startday']=$this->input->post('startday',true);
        $D['endday']=$this->input->post('endday',true);
        $D['startday']=strtotime( $D['startday']);
        $D['endday']=strtotime( $D['endday']);

        $this->db->where('id',$aid);
        $this->db->update(PREFIX.'agree',$D);
        header('location:'.site_url('home/agree/'.$aid));
    }
 
    public function agree_item_add_save(){

        global $login;
        $data['login']=$login;

        $D['aid']=$this->input->post('aid',true);
        $D['pid']=$this->input->post('pid',true);
        $D['brandname']=$this->input->post('brandname',true);
        $D['site_sale_price']=$this->input->post('site_sale_price',true);
        $D['amount']=$this->input->post('amount',true);
       

 
        $updir = './uploads/agree/';
        //记住这里post不能加true 加了就傻逼了
        $img = $this->input->post('img');
        $filename = $this->upload->base64_upload($updir, $img);
        $imgfile = '/uploads/agree/' . $filename;
        $facepic = $this->image_lib->make_small($imgfile, $updir);
        $D['pic']=$imgfile;
 
 
        $this->db->insert(PREFIX.'agree_item',$D);
        //header('location:'.site_url('home/agree/'.$aid));
        echo 'OK';
    }



    public function agree_item_edit_save(){

        global $login;
        $data['login']=$login;

        $id=$this->input->post('id',true);
      
        $D['pid']=$this->input->post('pid',true);
        $D['brandname']=$this->input->post('brandname',true);
        $D['site_sale_price']=$this->input->post('site_sale_price',true);
        $D['amount']=$this->input->post('amount',true);
       

 
        $updir = './uploads/agree/';
        //记住这里post不能加true 加了就傻逼了
        $img = $this->input->post('img');
        if($img!=''){
            $filename = $this->upload->base64_upload($updir, $img);
            $imgfile = '/uploads/agree/' . $filename;
            $facepic = $this->image_lib->make_small($imgfile, $updir);
            $D['pic']=$imgfile;
        }
 
        $this->db->where('id',$id);
        $this->db->update(PREFIX.'agree_item',$D);
        //header('location:'.site_url('home/agree/'.$aid));
        echo 'OK';
    }

       public function agree_item_del(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        $backurl = $_SERVER["HTTP_REFERER"];

        $this->db->query('delete from '.PREFIX.'agree_item where id='.$id);
        header('location:'.$backurl);
    }


    /*
        证书添加页面 
    */
     public function care_add()
    {
        global $login;
        $data['login']=$login;
          $query = $this->db->query("select * from " . PREFIX . "category  order by ordernum asc");
        $category = $query->result_array();
        $data['category'] = $category;

         $query = $this->db->query("select * from " . PREFIX . "kuaidi_company  order by ordernum asc");
        $kuaidicompany = $query->result_array();
        $data['kuaidicompany'] = $kuaidicompany;

        $query = $this->db->query("select * from " . PREFIX . "sale_payment  order by ordernum asc");
        $payment = $query->result_array();
        $data['payment'] = $payment;

        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/care_add',$data);

    }

/*
    添加洗护
*/
    public function care_add_save(){

        global $login;
        $data['login']=$login;

        $myinput['siteid'] = SITEID;

        $myinput['title'] = $this->input->post('title', true);
        $myinput['getkuaidicompany'] = $this->input->post('getkuaidicompany', true);
        $myinput['getkuaidi'] = $this->input->post('getkuaidi', true);
        $myinput['getkuaidifee'] = $this->input->post('getkuaidifee', true);

        $myinput['pid'] = $this->input->post('pid', true);
        $myinput['code'] = $this->input->post('code', true);

        $myinput['orderfrom'] = $this->input->post('orderfrom', true);
        $myinput['mobile'] = $this->input->post('mobile', true);
        $myinput['username'] = $this->input->post('username', true);
        $myinput['accessory'] = $this->input->post('accessory', true);
        $myinput['carecontent'] = $this->input->post('carecontent', true);
        $myinput['fee'] = $this->input->post('fee', true);
        $myinput['cost'] = $this->input->post('cost', true);

        $myinput['urgent'] = $this->input->post('urgent', true);
        if($myinput['urgent']=='')
        {
        $myinput['urgent']=0;
        }
        $myinput['urgentreason'] = $this->input->post('urgentreason', true);
        $myinput['getway'] = $this->input->post('getway', true);
        $myinput['sentway'] = $this->input->post('sentway', true);

        $myinput['category'] = $this->input->post('category', true);
 
        $myinput['brandname']  = $this->input->post('brandname', true);
        
         
        $myinput['content'] = $this->input->post('content', true);
        $myinput['payment'] = $this->input->post('payment', true);


        $updir = './uploads/care/';
          ///封面图片
        $faceimg=$this->input->post('facephoto');
        if($faceimg<>''){
          $myinput['facephoto']=$this->upload->base64_upload($updir, $faceimg);
          $myinput['facephoto']='/uploads/care/'.$myinput['facephoto'];
        }
        

        $imgs = $this->input->post('img');

        if(count($imgs)>0)
        {
          
            $imglist = array();
            foreach ($imgs as $key => $value) {
                $filename = $this->upload->base64_upload($updir, $value);
                $imglist[] = '/uploads/care/' . $filename;
            }
          

            $jsonstr = json_encode($imglist);
            $myinput['photos'] = $jsonstr;

        }



        $myinput['datetime'] = time();
        $this->db->insert(PREFIX . 'care', $myinput);
        $cid=$this->db->insert_ID();
        
        header('location:' . site_url('home/care_list'));
       
    }


    public  function care_edit(){
        global $login;
        $data['login']=$login;
        
        $id=$this->uri->segment(3);

        ///获取订单信息
        $careobj=$this->db->from(PREFIX.'care')->where('id',$id)->get()->result_array();
        if(count($careobj)<1)
        {
            exit('该订单不存在');
        }else
        {
            $care=$careobj[0];
        }
        $data['care'] = $care;


        ///获取订单状体
        $status=$this->db->from(PREFIX.'care_code')->get()->result_array();
        $data['status'] = $status;

        ///获取分类数据
        $query = $this->db->query("select * from " . PREFIX . "category  order by ordernum asc");
        $category = $query->result_array();
        $data['category'] = $category;

        $query = $this->db->query("select * from " . PREFIX . "sale_payment  order by ordernum asc");
        $payment = $query->result_array();
        $data['payment'] = $payment;

         ///获取品牌数据
        $brand=$this->db->from(PREFIX.'brand')->where('cid',$care['category'])->get()->result_array();
        $data['brand'] = $brand;

         $query = $this->db->query("select * from " . PREFIX . "kuaidi_company  order by ordernum asc");
        $kuaidicompany = $query->result_array();
        $data['kuaidicompany'] = $kuaidicompany;



        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/care_edit',$data);
    }



/*
    添加洗护
*/
    public function care_edit_save(){
        global $login;
        $data['login']=$login;

        $id=$this->input->post('id', true);
        
        $myinput['siteid'] = SITEID;
        $myinput['title'] = $this->input->post('title', true);
        $myinput['status'] = $this->input->post('status', true);
        $myinput['pid'] = $this->input->post('pid', true);
        $myinput['code'] = $this->input->post('code', true);

        $myinput['orderfrom'] = $this->input->post('orderfrom', true);
        $myinput['mobile'] = $this->input->post('mobile', true);
        $myinput['username'] = $this->input->post('username', true);
        $myinput['accessory'] = $this->input->post('accessory', true);
        $myinput['carecontent'] = $this->input->post('carecontent', true);
        $myinput['fee'] = $this->input->post('fee', true);
         $myinput['cost'] = $this->input->post('cost', true);

        $myinput['urgent'] = $this->input->post('urgent', true);
        if($myinput['urgent']=='')
        {
        $myinput['urgent']=0;
        }
        $myinput['urgentreason'] = $this->input->post('urgentreason', true);
        $myinput['getway'] = $this->input->post('getway', true);
        $myinput['sentway'] = $this->input->post('sentway', true);

        
        $myinput['getkuaidicompany'] = $this->input->post('getkuaidicompany', true);
        $myinput['getkuaidi'] = $this->input->post('getkuaidi', true);

        
        $myinput['getkuaidifee'] = $this->input->post('getkuaidifee', true);

        $myinput['kuaidicompany'] = $this->input->post('kuaidicompany', true);
        $myinput['kuaidi'] = $this->input->post('kuaidi', true);
        $myinput['kuaidifee'] = $this->input->post('kuaidifee', true);
        $myinput['payment'] = $this->input->post('payment', true);

        $myinput['category'] = $this->input->post('category', true);

       
        $myinput['brandname']  = $this->input->post('brandname', true);
        

        $myinput['content'] = $this->input->post('content', true);

        

        $updir = './uploads/care/';
        
        $faceimg=$this->input->post('facephoto');
        if($faceimg<>''){
          $myinput['facephoto']=$this->upload->base64_upload($updir, $faceimg);
          $myinput['facephoto']='/uploads/care/'.$myinput['facephoto'];
        }
        

        $imgs = $this->input->post('img');

        if(count($imgs)>0)
        {
          
            $imglist = array();
            foreach ($imgs as $key => $value) {
                $filename = $this->upload->base64_upload($updir, $value);
                $imglist[] = '/uploads/care/' . $filename;
            }
          

            $jsonstr = json_encode($imglist);
            $myinput['photos'] = $jsonstr;

        }


    /*
        $updir = './uploads/care/';
        $imgs = $this->input->post('img');
        $imglist = array();
        foreach ($imgs as $key => $value) {
            $filename = $this->upload->base64_upload($updir, $value);
            $imglist[] = './uploads/care/' . $filename;
        }
        $facepic = $this->image_lib->make_small($imglist[0], $updir);
        $jsonstr = json_encode($imglist);
       

        $myinput['photos'] = $jsonstr;
       
    */
/*
  * pid     商品编号    $myinput['pid'] 
  * status  订单状态    $myinput['status']
  * 
  * uz_product	库存产品   
  * uz_care	护理表
  */

        $this->db->where('id',$id);
        $this->db->update(PREFIX.'care', $myinput);
        #有货号，
        if(mb_strlen( trim($myinput['pid']) ) ){
            $this->TUpdate->UpdateProductStatus( $myinput);
            
        }
        
        
        
//        $this->db->update(PREFIX.'care');
        
        
        header('location:' . site_url('home/care_list'));
         
        //$cid=$this->db->insert_ID();
        //header('location:' . site_url('home/care_list'));
        
//        if( $this->session->carelisturl){
//            header('location:' .$this->session->carelisturl);
//         }else{
//         header('location:' . site_url('home/sale_list'));
//       }
       
    }

/*
    洗护列表
*/

        public function care_list()
    {
        global $login;
        $data=$this->home_model->care_list();
        $data['login']=$login;


        $query = $this->db->query("select * from " . PREFIX . "category  order by ordernum asc");
        $category = $query->result_array();
        $data['category'] = $category;
 

        $query = $this->db->query("select * from " . PREFIX . "care_code  order by id asc");
        $status = $query->result_array();
        $data['status'] = $status;

        $query = $this->db->query("select * from " . PREFIX . "user  where roleid=3 order by id asc");
        $agent = $query->result_array();
        $data['agent'] = $agent;

        $query = $this->db->query("select * from " . PREFIX . "sale_payment  order by ordernum asc");
        $payment = $query->result_array();
        $data['payment'] = $payment;

         $url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
        $this->session->carelisturl=$url;
        $this->session->sess_expiration=31536000;


        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/care_list',$data);

    }


/*
    删除洗护
*/
    public function care_del(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        $backurl = $_SERVER["HTTP_REFERER"];

        $this->db->query('delete from '.PREFIX.'care where id='.$id.' and siteid='.SITEID);
        header('location:'.$backurl);
    }



/*护理设置是否结款*/
    public function care_set_payback(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        $this->db->query('update  '.PREFIX."care set ispayback=1,datetime='". time()  ."'  where id=".$id);
        //header('location:' . site_url('home/sale_list'));
        header('location:'. ($_SERVER["HTTP_REFERER"] ? $_SERVER["HTTP_REFERER"] : site_url('home/sale_list'))  );
    }


/*
    库存系统
*/
    public function product_add()
    {
        global $login;
        $data['login']=$login;

        
       
        $query = $this->db->query("select * from " . PREFIX . "category  order by ordernum asc");
        $category = $query->result_array();
        $data['category'] = $category;


        $query = $this->db->query("select * from " . PREFIX . "city  order by ordernum asc");
        $city = $query->result_array();
        $data['city'] = $city;

        $query = $this->db->query("select * from " . PREFIX . "saleman  order by ordernum asc");
        $saleman = $query->result_array();
        $data['saleman'] = $saleman;

         $query = $this->db->query("select * from " . PREFIX . "sale_payment  order by ordernum asc");
        $payment = $query->result_array();
        $data['payment'] = $payment;

        $query = $this->db->query("select * from " . PREFIX . "store  order by ordernum asc");
        $store = $query->result_array();
        $data['store'] = $store;

        $query = $this->db->query("select * from " . PREFIX . "product_status  order by ordernum asc");
        $status = $query->result_array();
        $data['status'] = $status;

        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/product_add',$data);
    }


/*
        库存添加保存
*/
    public function product_add_save(){

        global $login;
        $data['login']=$login;

        $pid=$this->input->post('pid', true);

        $pidobj=$this->db->from(PREFIX.'product')->where(array('pid'=>$pid,'siteid'=>SITEID))->get()->result_array();

        
        if(count($pidobj)<1)
            {
               
            }else
            {
                exit('<font color="red">该货号已经存在</font>');
            }

        $myinput['pid'] = strtoupper($this->input->post('pid', true));
        $myinput['siteid'] = SITEID;
        $myinput['title'] = $this->input->post('title', true);
        $myinput['saletype'] = $this->input->post('saletype', true);
        $myinput['category'] = $this->input->post('category', true);
        $myinput['size'] = $this->input->post('size', true);
        $myinput['storeid'] = $this->input->post('storeid', true);
        $myinput['costprice'] = $this->input->post('costprice', true);
        $myinput['saleprice'] = $this->input->post('saleprice', true);
        $myinput['rivalprice'] = $this->input->post('rivalprice', true);
        $myinput['holdprice'] = $this->input->post('holdprice', true);
        $myinput['otherfee'] = $this->input->post('otherfee', true);
        $myinput['status'] = $this->input->post('status', true);
        $myinput['cityid'] = $this->input->post('cityid', true);
        $myinput['agentid'] = $this->input->post('agentid', true);

        $myinput['receiver'] = $this->input->post('receiver', true);
        $myinput['owner'] = $this->input->post('owner', true);

        $myinput['payment'] = $this->input->post('payment', true);
        $myinput['content'] = $this->input->post('content', true);

        $myinput['storedate'] = $this->input->post('storedate', true);
        $myinput['storedate']=strtotime($myinput['storedate']);


        $havephoto= $this->input->post('havephoto', true);
        if($havephoto)
        {
            $havephoto=0;
        }
         $myinput['havephoto']=$havephoto;

        $myinput['adminid']=$login['id'];
       
  
        //$updir = '/www/';

        $updir = './uploads/product/';

       
        ///封面图片
        $faceimg=$this->input->post('facephoto');
        if($faceimg<>''){
          $myinput['facephoto']=$this->upload->base64_upload($updir, $faceimg);
          $myinput['facephoto']='/uploads/product/'.$myinput['facephoto'];
        }
        

        $imgs = $this->input->post('img');



        if(count($imgs)>0)
        {
          
            $imglist = array();
            foreach ($imgs as $key => $value) {
                $filename = $this->upload->base64_upload($updir, $value);
                $imglist[] = '/uploads/product/' . $filename;
            }
          

            $jsonstr = json_encode($imglist);
            $myinput['photos'] = $jsonstr;

        }

        $myinput['datetime'] = time();
        $this->db->insert(PREFIX . 'product', $myinput);
        $cid=$this->db->insert_ID();
        
        header('location:' . site_url('home/product_list'));
    }

    //检查PID是否存在
    public function checkpid(){
        $pid=$this->uri->segment(3,0);
        if($pid==''||$pid=='0')
        {
            
            exit('<font color="red">请输入货号</font>');
        }else
        {

            $pid=strtoupper($pid);
           $pidobj=$this->db->from(PREFIX.'product')->where(array('pid'=>$pid,'siteid'=>SITEID))->get()->result_array();
           if(count($pidobj)<1)
            {
                exit('<font color="green">该货号可用</font>');
            }else
            {
                exit('<font color="red">该货号已经存在</font>');
            }

        }

         
    }



/*搜索代理商*/
    public function searchagent(){
        $wd=$this->uri->segment(3);
        $wd=urldecode($wd);
        $sql="select * from  ".PREFIX."user where (fullname like '%".$wd."%' or nickname like '%".$wd."%' ) limit 0,10";
       
        $rsobj=$this->db->query($sql);
        $arr=$rsobj->result_array();
        foreach ($arr as $key => $value) {
            echo "<li id=".$value['id']." title=".$value['fullname']." onclick='clickagent(this.id,this.title);' ><a href='###'>".$value['fullname']."</a></li>";
        }
        echo '<li style="text-align:center"><a href="###" onclick="closesuggest()">关闭</a><li>';
    }

#编辑产品
    public function product_edit(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        $proobj=$this->db->from(PREFIX.'product')->where(array('id'=>$id,'siteid'=>SITEID))->get()->result_array();
        if(count($proobj)<1)
        {
            exit('该产品不存在');
        }else
        {
            $product=$proobj[0];
        }
        //代理商姓名
        if($product['agentid']>0)
        {
            $product['agentname']=$this->home_model->getC($product['agentid'], 'id', 'fullname', PREFIX.'user');
    
        }else{
            $product['agentname']='';
        }
        $data['product'] = $product;


        $query = $this->db->query("select * from " . PREFIX . "category  order by ordernum asc");
        $category = $query->result_array();
        $data['category'] = $category;


        $query = $this->db->query("select * from " . PREFIX . "city  order by ordernum asc");
        $city = $query->result_array();
        $data['city'] = $city;

        $query = $this->db->query("select * from " . PREFIX . "saleman  order by ordernum asc");
        $saleman = $query->result_array();
        $data['saleman'] = $saleman;

         $query = $this->db->query("select * from " . PREFIX . "sale_payment  order by ordernum asc");
        $payment = $query->result_array();
        $data['payment'] = $payment;

        $query = $this->db->query("select * from " . PREFIX . "store  order by ordernum asc");
        $store = $query->result_array();
        $data['store'] = $store;

        $query = $this->db->query("select * from " . PREFIX . "product_status  order by ordernum asc");
        $status = $query->result_array();
        $data['status'] = $status;

        


        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/product_edit',$data);

    }


    /* 产品列表 */
    public function product_list(){
        global $login;
        $data=$this->home_model->product_list();
        $data['login']=$login;
/*
 * uz_sale	销售表
 * uz_product	库存产品
 * 
 */

        $query = $this->db->query("select * from " . PREFIX . "category  order by ordernum asc");
        $category = $query->result_array();
        $data['category'] = $category;


        $query = $this->db->query("select * from " . PREFIX . "city  order by ordernum asc");
        $city = $query->result_array();
        $data['city'] = $city;

        $query = $this->db->query("select * from " . PREFIX . "saleman  order by ordernum asc");
        $saleman = $query->result_array();
        $data['saleman'] = $saleman;

        $query = $this->db->query("select * from " . PREFIX . "store  order by ordernum asc");
        $store = $query->result_array();
        $data['store'] = $store;

        $query = $this->db->query("select * from " . PREFIX . "product_status  order by ordernum asc");
        $status = $query->result_array();
        $data['status'] = $status;

        $query = $this->db->query("select * from " . PREFIX . "user  where roleid=3 order by id asc");
        $agent = $query->result_array();
        $data['agent'] = $agent;


        $query = $this->db->query("select * from " . PREFIX . "sale_payment  order by ordernum asc");
        $payment = $query->result_array();
        $data['payment'] = $payment;

        $prolisturl='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
        $this->session->prolisturl=$prolisturl;
        $this->session->sess_expiration=31536000;

        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/product_list',$data);

    }


    public function product_del(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        $backurl = $_SERVER["HTTP_REFERER"];

        $this->db->query('delete from '.PREFIX.'product where id='.$id.' and siteid='.SITEID);
        header('location:'.$backurl);
    }


     public function product_edit_save(){
        global $login;
        $data['login']=$login;
        $id=$this->input->post('id', true);
        $myinput['siteid'] = SITEID;
        $myinput['pid'] = $this->input->post('pid', true);
        $myinput['title'] = $this->input->post('title', true);
        $myinput['saletype'] = $this->input->post('saletype', true);
        $myinput['category'] = $this->input->post('category', true);
        $myinput['size'] = $this->input->post('size', true);
        $myinput['storeid'] = $this->input->post('storeid', true);
        $myinput['costprice'] = $this->input->post('costprice', true);
        $myinput['saleprice'] = $this->input->post('saleprice', true);
        $myinput['rivalprice'] = $this->input->post('rivalprice', true);
        $myinput['holdprice'] = $this->input->post('holdprice', true);
        $myinput['otherfee'] = $this->input->post('otherfee', true);
        $myinput['status'] = $this->input->post('status', true);
        $myinput['cityid'] = $this->input->post('cityid', true);
        $myinput['agentid'] = $this->input->post('agentid', true);
        $myinput['receiver'] = $this->input->post('receiver', true);
        $myinput['owner'] = $this->input->post('owner', true);

        $myinput['payment'] = $this->input->post('payment', true);
         $myinput['content'] = $this->input->post('content', true);

        $myinput['storedate'] = $this->input->post('storedate', true);
        $myinput['storedate']=strtotime($myinput['storedate']);

        $havephoto= $this->input->post('havephoto', true);
        if($havephoto!=1)
        {
            $havephoto=0;
        }
        $myinput['havephoto']=$havephoto;



        $updir = './uploads/product/';


         ///封面图片
        $faceimg=$this->input->post('facephoto');
        if($faceimg<>''){
          $myinput['facephoto']=$this->upload->base64_upload($updir, $faceimg);
          $myinput['facephoto']='/uploads/product/'.$myinput['facephoto'];
        }
        


        $imgs = $this->input->post('img');

       

        if(count($imgs)>0)
        {
            $imglist = array();
            foreach ($imgs as $key => $value) {
                $filename = $this->upload->base64_upload($updir, $value);
                $imglist[] = '/uploads/product/' . $filename;
            }
            //$facepic=$imglist[0];
            //$facepic = $this->image_lib->make_small($imglist[0], $updir);
            $jsonstr = json_encode($imglist);

           // $myinput['facephoto'] = $facepic;
            $myinput['photos'] = $jsonstr;
        }
        
 
        $this->db->where('id',$id);
        $this->db->update(PREFIX.'product',$myinput);
        print_r($myinput);
        $this->TUpdate->UpdateSale([
            "pid"=>$myinput["pid"]
        ],[
            "costprice"=>$myinput['costprice'],
            "otherfee"=>$myinput['otherfee']
        ] );
        
        if( $this->session->prolisturl){
         header('location:' .$this->session->prolisturl);
         }else
        {
         header('location:' . site_url('home/product_list'));
       }
       
     }




/*  辅助选项 */
    /*分类列表*/
    public function category_list(){
        global $login;
        $data['login']=$login;
        $query = $this->db->query("select * from " . PREFIX . "category  order by ordernum asc");
        $category = $query->result();
        $data['category'] = $category;

        $query = $this->db->query("select max(ordernum) as t from " . PREFIX . "category ");
        $maxarr = $query->result_array();
        $data['maxnum'] = $maxarr[0]['t']+1;


        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/category_list',$data);
    }

/*增加分类*/
    public function category_add_save(){
         global $login;
        $data['login']=$login;
      
        $myinput['name'] = $this->input->post('name', true);
        $myinput['ordernum'] = $this->input->post('ordernum', true);
    
        
        $this->db->insert(PREFIX.'category',$myinput);
        header('location:' . site_url('home/category_list'));
    }

/*修改分类*/
    public function category_edit_save(){
         global $login;
        $data['login']=$login;
        $id=$this->input->post('id', true);
        $myinput['name'] = $this->input->post('name', true);
        $myinput['ordernum'] = $this->input->post('ordernum', true);
    
       
        $this->db->where('id',$id);
        $this->db->update(PREFIX.'category',$myinput);
        header('location:' . site_url('home/category_list'));
    }

/*修改分类*/
    public function category_del(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        
        $this->db->query('delete from '.PREFIX.'category where id='.$id);
        header('location:' . site_url('home/category_list'));
    }

 

 
    /*城市列表*/
    public function city_list(){
        global $login;
        $data['login']=$login;
        $query = $this->db->query("select * from " . PREFIX . "city  order by ordernum asc");
        $city = $query->result();
        $data['city'] = $city;

        $query = $this->db->query("select max(ordernum) as t from " . PREFIX . "city ");
        $maxarr = $query->result_array();
        $data['maxnum'] = $maxarr[0]['t']+1;


        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/city_list',$data);
    }

/*增加城市*/
    public function city_add_save(){
         global $login;
        $data['login']=$login;
      
        $myinput['name'] = $this->input->post('name', true);
        $myinput['ordernum'] = $this->input->post('ordernum', true);
    
        
        $this->db->insert(PREFIX.'city',$myinput);
        header('location:' . site_url('home/city_list'));
    }

/*修改城市*/
    public function city_edit_save(){
         global $login;
        $data['login']=$login;
        $id=$this->input->post('id', true);
        $myinput['name'] = $this->input->post('name', true);
        $myinput['ordernum'] = $this->input->post('ordernum', true);
    
       
        $this->db->where('id',$id);
        $this->db->update(PREFIX.'city',$myinput);
        header('location:' . site_url('home/city_list'));
    }

/*删除城市*/
    public function city_del(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        
        $this->db->query('delete from '.PREFIX.'city where id='.$id);
        header('location:' . site_url('home/city_list'));
    }




 /*销售员列表*/
    public function saleman_list(){
        global $login;
        $data['login']=$login;
        $query = $this->db->query("select * from " . PREFIX . "saleman  order by ordernum asc");
        $saleman = $query->result();
        $data['saleman'] = $saleman;

        $query = $this->db->query("select max(ordernum) as t from " . PREFIX . "saleman ");
        $maxarr = $query->result_array();
        $data['maxnum'] = $maxarr[0]['t']+1;


        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/saleman_list',$data);
    }

/*增加销售员*/
    public function saleman_add_save(){
         global $login;
        $data['login']=$login;
      
        $myinput['name'] = $this->input->post('name', true);
        $myinput['ordernum'] = $this->input->post('ordernum', true);
    
        
        $this->db->insert(PREFIX.'saleman',$myinput);
        header('location:' . site_url('home/saleman_list'));
    }

/*修改销售员*/
    public function saleman_edit_save(){
         global $login;
        $data['login']=$login;
        $id=$this->input->post('id', true);
        $myinput['name'] = $this->input->post('name', true);
        $myinput['ordernum'] = $this->input->post('ordernum', true);
    
       
        $this->db->where('id',$id);
        $this->db->update(PREFIX.'saleman',$myinput);
        header('location:' . site_url('home/saleman_list'));
    }

/*删除销售员*/
    public function saleman_del(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        
        $this->db->query('delete from '.PREFIX.'salema where id='.$id);
        header('location:' . site_url('home/saleman_list'));
    }



 
    /*仓库列表*/
    public function store_list(){
        global $login;
        $data['login']=$login;
        $query = $this->db->query("select * from " . PREFIX . "store  order by ordernum asc");
        $store = $query->result();
        $data['store'] = $store;
        foreach ($store as $key => $value) {
            $sql="select * from ".PREFIX."product where storeid=".$value->id." and siteid=".SITEID;
            $arr=$this->db->query($sql)->result_array();
            $store[$key]->count=count($arr);
        }

        $query = $this->db->query("select max(ordernum) as t from " . PREFIX . "store ");
        $maxarr = $query->result_array();
        $data['maxnum'] = $maxarr[0]['t']+1;


        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/store_list',$data);
    }

/*增加仓库*/
    public function store_add_save(){
         global $login;
        $data['login']=$login;
      
        $myinput['name'] = $this->input->post('name', true);
        $myinput['ordernum'] = $this->input->post('ordernum', true);
    
        
        $this->db->insert(PREFIX.'store',$myinput);
        header('location:' . site_url('home/store_list'));
    }

/*修改仓库*/
    public function store_edit_save(){
         global $login;
        $data['login']=$login;
        $id=$this->input->post('id', true);
        $myinput['name'] = $this->input->post('name', true);
        $myinput['ordernum'] = $this->input->post('ordernum', true);
    
       
        $this->db->where('id',$id);
        $this->db->update(PREFIX.'store',$myinput);
        header('location:' . site_url('home/store_list'));
    }

/*删除仓库*/
    public function store_del(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        
        $this->db->query('delete from '.PREFIX.'store where id='.$id);
        $sql="update ".PREFIX."product set storeid=2 where storeid=".$id;
        $this->db->query($sql);

        header('location:' . site_url('home/store_list'));
    }





    /*仓库列表*/
    public function product_status_list(){
        global $login;
        $data['login']=$login;
        $query = $this->db->query("select * from " . PREFIX . "product_status  order by ordernum asc");
        $status = $query->result();
        $data['status'] = $status;

        $query = $this->db->query("select max(ordernum) as t from " . PREFIX . "product_status ");
        $maxarr = $query->result_array();
        $data['maxnum'] = $maxarr[0]['t']+1;


        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/product_status_list',$data);
    }

/*增加仓库*/
    public function product_status_add_save(){
         global $login;
        $data['login']=$login;
      
        $myinput['name'] = $this->input->post('name', true);
        $myinput['ordernum'] = $this->input->post('ordernum', true);
    
        
        $this->db->insert(PREFIX.'product_status',$myinput);
        header('location:' . site_url('home/product_status_list'));
    }

/*修改仓库*/
    public function product_status_edit_save(){
         global $login;
        $data['login']=$login;
        $id=$this->input->post('id', true);
        $myinput['name'] = $this->input->post('name', true);
        $myinput['ordernum'] = $this->input->post('ordernum', true);
        $this->db->where('id',$id);
        $this->db->update(PREFIX.'product_status',$myinput);
        header('location:' . site_url('home/product_status_list'));
    }

/*删除仓库*/
    public function product_status_del(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        
        $this->db->query('delete from '.PREFIX.'product_status where id='.$id);
        header('location:' . site_url('home/product_status_list'));
    }




     /*销售平台列表*/
    public function sale_platform_list(){
        global $login;
        $data['login']=$login;
        $query = $this->db->query("select * from " . PREFIX . "sale_platform  order by ordernum asc");
        $platform = $query->result();
        $data['platform'] = $platform;

        $query = $this->db->query("select max(ordernum) as t from " . PREFIX . "sale_platform ");
        $maxarr = $query->result_array();
        $data['maxnum'] = $maxarr[0]['t']+1;


        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/sale_platform_list',$data);
    }

/*增加销售平台*/
    public function sale_platform_add_save(){
         global $login;
        $data['login']=$login;
      
        $myinput['name'] = $this->input->post('name', true);
        $myinput['ordernum'] = $this->input->post('ordernum', true);
    
        
        $this->db->insert(PREFIX.'sale_platform',$myinput);
        header('location:' . site_url('home/sale_platform_list'));
    }

/*修改销售平台*/
    public function sale_platform_edit_save(){
         global $login;
        $data['login']=$login;
        $id=$this->input->post('id', true);
        $myinput['name'] = $this->input->post('name', true);
        $myinput['ordernum'] = $this->input->post('ordernum', true);
        $this->db->where('id',$id);
        $this->db->update(PREFIX.'sale_platform',$myinput);
        header('location:' . site_url('home/sale_platform_list'));
    }

/*删除销售平台*/
    public function sale_platform_del(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        
        $this->db->query('delete from '.PREFIX.'sale_platform where id='.$id);
        header('location:' . site_url('home/sale_platform_list'));
    }




/*快递公司列表*/
    public function kuaidi_company_list(){
        global $login;
        $data['login']=$login;
        $query = $this->db->query("select * from " . PREFIX . "kuaidi_company  order by ordernum asc");
        $kuaidicompany = $query->result();
        $data['kuaidicompany'] = $kuaidicompany;

        $query = $this->db->query("select max(ordernum) as t from " . PREFIX . "kuaidi_company ");
        $maxarr = $query->result_array();
        $data['maxnum'] = $maxarr[0]['t']+1;


        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/kuaidi_company_list',$data);
    }

/*增加快递公司*/
    public function kuaidi_company_add_save(){
         global $login;
        $data['login']=$login;
      
        $myinput['name'] = $this->input->post('name', true);
        $myinput['ordernum'] = $this->input->post('ordernum', true);
    
        
        $this->db->insert(PREFIX.'kuaidi_company',$myinput);
        header('location:' . site_url('home/kuaidi_company_list'));
    }

/*修改快递公司*/
    public function kuaidi_company_edit_save(){
         global $login;
        $data['login']=$login;
        $id=$this->input->post('id', true);
        $myinput['name'] = $this->input->post('name', true);
        $myinput['ordernum'] = $this->input->post('ordernum', true);
        $this->db->where('id',$id);
        $this->db->update(PREFIX.'kuaidi_company',$myinput);
        header('location:' . site_url('home/kuaidi_company_list'));
    }

/*删除快递公司*/
    public function kuaidi_company_del(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        
        $this->db->query('delete from '.PREFIX.'kuaidi_company where id='.$id);
        header('location:' . site_url('home/kuaidi_company_list'));
    }


 



/*付款方式列表*/
    public function sale_payment_list(){
        global $login;
        $data['login']=$login;
        $query = $this->db->query("select * from " . PREFIX . "sale_payment  order by ordernum asc");
        $payment = $query->result();
        $data['payment'] = $payment;

        $query = $this->db->query("select max(ordernum) as t from " . PREFIX . "sale_payment ");
        $maxarr = $query->result_array();
        $data['maxnum'] = $maxarr[0]['t']+1;


        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/sale_payment_list',$data);
    }

/*增加付款方式*/
    public function sale_payment_add_save(){
         global $login;
        $data['login']=$login;
      
        $myinput['name'] = $this->input->post('name', true);
        $myinput['ordernum'] = $this->input->post('ordernum', true);
    
        
        $this->db->insert(PREFIX.'sale_payment',$myinput);
        header('location:' . site_url('home/sale_payment_list'));
    }

/*修改付款方式*/
    public function sale_payment_edit_save(){
         global $login;
        $data['login']=$login;
        $id=$this->input->post('id', true);
        $myinput['name'] = $this->input->post('name', true);
        $myinput['ordernum'] = $this->input->post('ordernum', true);
        $this->db->where('id',$id);
        $this->db->update(PREFIX.'sale_payment',$myinput);
        header('location:' . site_url('home/sale_payment_list'));
    }

/*删除付款方式*/
    public function sale_payment_del(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        
        $this->db->query('delete from '.PREFIX.'sale_payment where id='.$id);
        header('location:' . site_url('home/sale_payment_list'));
    }




/*
    添加销售
*/
public function sale_add()
    {
        global $login;
        $data['login']=$login;

        $pid=$this->uri->segment(3,0);

        $product=array('title'=>'','agentid'=>0,'pid'=>'','category'=>'','costprice'=>'0','otherfee'=>'0','carefee'=>'0','receiver'=>'','facephoto'=>'');

        if($pid!='')
        {

                $proobj=$this->db->from(PREFIX.'product')->where(array('pid'=>$pid,'siteid'=>SITEID))->get()->result_array();
                if(count($proobj)<1)
                {
                    exit('该订单不存在');
                }else
                {
                    $product=$proobj[0];
                }

                $proobj=$this->db->from(PREFIX.'care')->where(array('pid'=>$pid,'siteid'=>SITEID))->get()->result_array();
                if(count($proobj)<1)
                {
                     $product['carefee']=0;
                }else
                {
                    $product['carefee']=$proobj[0]['fee'];
                }




        }
       


        $query = $this->db->query("select * from " . PREFIX . "category  order by ordernum asc");
        $category = $query->result_array();
        $data['category'] = $category;

        $query = $this->db->query("select * from " . PREFIX . "sale_platform  order by ordernum asc");
        $platform = $query->result_array();
        $data['platform'] = $platform;

        $query = $this->db->query("select * from " . PREFIX . "sale_payment  order by ordernum asc");
        $payment = $query->result_array();
        $data['payment'] = $payment;

        $query = $this->db->query("select * from " . PREFIX . "saleman  order by ordernum asc");
        $saleman = $query->result_array();
        $data['saleman'] = $saleman;

        $query = $this->db->query("select * from " . PREFIX . "product_status  order by ordernum asc");
        $status = $query->result_array();
        $data['status'] = $status;

        $query = $this->db->query("select * from " . PREFIX . "kuaidi_company  order by ordernum asc");
        $kuaidicompany = $query->result_array();
        $data['kuaidicompany'] = $kuaidicompany;
        
        $data['product']=$product;

        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/sale_add',$data);
    }

/*
    添加销售 入库
*/
 public function sale_add_save(){
         global $login;
        $data['login']=$login;
      
        $myinput['siteid'] = SITEID;
        $myinput['title'] = $this->input->post('title', true);
        $myinput['pid'] = $this->input->post('pid', true);
        $myinput['cid'] = $this->input->post('cid', true);
        $myinput['agentid'] = $this->input->post('agentid', true);
        $myinput['saletype'] = $this->input->post('saletype', true);


        $price=$this->input->post('price', true);
        if(is_numeric($price)){
           $myinput['price'] = $price; 
        }else{
            $myinput['price'] = 0;
        }


        $preprice=$this->input->post('preprice', true);
        if(is_numeric($preprice)){
           $myinput['preprice'] = $preprice; 
        }else{
            $myinput['preprice'] = 0;
        }


        $costprice=$this->input->post('costprice', true);
        if(is_numeric($costprice)){
           $myinput['costprice'] = $costprice; 
        }else{
            $myinput['costprice'] = 0;
        }

        $carefee=$this->input->post('carefee', true);
        if(is_numeric($carefee)){
           $myinput['carefee'] = $carefee; 
        }else{
            $myinput['carefee'] = 0;
        }

         $otherfee=$this->input->post('otherfee', true);
        if(is_numeric($otherfee)){
           $myinput['otherfee'] = $otherfee; 
        }else{
            $myinput['otherfee'] = 0;
        }

         $platformfee=$this->input->post('platformfee', true);
        if(is_numeric($platformfee)){
           $myinput['platformfee'] = $platformfee; 
        }else{
            $myinput['platformfee'] = 0;
        }


        $myinput['saleplatform'] = $this->input->post('saleplatform', true);
        $myinput['saleman'] = $this->input->post('saleman', true);
        $myinput['receiver'] = $this->input->post('receiver', true);
        $myinput['payment'] = $this->input->post('payment', true);

        $myinput['kuaidicompany'] = $this->input->post('kuaidicompany', true);
        $myinput['kuaidinum'] = $this->input->post('kuaidinum', true);
        $myinput['kuaidifee'] = $this->input->post('kuaidifee', true);
        $myinput['saletime'] = $this->input->post('saletime', true);
        $myinput['saletime'] = strtotime($myinput['saletime']);


       


        $myinput['content'] = $this->input->post('content', true);
        $updir = './uploads/product/';
        ///封面图片
        $faceimg=$this->input->post('facephoto');

        if($faceimg<>''){
          $myinput['facephoto']=$this->upload->base64_upload($updir, $faceimg);
          $myinput['facephoto']='/uploads/product/'.$myinput['facephoto'];
        }else{
            $productface=$this->input->post('productface');
            if($productface<>''){
                 $myinput['facephoto']=$productface;
            }

        }
        



       // if($myinput['saletype']==4){
         /* 计算利润 */
            $myinput['siteprofit']=$myinput['price']-$myinput['costprice']-$myinput['otherfee']-$myinput['platformfee']-$myinput['kuaidifee'];
            if($myinput['agentid']>0)
            {
                $agentfee = $this->home_model->getC($myinput['agentid'], 'id', 'fee', PREFIX . 'user');
            }else
            {
                $agentfee=0;
            }

            $myinput['agentprofit']=round(($myinput['siteprofit']*$agentfee)/100,2);
        //}



        $myinput['datetime'] = time();
    
        
       

        $this->db->insert(PREFIX.'sale',$myinput);
        if($myinput['pid']!='')
        {
           
             $this->db->set('status',$myinput['saletype']);
             $this->db->where('pid',$myinput['pid']);
             $this->db->update(PREFIX.'product');
        }
       

        header('location:' . site_url('home/sale_list'));
    }

    /* 产品列表 */
      public function sale_list()    {
        global $login;
        
        $data=$this->home_model->sale_list();

        //销售平台
        $query = $this->db->query("select * from " . PREFIX . "sale_platform  order by ordernum asc");
        $platform = $query->result_array();
        $data['platform'] = $platform;

        $query = $this->db->query("select * from " . PREFIX . "saleman  order by ordernum asc");
        $saleman = $query->result_array();
        $data['saleman'] = $saleman;

        $query = $this->db->query("select * from " . PREFIX . "product_status  order by ordernum asc");
        $status = $query->result_array();
        $data['status'] = $status;

        $query = $this->db->query("select * from " . PREFIX . "user  where roleid=3 order by id asc");
        $agent = $query->result_array();
        $data['agent'] = $agent;


        $query = $this->db->query("select * from " . PREFIX . "sale_payment  order by ordernum asc");
        $payment = $query->result_array();
        $data['payment'] = $payment;


        $url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
        $this->session->salelisturl=$url;
        $this->session->sess_expiration=31536000;

        $data['login']=$login;
        $data['nav']=$this->load->view('home/nav',$data,true);
//        print_r($data);
//        die;
        $this->load->view('home/sale_list',$data);

    }
/* 修改销售订单 */
public function sale_edit(){
        global $login;
        $data['login']=$login;
       $id=$this->uri->segment(3);
        $saleobj=$this->db->from(PREFIX.'sale')->where(array('id'=>$id,'siteid'=>SITEID))->get()->result_array();
        if(count($saleobj)<1)
        {
            exit('该订单不存在');
        }else
        {
            $sale=$saleobj[0];
        }
        $data['sale'] = $sale;

        $query = $this->db->query("select * from " . PREFIX . "city  order by ordernum asc");
        $city = $query->result_array();
        $data['city'] = $city;
        $query = $this->db->query("select * from " . PREFIX . "saleman  order by ordernum asc");
        $saleman = $query->result_array();
        $data['saleman'] = $saleman;
        $query = $this->db->query("select * from " . PREFIX . "sale_platform  order by ordernum asc");
        $platform = $query->result_array();
        $data['platform'] = $platform;

        $query = $this->db->query("select * from " . PREFIX . "sale_payment  order by ordernum asc");
        $payment = $query->result_array();
        $data['payment'] = $payment;

        $query = $this->db->query("select * from " . PREFIX . "kuaidi_company  order by ordernum asc");
        $kuaidicompany = $query->result_array();
        $data['kuaidicompany'] = $kuaidicompany;
        

        $query = $this->db->query("select * from " . PREFIX . "product_status  order by ordernum asc");
        $status = $query->result_array();
        $data['status'] = $status;

        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/sale_edit',$data);
    }


/*
    添加销售 入库
*/
 public function sale_edit_save(){
        global $login;
        $data['login']=$login;
        $id = $this->input->post('id', true);
        $saleobj=$this->db->from(PREFIX.'sale')->where(array('id'=>$id,'siteid'=>SITEID))->get()->result_array();
        if(count($saleobj)<1){
            exit('该订单不存在');
        }else{
            $sale=$saleobj[0];
        }
        $myinput['siteid'] = SITEID;
        $myinput['title'] = $this->input->post('title', true);
        $myinput['pid'] = $this->input->post('pid', true);
        $myinput['cid'] = $this->input->post('cid', true);
        $myinput['agentid'] = $this->input->post('agentid', true);
        $myinput['saletype'] = $this->input->post('saletype', true);
        $price=$this->input->post('price', true);
        if(is_numeric($price)){
            $myinput['price'] = $price; 
        }else{
            $myinput['price'] = 0;
        }
        $preprice=$this->input->post('preprice', true);
        if(is_numeric($preprice)){
           $myinput['preprice'] = $preprice; 
        }else{
            $myinput['preprice'] = 0;
        }
        $costprice=$this->input->post('costprice', true);
        if(is_numeric($costprice)){
           $myinput['costprice'] = $costprice; 
        }else{
            $myinput['costprice'] = 0;
        }

        $carefee=$this->input->post('carefee', true);
        if(is_numeric($carefee)){
           $myinput['carefee'] = $carefee; 
        }else{
            $myinput['carefee'] = 0;
        }

        $otherfee=$this->input->post('otherfee', true);
       if(is_numeric($otherfee)){
          $myinput['otherfee'] = $otherfee; 
       }else{
           $myinput['otherfee'] = 0;
       }

        $platformfee=$this->input->post('platformfee', true);
       if(is_numeric($platformfee)){
          $myinput['platformfee'] = $platformfee; 
       }else{
           $myinput['platformfee'] = 0;
       }


       $myinput['saleplatform'] = $this->input->post('saleplatform', true);
       $myinput['saleman'] = $this->input->post('saleman', true);
       $myinput['receiver'] = $this->input->post('receiver', true);
       $myinput['payment'] = $this->input->post('payment', true);

       $myinput['kuaidicompany'] = $this->input->post('kuaidicompany', true);
       $myinput['kuaidinum'] = $this->input->post('kuaidinum', true);
       $myinput['kuaidifee'] = $this->input->post('kuaidifee', true);
       $myinput['saletime'] = $this->input->post('saletime', true);
       $myinput['saletime'] = strtotime($myinput['saletime']);

       $myinput['content'] = $this->input->post('content', true);
       $updir = './uploads/product/';
       ///封面图片
       $faceimg=$this->input->post('facephoto');
       if($faceimg<>''){
         $myinput['facephoto']=$this->upload->base64_upload($updir, $faceimg);
         $myinput['facephoto']='/uploads/product/'.$myinput['facephoto'];
       }


        if($myinput['saletype']<>$sale['saletype'])
       {
           $myinput['saletime'] = time();
       }


      // if($myinput['saletype']==4){
        /* 计算利润 */
           $myinput['siteprofit']=$myinput['price']-$myinput['costprice']-$myinput['otherfee']-$myinput['platformfee']-$myinput['kuaidifee'];
           if($myinput['agentid']>0)
           {
               $agentfee = $this->home_model->getC($myinput['agentid'], 'id', 'fee', PREFIX . 'user');
           }else
           {
               $agentfee=0;
           }

           $myinput['agentprofit']=round(($myinput['siteprofit']*$agentfee)/100,2);
       //}
       $this->db->where('id',$id);
       $this->db->where('siteid',SITEID);
       print_r($myinput);
       
       
       $this->db->update(PREFIX.'sale',$myinput); #更新销售表
        if($myinput['pid']!=''){
            #这段代码去掉。
//            $this->db->set('status',$myinput['saletype']); #更新库存表 入库状态
//            $this->db->where('pid',$myinput['pid']); 
//            $this->db->update(PREFIX.'product'); #更新库存表
            
            
            $this->TUpdate->UpdateProduct([
                "pid"=>$myinput['pid']
            ],[
                "costprice"=>$myinput["costprice"],  #成本价
                "otherfee"=>$myinput["otherfee"],     #其他费用
                "status"=>$myinput['saletype']  #此处更新
            ]);
            
            
            
       }

       if( $this->session->salelisturl){
            header('location:' .$this->session->salelisturl);
        }else{
            header('location:' . site_url('home/sale_list'));
        }

        
       // header('location:' . site_url('home/sale_list').'/?saletype='.$myinput['saletype']);
    }

/*删除销售*/
    public function sale_del(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        
        $this->db->query('delete from '.PREFIX.'sale where id='.$id.' and siteid='.SITEID);
        header('location:' . site_url('home/sale_list'));
    }

 
    public function sale_set_payback(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        
        $this->db->query('update  '.PREFIX.'sale set ispayback=1 where id='.$id);
        //header('location:' . site_url('home/sale_list'));
        header('location:'.$_SERVER["HTTP_REFERER"]);
    }





 /*添加客户*/
    public function user_add()
    {
        global $login;
        $data['login']=$login;

        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/user_add',$data);

    }



     /*添加客户*/
    public function user_add_save()
    {
        global $login;
        $data['login']=$login;

        $fullname=$this->input->post('fullname', true);
        $roleid=$this->input->post('roleid', true);
        $username=$this->input->post('username', true);
        $password=$this->input->post('password', true);

        $userobj=$this->db->from(PREFIX.'user')->where('username',$username)->get()->result_array();
        if(count($userobj)>0)
        {
            exit('用户名已存在，请返回');
        }

        $salt=$this->user_model->createsalt();
        
        $lasttime=time();

        $user['fullname']=$fullname;
        $user['nickname']=$fullname;
        $user['username']=$username;
        $user['roleid']=$roleid;
        $user['salt']=$salt;
        $user['password']=md5($password.$salt);
        $user['regtime']=$lasttime;
        $user['lastlogin']=$lasttime;
        
       
        $this->db->insert(PREFIX.'user',$user);

        if($roleid==3)
        {
            header('location:'.site_url('home/agent_list'));
        }

        if($roleid==0)
        {
            header('location:'.site_url('home/user_list'));
        }
        



    }

 /* 客户列表 */
      public function customer_list()
    {
        global $login;
        $data=$this->home_model->customer_list();
        $data['login']=$login;
        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/customer_list',$data);

    }


 /*添加客户*/
    public function customer_add()
    {
        global $login;
        $data['login']=$login;
 
        $query = $this->db->query("select * from " . PREFIX . "city  order by ordernum asc");
        $city = $query->result_array();
        $data['city'] = $city;

        $query = $this->db->query("select * from " . PREFIX . "saleman  order by ordernum asc");
        $saleman = $query->result_array();
        $data['saleman'] = $saleman;
 
        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/customer_add',$data);
    }



      //检查客户编号CID是否存在
    public function checkcid(){
        $cid=$this->uri->segment(3,0);
        if($cid==''||$cid=='0')
        {
            
            exit('<font color="red">请输入货号</font>');
        }else
        {
           $cid=strtoupper($cid);
           $cidobj=$this->db->from(PREFIX.'customer')->where('cid',$cid)->get()->result_array();
           if(count($cidobj)<1)
            {
                exit('<font color="green">该客户编号可用</font>');
            }else
            {
                exit('<font color="red">该客户编号已经存在</font>');
            }

        }

         
    }


    public function customer_add_save(){

        global $login;
        $data['login']=$login;

        $cid=$this->input->post('cid', true);

        $cidobj=$this->db->from(PREFIX.'customer')->where('cid',$cid)->get()->result_array();

        
        if(count($cidobj)<1)
            {
               
            }else
            {
                exit('<font color="red">该客户编号已经存在</font>');
            }
        
        $myinput['cid'] = strtoupper($this->input->post('cid', true));
        $myinput['fullname'] = $this->input->post('fullname', true);
        $myinput['weixinname'] = $this->input->post('weixinname', true);
        $myinput['weixinid'] = $this->input->post('weixinid', true);
        $myinput['mobile'] = $this->input->post('mobile', true);
        $myinput['address'] = $this->input->post('address', true);
        $myinput['payaccount'] = $this->input->post('payaccount', true);
        $myinput['personal'] = $this->input->post('personal', true);
        $myinput['family'] = $this->input->post('family', true);
        $myinput['career'] = $this->input->post('career', true);
        $myinput['tradeinfo'] = $this->input->post('tradeinfo', true);
        $myinput['channel'] = $this->input->post('channel', true);
        $myinput['content'] = $this->input->post('content', true);
        $myinput['datetime'] = time();
        $myinput['adminid']=$login['id'];
       
    
        $this->db->insert(PREFIX . 'customer', $myinput);
        $cid=$this->db->insert_ID();
        
        header('location:' . site_url('home/customer_list'));
    }

    /* 修改客户 */
 public function customer_edit(){
        global $login;
        $data['login']=$login;
        
        $id=$this->uri->segment(3);

        
        $cusobj=$this->db->from(PREFIX.'customer')->where('id',$id)->get()->result_array();
        if(count($cusobj)<1)
        {
            exit('该客户不存在');
        }else
        {
            $customer=$cusobj[0];
        }
 
        $data['customer'] = $customer;

        $query = $this->db->query("select * from " . PREFIX . "city  order by ordernum asc");
        $city = $query->result_array();
        $data['city'] = $city;

        $query = $this->db->query("select * from " . PREFIX . "saleman  order by ordernum asc");
        $saleman = $query->result_array();
        $data['saleman'] = $saleman;
  
        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/customer_edit',$data);

    }

/* 修改客户入库 */
  public function customer_edit_save(){

        global $login;
        $data['login']=$login;
        $id = $this->input->post('id', true);

        $myinput['fullname'] = $this->input->post('fullname', true);
        $myinput['weixinname'] = $this->input->post('weixinname', true);
        $myinput['weixinid'] = $this->input->post('weixinid', true);
        $myinput['mobile'] = $this->input->post('mobile', true);
        $myinput['address'] = $this->input->post('address', true);
        $myinput['payaccount'] = $this->input->post('payaccount', true);
        $myinput['personal'] = $this->input->post('personal', true);
        $myinput['family'] = $this->input->post('family', true);
        $myinput['career'] = $this->input->post('career', true);
        $myinput['tradeinfo'] = $this->input->post('tradeinfo', true);
        $myinput['channel'] = $this->input->post('channel', true);
        $myinput['content'] = $this->input->post('content', true);
      
        $myinput['adminid']=$login['id'];
       
        $this->db->where('id',$id);
        $this->db->update(PREFIX . 'customer', $myinput);
        $cid=$this->db->insert_ID();
        
        header('location:' . site_url('home/customer_list'));
    }


    /* 删除客户 */
    public function customer_del(){
        global $login;
        $data['login']=$login;
        $id=$this->uri->segment(3);
        $backurl = $_SERVER["HTTP_REFERER"];

        $this->db->query('delete from '.PREFIX.'customer where id='.$id);
        header('location:'.$backurl);
    }




 /* 微信注册列表 */
      public function user_list()
    {
        global $login;
        $data=$this->home_model->user_list();
        $data['login']=$login;
        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/user_list',$data);

    }

     /* 代理商列表 */
      public function agent_list()
    {
        global $login;
        $data=$this->home_model->agent_list();
        $data['login']=$login;
        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/agent_list',$data);

    }

       /* 管理员列表 */
      public function admin_list()
    {
        global $login;
        $data=$this->home_model->admin_list();
        $data['login']=$login;
        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/admin_list',$data);

    }


        /* 代理商列表 */
      public function resetuserpass()
    {
        global $login;

        $id=$this->uri->segment(3,0);
        $userobj=$this->db->from(PREFIX.'user')->where('id',$id)->get()->result_array();
        if(count($userobj)<1)
        {
            exit('该用户不存在');
        }else
        {
            $user=$userobj[0];
        }

        $data['user']=$user;
        $data['login']=$login;
        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/user_resetpass',$data);

    }


/* 重置用户密码 */
     public function user_resetpass_save()
    {
        global $login;

        $id=$this->input->post('id',true);
        $password=$this->input->post('password',true);

        //$id=$this->uri->segment(3,0);
        $userobj=$this->db->from(PREFIX.'user')->where('id',$id)->get()->result_array();
        if(count($userobj)<1)
        {
            exit('该用户不存在');
        }else
        {
            $user=$userobj[0];
            $newpass=md5($password.$user['salt']);
            $this->db->where('id',$id);
            $this->db->set('password',$newpass);
            $this->db->update(PREFIX.'user');

        }

        if($user['roleid']=='5')
        {
             header('location:' . site_url('home/admin_list'));
        }

         if($user['roleid']=='3')
        {
             header('location:' . site_url('home/agent_list'));
        }
        
    

    }


 public function user_set_admin()
    {
        global $login;
        if($login['adminrole']=='-100-')
        {
            $id=$this->uri->segment(3,0);
             $this->db->where('id',$id);
             $this->db->set('roleid',5);
             $this->db->set('adminrole','-1-');
             $this->db->update(PREFIX.'user');
             header('location:' . site_url('home/user_list'));
        }else
        {
            exit('你没有权限');
        }
         
    }


 public function user_set_agent()
    {
        global $login;
        if($login['roleid']=='5')
        {
            $id=$this->uri->segment(3,0);
             $this->db->where('id',$id);
             $this->db->set('roleid',3);
             $this->db->set('fee',30);
             $this->db->update(PREFIX.'user');
             header('location:' . site_url('home/agent_list'));
        }else
        {
            exit('你没有权限');
        }
         
    }
/* 设置代理商返点 */
public function agent_fee_save(){
     global $login;
     $userid=$this->input->post('userid',true);
     $fee=$this->input->post('fee',true);
     $this->db->where('id',$userid);
     $this->db->set('fee',$fee);
     $this->db->update(PREFIX.'user');
     echo 'OK';
}



        /* 代理商列表 */
      public function set_my_pass()
    {
        global $login;
 
        $data['login']=$login;
        $data['nav']=$this->load->view('home/nav',$data,true);
        $this->load->view('home/user_setmypass',$data);

    }


         public function user_setmypass_save()
    {
        global $login;

        $id=$login['id'];
        $password=$this->input->post('password',true);
        if(strlen($password)<5 || strlen($password)>10)
        {
            exit('密码不能小于5位，大于20位');
        }
        //$id=$this->uri->segment(3,0);
        $userobj=$this->db->from(PREFIX.'user')->where('id',$id)->get()->result_array();
        if(count($userobj)<1)
        {
            exit('该用户不存在');
        }else
        {
            $user=$userobj[0];
            $newpass=md5($password.$user['salt']);
            $this->db->where('id',$id);
            $this->db->set('password',$newpass);
            $this->db->update(PREFIX.'user');

        }

        
             header('location:' . site_url('home/'));
        
        
    

    }


///
}