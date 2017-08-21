<?php
class Home_model extends CI_Model 
{
    static $set=[];
    function __construct()
    {
        parent::__construct();
    }
    /*
    		查询数据库某一字段单个值
    		$idvalue, ID的值 如 3
    		$idname, ID的字段名 如id
    		$tagetname,查询的字段名 如 username
    		$tablename 表名 如user
    */
    public function getC($idvalue, $idname, $tagetname, $tablename)
    {
        if (is_numeric($idvalue)) {
            $sql = "select " . $tagetname . " as t from " . $tablename . " where " . $idname . " = " . $idvalue;
        } else {
            $sql = "select " . $tagetname . " as t  from " . $tablename . " where " . $idname . " = '" . $idvalue . "'";
        }
        $query = $this->db->query($sql);
        $arr = $query->result_array();
        if (count($arr) > 0) {
            return $arr[0]['t'];
        } else {
            return '';
        }
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
    /*
    		咨询列表页，带分页格式 和搜索 功能
    		URI字段说明 /zixunlist/1/香奈儿
    		1 是分页页数，香奈儿是关键词
    */
    function zixun_list()
    {
        //引入登录信息
        global $login;
        //'select a.id,a.brandname,b.fullname,b.city from uz_consult a,uz_user b where a.userid=b.id';
        //根据角色筛选不同的数据
        $role_where = '';
        switch ($login['roleid']) {
            case '5':
                $role_where = ' ';
                $role_where_nojoin = ' ';
                break;
            case '3':
                $role_where = ' and (a.userid=' . $login['id'] . ' or a.agentid=' . $login['id'] . ') ';
                $role_where_nojoin = ' and (userid=' . $login['id'] . ' or agentid=' . $login['id'] . ') ';
                break;
            case '0':
                $role_where = ' and (a.userid=' . $login['id'] . ') ';
                $role_where_nojoin = ' and (userid=' . $login['id'] . ') ';
                break;
            default:
                # code...
                $role_where = ' and (a.userid=' . $login['id'] . ') ';
                $role_where_nojoin = ' and (userid=' . $login['id'] . ') ';
                break;
        }
        /////////
        $order_by = ' order by datetime desc';
        $config['base_url'] = site_url('home/zixunlist');
        // 计算总页数
        $wd = $this->uri->segment(4, '0');
        if ($wd != '0') {
            $wd = urldecode($wd);
            $config['suffix'] = '/' . $wd;
            $config['first_url'] = site_url('home/zixunlist') . '/1/' . $wd;
            if (is_numeric($wd)) {
                $sql = 'select id from ' . PREFIX . 'consult  where id=' . $wd . $role_where_nojoin;
            } else {
                $sql = "select a.id from " . PREFIX . "consult a," . PREFIX . "user b where a.userid=b.id " . $role_where . " and (a.brandname like '%" . $wd . "%' or b.fullname like '%" . $wd . "%')";
            }
        } else {
            $sql = 'select id from ' . PREFIX . 'consult where id>0 ' . $role_where_nojoin;
        }
        $query = $this->db->query($sql);
        $total_rows = count($query->result());
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = ' </ul>';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 3;
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = '首页';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '尾页';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $pagelink = $this->pagination->create_links();
        $this->db->order_by("id", "desc");
        $intpage = $this->get_page(3);
        $limitstr = ' limit ' . ($intpage - 1) * $config['per_page'] . ',' . $config['per_page'];
        if ($wd != '0') {
            //$this->db->like('brandname', $wd);
            if (is_numeric($wd)) {
                $sql = "select a.id,a.userid,a.agentid,a.consulttype,a.brandname,a.datetime,a.facepic,b.roleid,b.fullname,b.city from " . PREFIX . "consult a," . PREFIX . "user b where a.userid=b.id " . $role_where . "  and a.id=" . $wd . " " . $order_by . $limitstr;
            } else {
                $sql = "select a.id,a.userid,a.agentid,a.consulttype,a.brandname,a.datetime,a.facepic,b.roleid,b.fullname,b.city from " . PREFIX . "consult a," . PREFIX . "user b where a.userid=b.id " . $role_where . "  and (a.brandname like '%" . $wd . "%' or b.fullname like '%" . $wd . "%') " . $order_by . $limitstr;
            }
        } else {
            $sql = "select a.id,a.userid,a.agentid,a.consulttype,a.brandname,a.datetime,a.facepic,b.roleid,b.fullname,b.city from " . PREFIX . "consult a," . PREFIX . "user b where a.userid=b.id " . $role_where . $order_by . $limitstr;
        }
        $query = $this->db->query($sql);
        //$query = $this->db->get(PREFIX.'consult', $config['per_page'],($intpage-1)*$config['per_page']);
        $rs = $query->result();

        //检查是否有新回复
        foreach ($rs as $key => $value) {
           $rs[$key]->havenew=$this->have_new_notice($value->id);
        }
        

        if ($wd != '0') {
            $data = array('zixunlist' => $rs, 'pagelink' => $pagelink, 'wd' => $wd, 'count' => $total_rows);
        } else {
            $data = array('zixunlist' => $rs, 'pagelink' => $pagelink, 'wd' => '', 'count' => $total_rows);
        }
        return $data;
    }

 public function x(){
     echo "asdfadfa";
 }
 


    /*
        获取当前页数 分页函数用
    */
    function get_page($num) {
        $intpage = $this->uri->segment($num);
        if (isset($intpage)) {
            $intpage = intval($intpage);
            if ($intpage < 1) {
                $intpage = 1;
            }
        } else {
            $intpage = 1;
        }
        return $intpage;
    }
    /*
    	检查是否有权限
    */
    function check_role($userid, $agentid)
    {
        global $login;
        if ($login['roleid'] == 5) {
            return true;
        } else {
            if ($login['id'] == $userid || $login['id'] == $agentid) {
                return true;
            } else {
                exit('你没有权限查看此内容');
            }
        }
    }


    function get_zixun_log($id){
        $this->db->where('cid',$id);
        $this->db->order_by('datetime','desc');
        $log=$this->db->get(PREFIX.'consult_log')->result_array();
        foreach ($log as $key => $value) {
            $log[$key]['username']=$this->get_user_name($value['fromuser']);
            # code...
        }
        return $log;
        //$data['log']=$log;
    }

    //获取用户名
    function get_user_name($userid){
        if($userid==0){
            return '管理员';
        }else
        {
            //$this->db->where('id',$userid);
            $username=$this->getC($userid, 'id', 'fullname', PREFIX.'user');
            //获取用户名
            if($username!='')
            {
                return $username;
            }else
            {
                return '未知用户';
            }
        
        }
    
       
    }

    
    function create_job($cid,$jobid,$touser,$sendsms=true){
        global $login;
        $rs=$this->db->query('select * from '.PREFIX.'consult_job where cid='.$cid.' and job='.$jobid.' and touser='.$touser.' and ck=0')->result_array();
        if(count($rs)>0)
        {
             //如果任务存在 就不写入
        }else{
            $this->db->set('cid', $cid);
            $this->db->set('job', $jobid);
            $this->db->set('touser', $touser);
            $this->db->set('datetime', time());
            $this->db->insert(PREFIX.'consult_job');

          

        }
        

        if($sendsms==true)
        {
                   /// 发送短信部分 ///
            if($touser>0)
            {
                $objuser=$this->db->from(PREFIX.'user')->where('id', $touser)->get()->result_array();
                $user=$objuser[0];
                $codeid=$this->sms_model->create_notice_sms($user['mobile'],$cid);
            }
            else
            {
                //给管理员发短信
                $codeid=$this->sms_model->create_notice_sms(ADMINMOBILE,$cid);
            }
            $this->sms_model->send($codeid);
        }




    }

    //创建日志
    function create_log($cid,$logtype,$fromuser,$touser,$content,$adminid='0'){
        global $login;
        $this->db->set('cid',$cid);
        $this->db->set('logtype',$logtype);
        $this->db->set('fromuser',$fromuser);
        $this->db->set('touser',$touser);
        $this->db->set('content',substr($content,0,300));
        $this->db->set('datetime',time());
        $this->db->insert(PREFIX.'consult_log');

        /// 发送短信部分 ///
        if($touser>0)
        {
            $objuser=$this->db->from(PREFIX.'user')->where('id', $touser)->get()->result_array();
            $user=$objuser[0];
            $codeid=$this->sms_model->create_notice_sms($user['mobile'],$cid);
        }
        else
        {
            //给管理员发短信
            $codeid=$this->sms_model->create_notice_sms(ADMINMOBILE,$cid);
        }
        
        $this->sms_model->send($codeid);

    }


    //修改订单状态
     function change_status($cid,$consult_status){
        global $login;
        $this->db->where('id',$cid);
        $this->db->set('consult_status',$consult_status);
       // $this->db->set('adminid',$adminid);
        $this->db->update(PREFIX.'consult');
    }


    function have_new_notice($cid)
    {
         global $login;
         $touser=$login['id'];
         if($login['roleid']==5)
         {
            $touser=0;
         }

         $this->db->where('cid',$cid);
         $this->db->where('touser',$touser);
         $this->db->where('ck','0');
         $arr=$this->db->get(PREFIX.'consult_log')->result_array();
         if(count($arr)>0)
        {
            return true;
        }else
        {
            return false;
        }

    }



      /*
        证书列表
    */
     function cert_list()
    {
        //引入登录信息
        global $login;
    
        /////////
        $order_by = ' order by datetime desc';
        $config['base_url'] = site_url('home/cert_list');
        // 计算总页数
        $wd = $this->uri->segment(4, '0');
        if ($wd != '0') {
            $wd = urldecode($wd);
            $config['suffix'] = '/' . $wd;
            $config['first_url'] = site_url('home/cert_list') . '/1/' . $wd;
         
             $sql = "select id from " . PREFIX . "cert  where (pid='".$wd."' or code='".$wd."' or brandname like '%" . $wd . "%'  ) ";
               
        } else {
            $sql = 'select id from ' . PREFIX . 'cert where id>0 ';
        }


        $query = $this->db->query($sql);
        $total_rows = count($query->result());
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = ' </ul>';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 3;
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = '首页';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '尾页';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $pagelink = $this->pagination->create_links();
        $this->db->order_by("id", "desc");
        $intpage = $this->get_page(3);
        $limitstr = ' limit ' . ($intpage - 1) * $config['per_page'] . ',' . $config['per_page'];

        if ($wd != '0') {
            
            $sql = "select * from " . PREFIX . "cert  where id>0  and (pid='".$wd."' or code='".$wd."' or brandname like '%" . $wd . "%'  ) ".$order_by.$limitstr;
          
        } else {
             $sql = "select * from " . PREFIX . "cert  where id>0 ".$order_by.$limitstr;
         
        }


        $query = $this->db->query($sql);
        //$query = $this->db->get(PREFIX.'consult', $config['per_page'],($intpage-1)*$config['per_page']);
        $rs = $query->result();
        if ($wd != '0') {
            $data = array('certlist' => $rs, 'pagelink' => $pagelink, 'wd' => $wd, 'count' => $total_rows);
        } else {
            $data = array('certlist' => $rs, 'pagelink' => $pagelink, 'wd' => '', 'count' => $total_rows);
        }
        return $data;
    }



     /*
        协议列表
    */
     function agree_list(){
        //引入登录信息
        global $login;
        /////////
        $order_by = ' order by datetime desc';
        $config['base_url'] = site_url('home/agree_list');
        // 计算总页数
        $wd = $this->uri->segment(4, '0');
        if ($wd != '0') {
            $wd = urldecode($wd);
            $config['suffix'] = '/' . $wd;
            $config['first_url'] = site_url('home/agree_list') . '/1/' . $wd;
            $sql = 'select id from ' . PREFIX . 'agree where id>0 '; 
        } else {
            $sql = 'select id from ' . PREFIX . 'agree where id>0 ';
        }

        
        $query = $this->db->query($sql);
        
        if(isset($_GET['pid']) || isset($_GET['mobile'])  ){
            $total_rows=$this->agree_list_search(true);
        } else {
            $total_rows = count($query->result());
        }
        
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = ' </ul>';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 3;
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = '首页';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '尾页';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $pagelink = $this->pagination->create_links();
        $this->db->order_by("id", "desc");
        $intpage = $this->get_page(3);
        $limitstr = ' limit ' . ($intpage - 1) * $config['per_page'] . ',' . $config['per_page'];
        
        if ($wd != '0') {
            
            $sql = "select * from " . PREFIX . "agree  where id>0 ".$order_by.$limitstr;
        } else {
             $sql = "select * from " . PREFIX . "agree  where id>0 ".$order_by.$limitstr;
         
        }

        
         if(isset($_GET['pid']) || isset($_GET['mobile'])  ){
                    $rs=$this->agree_list_search($limitstr);
                    $data = array('agreelist' => $rs, 'pagelink' => $pagelink, 'wd' => $wd, 'count' => $total_rows);
         }else{
                $query = $this->db->query($sql);
        //$query = $this->db->get(PREFIX.'consult', $config['per_page'],($intpage-1)*$config['per_page']);
                $rs = $query->result();
            if ($wd != '0') {
                $data = array('agreelist' => $rs, 'pagelink' => $pagelink, 'wd' => $wd, 'count' => $total_rows);
            } else {
                $data = array('agreelist' => $rs, 'pagelink' => $pagelink, 'wd' => '', 'count' => $total_rows);
            }
        }
        return $data;
    }
    
    public function  agree_list_search($limitstr ){
        $search=[];
        if( $this->input->get("pid",1) ){
            $search['m.pid'] =$this->input->get("pid",1);
        }
        if( $this->input->get("mobile",1) ){
            $search['e.mobile'] =$this->input->get("mobile",1);
        }
        if(empty($search)){
            return ;
        }
        if($limitstr === True){
            return
                $this->db
                    ->select("e.id")
                    ->from(PREFIX."agree as e")
                    ->join(PREFIX."agree_item as m" ,"e.id=m.aid" ,"inner" )
                    ->where($search)
                    ->get()
                    ->num_rows();
        }else{
            return
                $this->db
                    ->select("e.*,m.pid")
                    ->from(PREFIX."agree as e")
                    ->join(PREFIX."agree_item as m" ,"e.id=m.aid" ,"inner" )
                    ->where($search)
                    ->order_by("e.datetime desc")
                    ->limit($limitstr)
                    ->get()
                    ->result();
        }
        
        
    }



    /*
        协议列表
    */
     function care_list()
    {
        //引入登录信息
        global $login;
 
   /////////
        $order_by = 'order by datetime desc';
       

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
        $paymentsql='';
        $ispaybacksql='';




        $title = $this->input->get('title', true);
        $pid = $this->input->get('pid', true);
        $code = $this->input->get('code', true);

        $orderfrom = $this->input->get('orderfrom', true);
        $mobile = $this->input->get('mobile', true);
        $username = $this->input->get('username', true);
        $status = $this->input->get('status', true);
        $agentid = $this->input->get('agentid', true);
    
        $payment = $this->input->get('payment', true);

        $getway = $this->input->get('getway', true);
        $sentway = $this->input->get('sentway', true);
        
        $urgent = $this->input->get('urgent', true);

        $startday = $this->input->get('startday', true);
        $endday= $this->input->get('endday', true);
        
        $ispayback = $this->input->get('ispayback', true);

        $searchstr='';

        $search=array('title'=>$title,'pid'=>$pid,'code'=>$code,'orderfrom'=>$orderfrom,'mobile'=>$mobile,'username'=>$username,'status'=>$status, 'agentid'=>$agentid,'getway'=>$getway,'sentway'=>$sentway,'urgent'=>$urgent,'endday'=>$endday,'startday'=>$startday,'payment'=>$payment,'ispayback'=>$ispayback);
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
         if($payment){ $paymentsql=" and  payment= ".$payment." " ;}
        
        if($urgent){ $urgentsql=" and  urgent= '".$urgent."' " ;}

//        if($ispayback){ $ispaybacksql=" and ispayback= ".$ispayback." " ;}
       if(is_numeric($ispayback)){ $ispaybacksql=" and ispayback= ".$ispayback." " ;}

        if($startday){
            $starttime=strtotime($startday);
            $startdaysql=" and  datetime >=".$starttime." ";
        }

        if($endday){
            $endtime=strtotime($endday);
            $enddaysql=" and  datetime <=".$endtime." ";
        }

        $sqlstr=$titlesql.$pidsql.$codesql.$orderfromsql.$mobilesql.$usernamesql.$statussql.$agentidsql.$paymentsql.$ispaybacksql.$getwaysql.$sentwaysql.$urgentsql.$startdaysql.$enddaysql;

        // 计算总页数
        $wd = $this->uri->segment(4, '0');
        
        $sql = 'select id from ' . PREFIX . 'care where siteid='.SITEID.' '.$sqlstr;
         
        
        $query = $this->db->query($sql);
        $total_rows = count($query->result());
        $config['base_url'] = site_url('home/care_list');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = ' </ul>';
      

        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = FALSE;
        $config['reuse_query_string'] = TRUE;

        $config['num_links'] = 3;
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = '首页';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '尾页';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $pagelink = $this->pagination->create_links();
        $this->db->order_by("id", "desc");
        $intpage = $this->get_page(3);
        $limitstr = ' limit ' . ($intpage - 1) * $config['per_page'] . ',' . $config['per_page'];

        
        $sql = "select * from " . PREFIX . "care  where siteid=".SITEID." ".$sqlstr.$order_by.$limitstr;
          

        $query = $this->db->query($sql);
        //$query = $this->db->get(PREFIX.'consult', $config['per_page'],($intpage-1)*$config['per_page']);
        $rs = $query->result();

        foreach ($rs as $key => $value) {
           $rs[$key]->statusname=$this->get_care_status($value->status);
        }
        

        foreach ($rs as $key => $value) {
            $rs[$key]->payment=$this->getC($value->payment, 'id', 'name', PREFIX.'sale_payment');
        }


        
        $data = array('carelist' => $rs, 'pagelink' => $pagelink, 'search' => $search,'searchstr'=>$searchstr,  'count' => $total_rows);
        
        return $data;
    }

    public function get_care_status($code)
    {
        
           
            $statusname=$this->getC($code, 'id', 'name', PREFIX.'care_code');
            //获取用户名
            if($statusname!='')
            {
                return $statusname;
            }else
            {
                return '未知';
            }
        
        
    
    }

/*
 * 
 */
#return str false
    static private function str_sort(CI_Model $object){  #排序
        $order=[1=>"desc","asc"];
        $str="order by  ";
        if(array_key_exists((int) $object->input->get("datetime_sort"),$order ) ){
            $str .="  storedate ".$order[(int) $object->input->get("datetime_sort")];
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

    /*
        产品列表
    */

    function product_list(){
        //引入登录信息
        global $login;
         self::str_sort($this) ? $order_by=self::str_sort($this) : $order_by = 'order by id desc';
//        exit($order_by);
        $titlesql='';
        $pidsql='';
        $saletypesql='';
        $categorysql='';
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
        $title=trim($title);
        $pid = $this->input->get('pid', true);
        $saletype = $this->input->get('saletype', true);

        $category = $this->input->get('category', true);

        $size = $this->input->get('size', true);
        $storeid = $this->input->get('storeid', true);
        $status = $this->input->get('status', true);
        $cityid = $this->input->get('cityid', true);
        $agentid = $this->input->get('agentid', true);
        $receiver = $this->input->get('receiver', true);
        $payment = $this->input->get('payment', true);

        $owner = $this->input->get('owner', true);
        
        $havephoto = $this->input->get('havephoto', true);

        $startday = $this->input->get('startday', true);
      
        $endday= $this->input->get('endday', true);
        

        $searchstr='';
        $search=array('title'=>$title,'pid'=>$pid,'category'=>$category,'saletype'=>$saletype,'size'=>$size,'storeid'=>$storeid,'status'=>$status,
            'cityid'=>$cityid,'agentid'=>$agentid,'receiver'=>$receiver,'payment'=>$payment,'owner'=>$owner,'startday'=>$startday,
            'endday'=>$endday,'havephoto'=>$havephoto,
            "datetime_sort"=>(int) $this->input->get("datetime_sort"),
            "costprice_sort"=>(int) $this->input->get("costprice_sort"),
            "video"=>$this->input->get("video")
                );
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
        
        if($startday){
            $starttime=strtotime($startday);
            $startdaysql=" and  storedate >=".$starttime." ";
        }

        if($endday){
            $endtime=strtotime($endday);
            $enddaysql=" and  storedate <=".$endtime." ";
        }
        if($this->input->get("video") == 1){
            $video =" and video !=''  ";
        }elseif($this->input->get("video") == 2 ){
            $video ="and video =''  ";
        }else{
            $video ="";
        }


        $sqlstr=$titlesql.$pidsql.$categorysql.$saletypesql.$sizesql.$storeidsql.$statussql.$cityidsql
                .$agentidsql.$receiversql.$paymentsql.$ownersql.$storedatesql.
                $havephotosql.$startdaysql.$enddaysql;
        $sqlstr .=$video;

        // 计算总页数
        $wd = $this->uri->segment(4, '0');
        

       if(SITEID === 0 and ! (isset($_GET["admin"]) and $_GET['admin'] == "false")){
           if($sqlstr){

               $sql = 'select id from ' . PREFIX . 'product where  1'. $sqlstr;
           }else{
               $sql = 'select id from ' . PREFIX . 'product';
           }
       } else {
           $sql = 'select id from ' . PREFIX . 'product where siteid='.SITEID.' '.$sqlstr;
       }


        $query = $this->db->query($sql);
        $total_rows = count($query->result());

        $config['base_url'] = site_url('home/product_list');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 20;
        $config['query_string_segment'] = 'per_page';
        $config['attributes'] = array('class' => 'tclass');
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = ' </ul>';
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = FALSE;
        $config['reuse_query_string'] = TRUE;
        $config['num_links'] = 3;
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = '首页';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '尾页';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $pagelink = $this->pagination->create_links();
        
        $this->db->order_by("id", "desc");
        $intpage = $this->get_page(3);
        $limitstr = ' limit ' . ($intpage - 1) * $config['per_page'] . ',' . $config['per_page'];

//        $sql = "select * from " . PREFIX . "product  where siteid=".SITEID." ".$sqlstr.$order_by.$limitstr;
        if(SITEID === 0  and ! (isset($_GET["admin"]) and $_GET['admin'] == "false")){
           if($sqlstr){
               $sql = "select * from " . PREFIX . "product  where  1 ".$sqlstr.$order_by.$limitstr;
           }else{
               $sql = "select * from " . PREFIX . "product   ".$order_by.$limitstr;
           }
       } else {
          $sql = "select * from " . PREFIX . "product  where siteid=".SITEID." ".$sqlstr.$order_by.$limitstr;
       }

        $query = $this->db->query($sql);
        
        //$query = $this->db->get(PREFIX.'consult', $config['per_page'],($intpage-1)*$config['per_page']);
        $rs = $query->result();

        foreach ($rs as $key => $value) {
            $rs[$key]->storename=$this->getC($value->storeid, 'id', 'name', PREFIX.'store');
            # code...
        }
        foreach ($rs as $key => $value) {
            $rs[$key]->city=$this->getC($value->cityid, 'id', 'name', PREFIX.'city');
            # code...
        }

         foreach ($rs as $key => $value) {
            $rs[$key]->statusname=$this->getC($value->status, 'id', 'name', PREFIX.'product_status');
            # code...
        }

        foreach ($rs as $key => $value) {
            $rs[$key]->payment=$this->getC($value->payment, 'id', 'name', PREFIX.'sale_payment');
        }
 
 
            $data = array('productlist' => $rs, 'pagelink' => $pagelink, 'search' => $search,'searchstr'=>$searchstr, 'count' => $total_rows);
        return $data;
    }


 


  /*
        产品列表
    */
     function sale_list(){
        //引入登录信息
        global $login;
    
        /////////
        $order_by = 'order by ID desc';
       
        // 计算总页数
        //$wd = $this->uri->segment(4, '0');
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
        $agentidsql='';
        $paymentsql='';
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
        $agentid = $this->input->get('agentid', true);
        $payment = $this->input->get('payment', true);
        $ispayback = $this->input->get('ispayback', true);
        $admin=$this->input->get("admin",TRUE);
        $searchstr='';
        $search=array('title'=>$title,
            'pid'=>$pid,'agentid'=>$agentid,"admin"=>$admin,
            'saletype'=>$saletype,'cid'=>$cid,'saleman'=>$saleman,'receiver'=>$receiver,'payment'=>$payment,'saleplatform'=>$saleplatform,'startday'=>$startday,'endday'=>$endday,'checktime'=>$checktime,'ispayback'=>$ispayback);
        foreach ($search as $key => $value) {
            $searchstr=$searchstr.'&'.$key.'='.$value;
        }
         

        if($title){ $titlesql=" and  title like '%".$title."%' ";}
        if($pid){ $pidsql=" and  pid  like '%".$pid."%' " ;}
//        if($agentid){ $agentidsql=" and  agentid = '".$agentid."' " ;}
        if($agentid){ $agentidsql=" and  siteid = '".$agentid."' " ;}

        if($saletype){ $saletypesql=" and  saletype= ".$saletype." " ;}
        if($payment){ $paymentsql=" and  payment= ".$payment." " ;}
        if($saleman){ $salemansql=" and  saleman = '".$saleman."' " ;}
        if($receiver){ $receiversql=" and  receiver = '".$receiver."' " ;}
//        if($ispayback){ $ispaybacksql=" and  ispayback = ".$ispayback." " ;}
        if(is_numeric($ispayback)){ $ispaybacksql=" and ispayback= ".$ispayback." " ;}
        if($saleplatform){ $saleplatformsql=" and  saleplatform = '".$saleplatform."' " ;}
   
        if($startday and strtotime($startday)){
            $starttime=strtotime($startday);
            $startdaysql=" and  saletime >=".$starttime." ";
        }

        if($endday and strtotime($endday)){
            $endtime=strtotime($endday);
            $enddaysql=" and  saletime <=".$endtime." ";
        }

        if($checktime=='today'){
            $time1='';
            $time2='';
            $tt='';
            $oldtime=strtotime("-10 day",time());
            $time1=date('Y-m-d',''.$oldtime);
           
            $time1=strtotime($time1);
            //$time2=strtotime("+1 days",$time1);
            $checktimesql="and ( saletime <".$time1." and ispayback=0 and lcase(pid) like '%b%')";
        }

        
        

        $sqlstr=$titlesql.$pidsql.$agentidsql.$saletypesql.$salemansql.$receiversql.$cidsql.$saleplatformsql.$paymentsql.$startdaysql.$enddaysql.$checktimesql.$ispaybacksql;
        $orderstr=' order by id desc';
        
        
        if($admin == "false"){
            $sql = "select id from " . PREFIX . "sale  where siteid=".SITEID."  ".$sqlstr;
        } else {
            $sql = "select id from " . PREFIX . "sale  where  agentid=1  ".$sqlstr;
        }
     
        
        if(isset($_GET['owner']) and ! empty($_GET['owner']) ){
            return $this->search_($search);
        }else{
            $query = $this->db->query($sql);
            $total_rows = count($query->result());
        }

        $config['base_url'] = site_url('home/sale_list');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = ' </ul>';
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = FALSE;
        $config['reuse_query_string'] = TRUE;

        $config['num_links'] = 3;
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = '首页';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '尾页';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $pagelink = $this->pagination->create_links();
        $this->db->order_by("id", "desc");
        $intpage = $this->get_page(3);
        $limitstr = ' limit ' . ($intpage - 1) * $config['per_page'] . ',' . $config['per_page'];

        if(SITEID === 0 and  $admin == "true"){
             $sql = "select * from " . PREFIX . "sale  where  agentid=1  ".$sqlstr.$orderstr.$limitstr;
        }else{
             $sql = "select * from " . PREFIX . "sale  where siteid=".SITEID." ".$sqlstr.$orderstr.$limitstr;
        }
         
        $query = $this->db->query($sql);
        //$query = $this->db->get(PREFIX.'consult', $config['per_page'],($intpage-1)*$config['per_page']);
        $rs = $query->result();


        foreach ($rs as $key => $value) {
            $rs[$key]->platformname=$this->getC($value->saleplatform, 'id', 'name', PREFIX.'sale_platform');
        }

        foreach ($rs as $key => $value) {
            $rs[$key]->payment=$this->getC($value->payment, 'id', 'name', PREFIX.'sale_payment');
        }

        


         foreach ($rs as $key => $value) {
            $rs[$key]->saletype=$this->getC($value->saletype, 'id', 'name', PREFIX.'product_status');
        }

        $data = array('salelist' => $rs, 'pagelink' => $pagelink, 'search' => $search, 'searchstr'=>$searchstr,'count' => $total_rows);
        return $data;
    }
    static function get($varname,&$get=false,$key=false){
//        if(isset($_GET[$varname]) && ! empty($_GET[$varname]) ) {
        if(isset($_GET[$varname]) && $_GET[$varname] !== "" ) {
            is_array($_GET[$varname]) and exit("不允许 array 类型");
            if($get !== false){
                $get= addslashes( strip_tags($_GET[$varname]));
            }
            return addslashes( strip_tags($_GET[$varname]));
        }else{
            if($key !== FALSE){
                unset(self::$set[$key]);
            }
            return FALSE;
        }
    }
    
    private function search_($search){
    
        $where=[];
        self::$set=&$where;
        self::get("title") && $where['s.title like'] = "%". self::get("title") ."%";
        self::get("pid") && $where['s.pid like'] = "%". self::get("pid") ."%";
        
        self::get("receiver",$where['s.receiver'],"s.receiver");
        self::get("saleman",$where['s.saleman'],"s.saleman");
        self::get("cid",$where['s.cid'],"s.cid" );
        self::get("saletype",$where['s.saletype'] ,"s.saletype");
        self::get("saleplatform",$where['s.saleplatform'],"s.saleplatform");
        self::get("agentid",$where['s.agentid'],"s.agentid");
        self::get("payment",$where['s.payment'],"s.payment");
        self::get("ispayback",$where['s.ispayback'],"s.ispayback");
        if(isset($_GET['startday']) and strtotime($_GET['startday'])){
             $where["s.datetime > "] =strtotime($_GET['startday']);
        }
        if(isset($_GET['endday']) and strtotime($_GET['endday'])){
             $where["s.datetime < "] =strtotime($_GET['enddate']);
        }
        
        self::get("owner",$where['p.owner'],"p.owner" );

            $total_rows=$this->db->from("uz_sale s")
                ->select("count(*) as count")
                ->join("uz_product p","s.pid=p.pid")
                ->where($where)
                ->get()
                ->result_array();
            if(is_array($total_rows)){
                $total_rows =$total_rows[0]["count"];
            }else{
                $total_rows=0;
            }

        $config['base_url'] = site_url('home/sale_list');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = ' </ul>';
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = FALSE;
        $config['reuse_query_string'] = TRUE;
        $config['num_links'] = 3;
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = '首页';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '尾页';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $pagelink = $this->pagination->create_links();
        
        
        $rs=$this->db->from("uz_sale s")
                ->select("s.*")
                ->join("uz_product p","s.pid=p.pid")
                ->where($where)
                ->order_by("s.id")
                ->limit(20, $this->uri->segment(3) > 1 ? ($this->uri->segment(3)-1) * 20:0 )
                ->get()
                ->result_object();

        
        
         return ['salelist' => $rs, 'pagelink' => $pagelink, 'search' =>  $search, 'searchstr'=> http_build_query($_GET),'count' => $total_rows] ;
    }



    /*
        产品列表
    */
     function customer_list()
    {
        //引入登录信息
        global $login;
    
        /////////
        $order_by = 'order by datetime desc';
        


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

        // 计算总页数
        $wd = $this->uri->segment(4, '0');
        
        $sql = 'select id from ' . PREFIX . 'customer where id>0 '.$sqlstr;
         

        $query = $this->db->query($sql);
        $total_rows = count($query->result());
        $config['base_url'] = site_url('home/customer_list');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = ' </ul>';
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE;
         $config['reuse_query_string'] = TRUE;
        $config['num_links'] = 3;
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = '首页';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '尾页';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $pagelink = $this->pagination->create_links();
        $this->db->order_by("id", "desc");
        $intpage = $this->get_page(3);
        $limitstr = ' limit ' . ($intpage - 1) * $config['per_page'] . ',' . $config['per_page'];

        $sql = "select * from " . PREFIX . "customer  where id>0 ".$sqlstr.$order_by.$limitstr;

        $query = $this->db->query($sql);
        //$query = $this->db->get(PREFIX.'consult', $config['per_page'],($intpage-1)*$config['per_page']);
        $rs = $query->result();

       
        /*

        foreach ($rs as $key => $value) {
            $rs[$key]->city=$this->getC($value->cityid, 'id', 'name', PREFIX.'city');
            # code...
        }

        */
        
        $data = array('customerlist' => $rs, 'pagelink' => $pagelink, 'search' => $search,'searchstr'=>$searchstr, 'count' => $total_rows); 
        return $data;
    }



 /*
        产品列表
    */
     function user_list()
    {
        //引入登录信息
        global $login;
    
        /////////
        $order_by = 'order by regtime desc';
        $config['base_url'] = site_url('home/user_list');


        $fullnamesql='';
        
        $mobilesql='';
         

        $fullname = $this->input->get('fullname', true);
        
        $mobile = $this->input->get('mobile', true);
         
        $searchstr='';
        $search=array('fullname'=>$fullname,'mobile'=>$mobile);
        foreach ($search as $key => $value) {
            $searchstr=$searchstr.'&'.$key.'='.$value;
        }
         

        if($fullname){ $fullnamesql=" and  fullname like '%".$fullname."%' ";}
       
        if($mobile){ $mobilesql=" and  mobile= '".$mobile."' " ;}

        $sqlstr=$fullnamesql.$mobilesql;

        // 计算总页数
        $wd = $this->uri->segment(4, '0');
        
        $sql = 'select id from ' . PREFIX . 'user where roleid=0 '.$sqlstr;
         

        $query = $this->db->query($sql);
        $total_rows = count($query->result());
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = ' </ul>';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 3;
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = '首页';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '尾页';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $pagelink = $this->pagination->create_links();
        $this->db->order_by("id", "desc");
        $intpage = $this->get_page(3);
        $limitstr = ' limit ' . ($intpage - 1) * $config['per_page'] . ',' . $config['per_page'];

        $sql = "select * from " . PREFIX . "user  where roleid=0 ".$sqlstr.$order_by.$limitstr;

        $query = $this->db->query($sql);
        $rs = $query->result();

       
        /*

        foreach ($rs as $key => $value) {
            $rs[$key]->city=$this->getC($value->cityid, 'id', 'name', PREFIX.'city');
            # code...
        }

        */
        
        $data = array('userlist' => $rs, 'pagelink' => $pagelink, 'search' => $search,'searchstr'=>$searchstr, 'count' => $total_rows); 
        return $data;
    }



 function agent_list()
    {
        //引入登录信息
        global $login;
    
        /////////
        $order_by = 'order by regtime desc';
        $config['base_url'] = site_url('home/agent_list');


        $fullnamesql='';
        
        $mobilesql='';
         

        $fullname = $this->input->get('fullname', true);
        
        $mobile = $this->input->get('mobile', true);
         
        $searchstr='';
        $search=array('fullname'=>$fullname,'mobile'=>$mobile);
        foreach ($search as $key => $value) {
            $searchstr=$searchstr.'&'.$key.'='.$value;
        }
         

        if($fullname){ $fullnamesql=" and  fullname like '%".$fullname."%' ";}
       
        if($mobile){ $mobilesql=" and  mobile= '".$mobile."' " ;}
        $roleid= $this->input->get('roleid', true);
        if($roleid){
            $x= "  and roleid= $roleid  ";
        }else{
            $x='';
        }
        $sqlstr=$fullnamesql.$mobilesql.$x;

        // 计算总页数
        $wd = $this->uri->segment(4, '0');
        
        $sql = 'select id from ' . PREFIX . 'user where roleid=3 '.$sqlstr;
         

        $query = $this->db->query($sql);
        $total_rows = count($query->result());
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = ' </ul>';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 3;
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = '首页';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '尾页';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $pagelink = $this->pagination->create_links();
        $this->db->order_by("id", "desc");
        $intpage = $this->get_page(3);
        $limitstr = ' limit ' . ($intpage - 1) * $config['per_page'] . ',' . $config['per_page'];

        $sql = "select * from " . PREFIX . "user  where roleid in (3,4,6) ".$sqlstr.$order_by.$limitstr;

        $query = $this->db->query($sql);
        $rs = $query->result();

       
        /*

        foreach ($rs as $key => $value) {
            $rs[$key]->city=$this->getC($value->cityid, 'id', 'name', PREFIX.'city');
            # code...
        }

        */
        
        $data = array('userlist' => $rs, 'pagelink' => $pagelink, 'search' => $search,'searchstr'=>$searchstr, 'count' => $total_rows); 
        return $data;
    }




 function admin_list()
    {
        //引入登录信息
        global $login;
    
        /////////
        $order_by = 'order by regtime desc';
        $config['base_url'] = site_url('home/admin_list');


        $fullnamesql='';
        
        $mobilesql='';
         

        $fullname = $this->input->get('fullname', true);
        
        $mobile = $this->input->get('mobile', true);
         
        $searchstr='';
        $search=array('fullname'=>$fullname,'mobile'=>$mobile);
        foreach ($search as $key => $value) {
            $searchstr=$searchstr.'&'.$key.'='.$value;
        }
         

        if($fullname){ $fullnamesql=" and  fullname like '%".$fullname."%' ";}
       
        if($mobile){ $mobilesql=" and  mobile= '".$mobile."' " ;}

        $sqlstr=$fullnamesql.$mobilesql;

        // 计算总页数
        $wd = $this->uri->segment(4, '0');
        
        $sql = "select id from " . PREFIX . "user where roleid=5 and adminrole<>'-100-' ".$sqlstr;
         

        $query = $this->db->query($sql);
        $total_rows = count($query->result());
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = ' </ul>';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 3;
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = '首页';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '尾页';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $pagelink = $this->pagination->create_links();
        $this->db->order_by("id", "desc");
        $intpage = $this->get_page(3);
        $limitstr = ' limit ' . ($intpage - 1) * $config['per_page'] . ',' . $config['per_page'];

        $sql = "select * from " . PREFIX . "user  where roleid=5 and adminrole<>'-100-' ".$sqlstr.$order_by.$limitstr;

        $query = $this->db->query($sql);
        $rs = $query->result();

       
        /*

        foreach ($rs as $key => $value) {
            $rs[$key]->city=$this->getC($value->cityid, 'id', 'name', PREFIX.'city');
            # code...
        }

        */
        
        $data = array('userlist' => $rs, 'pagelink' => $pagelink, 'search' => $search,'searchstr'=>$searchstr, 'count' => $total_rows); 
        return $data;
    }


    
/////////////////

}