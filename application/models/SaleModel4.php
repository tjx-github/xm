<?php
use Model\IsOrGet as IG;
class SaleModel4 extends CI_Model{
    use \Model\Trait_Img, \Model\Trait_Count;
    static $where;
    static protected $admin=1; //admin账号是否有修改权   1有
    public function insertinto($agentid){
        IG::addslashes($_POST);
        if($agentid != IG::post("agentid")   ||  ! IG::post("pid")){
            exit("错误！！非法提交");
        }
        $_POST['agentid'] = self::$admin;
        $_POST['siteid']=$agentid;
        $_POST['HistoricalRate'] =$this->GetHistoricalRate($agentid);
        
        $_POST['siteprofit']=(FLOAT)IG::POST('price')-(FLOAT)IG::POST('costprice')-(FLOAT)IG::POST('otherfee')- (FLOAT) IG::POST('platformfee')-(FLOAT)IG::POST('kuaidifee'); #算总部利润
        $_POST['agentprofit']= round($_POST['siteprofit'] * $_POST['HistoricalRate'] /  100); // 算本人利润
        $_POST['datetime'] =time(); //插入时间
        if( IG::post("saletime") and strtotime($_POST['saletime']) ){
            $_POST['saletime']= strtotime($_POST['saletime']);
        } else {
            $_POST['saletime']=""; //售出日期
        }
        if(IG::post("facephoto")){
            self::imgjson($_POST['facephoto']);
        }else{
            $_POST['facephoto'] =$_POST['productface'] ;
            
        }
        unset($_POST['productface']);

//        die;
        $bool= $this->db-> insert(PREFIX."sale",$_POST);
        if($bool){
            $this->db->set('status',$_POST['saletype']);
            $this->db->where('pid',$_POST['pid']);
            $this->db->update(PREFIX.'product');
            exit("OK");
        } else {
            exit("错误！请联系程序员");
        }
    }
    public  function PUpdate($agentid){
        IG::addslashes($_POST);   
        $_POST['siteid']=$agentid;
        $_POST['HistoricalRate'] =$this->GetHistoricalRate($agentid);
        $_POST['siteprofit']=(FLOAT)IG::POST('price')-(FLOAT)IG::POST('costprice')-(FLOAT)IG::POST('otherfee')- (FLOAT) IG::POST('platformfee')-(FLOAT)IG::POST('kuaidifee'); #算总部利润
        $_POST['agentprofit']= round($_POST['siteprofit'] * $_POST['HistoricalRate'] /  100); // 算本人利润
        $_POST['datetime'] =time(); //插入时间
        if( IG::post("saletime") and strtotime($_POST['saletime']) ){
            $_POST['saletime']= strtotime($_POST['saletime']);
        } else {
            $_POST['saletime']=""; //售出日期
        }
        if(IG::post("facephoto")){
            self::imgjson($_POST['facephoto']);
        }else{
            $_POST['facephoto'] =$_POST['productface'] ;
            
        }
        unset($_POST['productface']);
        $this->db->where(["siteid"=>$agentid,"id"=> IG::post("id")]);
       $bool= $this->db->update(PREFIX."sale",$_POST);
        if($bool){
            exit("OK");
        } else {
            exit("错误！请联系程序员");
        }
    }




    private function GetHistoricalRate($id){
        $d=$this->db ->from(PREFIX."user") ->select("fee")->where(['id'=>$id]) ->limit(1)->get()->result_array();
       if(empty($d)){
           exit("严重错误！，不存在的用户");
       }
       return $d[0]['fee'];
    }
    public function GetSalePList($id,$page,$z=20){
        
        self::wh();
        self::$where["s.siteid"]=$id;
        
        self::$count=
                $this->db->from(PREFIX."sale s") 
                ->select("count(*) as count")
                ->join(PREFIX."sale_platform pl","s.saleplatform =pl.id","left")
                ->join(PREFIX."sale_payment pa ","pa.id=s.payment","left")
                ->join(PREFIX."product_status st","st.id=s.saletype","left")
                ->where(self::$where)
                ->get()
                ->result_array();
        return
            $this->db->from(PREFIX."sale s") 
                ->select("s.* ,pl.name as plname,pa.name as paname,st.name as stname ,sa.name as saleman")
                ->join(PREFIX."sale_platform pl","s.saleplatform =pl.id","left")
                ->join(PREFIX."sale_payment pa ","pa.id=s.payment","left")
                ->join(PREFIX."product_status st","st.id=s.saletype","left")
                ->join(PREFIX."saleman sa","sa.id = s.saleman","left")
                ->where(self::$where)
                ->order_by("s.id desc")
                ->limit($z, $page > 1 ? ($page-1) * $z:0 )
                ->get()
                ->result_array();
    }
    static public function wh(){
        IG::set(self::$where); 
        IG::get("title") and self::$where['s.title LIKE  '] ="%". IG::get("title") ."%"; //title
        IG::get("pid") and self::$where['s.pid like'] = "%".IG::get("pid") ."%" ; //pid
        IG::get("saletype", self::$where['s.saletype'],"s.saletype" );//销售类型
        if(IG::get("video")){
            if((int) IG::get("video") == 1){
                self::$where['s.video  !='] ="";
            }else{
                self::$where['s.video'] ="";
            }
        }
        IG::get("payment", self::$where['s.payment'],"s.payment" ); //payment
        IG::get("agentid", self::$where['s.siteid'],"s.siteid" );   //代理商id
        IG::get("saleman", self::$where['s.saleman'],"s.saleman" ); 
        IG::get("saleplatform", self::$where['s.saleplatform'],"s.saleplatform" ); 
        IG::get("ispayback", self::$where['s.ispayback'],"s.ispayback" );
        IG::get("cid") && self::$where['s.cid LIKE  '] = "%".IG::get("cid") ."%"; //receiver
        IG::get("receiver") && self::$where['s.receiver LIKE  '] = "%".IG::get("receiver") ."%"; //receiver
        IG::get("startday") && strtotime(IG::get("startday")) && self::$where['s.datetime >  '] = strtotime(IG::get("startday"));
        IG::get("endday") && strtotime(IG::get("endday")) && self::$where['s.datetime  <  '] = strtotime(IG::get("endday"));
        if(IG::get("checktime") and $_GET['checktime'] == "today"){ //今日结款
            self::$where['agentid']=1;
            self::$where['saletype']=4;
            self::$where['ispayback']=0;
             self::$where['s.pid like'] = "b%" ;  // 寄卖
             self::$where['s.saletime  < ']=strtotime("-10 day");
        }
    }
}
 