
<!DOCTYPE html>
<html>
  <head>
    <div id='wx_pic' style='margin:0 auto;display:none;'>
          <img src="<?php echo $v['facephoto'];  ?>" />
    </div>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php  echo  $v["title"]; ?> </title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <link rel="stylesheet" href="//res.wx.qq.com/open/libs/weui/1.0.2/weui.min.css">
     <script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
     <link rel="stylesheet" href="/bootadmin/img/lib/weui.min.css">
     <link rel="stylesheet" href="/bootadmin/img/css/jquery-weui.css">
    <link rel="stylesheet" href="/bootadmin/img/css/style.css">
  </head>
  <body>

      
 <div class="page">
  <header class="bar bar-nav">
   
    <h1 class="title">商品详情</h1>
  </header>
 
  <div class="content">
    
 
  <div class="list-block" style="font-size:.8rem;margin-top:0">
    <ul>
      <!-- Text inputs -->
       <li>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-name"></i></div>
          <div class="item-inner">
            <div class="item-title label">产品名称：</div>
            <div class="item-input">
               <?php  echo  $v["title"]; ?>       </div>
          </div>
        </div>
      </li>

        <li>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-name"></i></div>
          <div class="item-inner">
            <div class="item-title label">产品货号：</div>
            <div class="item-input">
               <?php  echo  $v["pid"]; ?>            </div>
          </div>
        </div>
      </li>

          <li>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-name"></i></div>
          <div class="item-inner">
            <div class="item-title label">产品类别：</div>
            <div class="item-input">
               <?php  echo  $v["saletype"]; ?>            </div>
          </div>
        </div>
      </li>




      

        <li>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-name"></i></div>
          <div class="item-inner">
            <div class="item-title label">规格：</div>
            <div class="item-input">
               <?php  echo  $v["size"]; ?>           </div>
          </div>
        </div>
      </li>


              <li>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-name"></i></div>
          <div class="item-inner">
            <div class="item-title label">产品类型：</div>
            <div class="item-input">
              <?php  echo  $v["caname"]; ?><br/>



            </div>
          </div>
        </div>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-name"></i></div>
          <div class="item-inner">
            <div class="item-title label">入库类型：</div>
            <div class="item-input">
              <?php  echo  $v["saletype"]; ?><br/>



            </div>
          </div>
        </div>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-name"></i></div>
          <div class="item-inner">
            <div class="item-title label">销售价：</div>
            <div class="item-input">
              <?php  echo  $v["saleprice"]; ?><br/>



            </div>
          </div>
        </div>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-name"></i></div>
          <div class="item-inner">
            <div class="item-title label">代理价：</div>
            <div class="item-input">
              <?php  echo  $v["rivalprice"]; ?><br/>



            </div>
          </div>
        </div>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-name"></i></div>
          <div class="item-inner">
            <div class="item-title label">保留价：</div>
            <div class="item-input">
              <?php  echo  $v["holdprice"]; ?><br/>



            </div>
          </div>
        </div>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-name"></i></div>
          <div class="item-inner">
            <div class="item-title label">其他费用：</div>
            <div class="item-input">
              <?php  echo  $v["otherfee"]; ?><br/>
            </div>
          </div>
        </div>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-name"></i></div>
          <div class="item-inner">
            <div class="item-title label">库存状态：</div>
            <div class="item-input">
              <?php  echo  $v["prname"]; ?><br/>



            </div>
          </div>
        </div>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-name"></i></div>
          <div class="item-inner">
            <div class="item-title label">备注：</div>
            <div class="item-input">
              <?php  echo  $v["content"]; ?><br/>



            </div>
          </div>
        </div>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-name"></i></div>
          <div class="item-inner">
<!--            <div class="item-title label">照片：</div>-->
            <div class="item-input">
<?php
$data= json_decode( $v["photos"],true); 
                            if($data){
?>
              <div class="weui-content">
                        <div class="swiper-container swiper-zhutu">
                           <div class="swiper-wrapper">
                            <?php  
                                foreach($data as $value){
                            ?>
                             <div class="swiper-slide"><img src="<?php echo $value;?>" /></div>
                                <?php }?>
                           </div>
                           <div class="swiper-pagination swiper-zhutu-pagination"></div>
                         </div>
            </div>
   <?php }?>


            </div>
          </div>
        </div>
        
      </li>

 <li>

 
 


        <li>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-name"></i></div>
          <div class="item-inner">
           <!--本证书最终解释权归 恒盛商贸（上海）有限公司所有-->
          </div>
        </div>
      </li>


 


  
  
    </ul>
  </div>

  

  

 

 
</div>


     
     

<script>
  $(function() {
    FastClick.attach(document.body);
  });
</script> 
    <script src="/bootadmin/img/js/jquery-weui.js"></script>
    <script src="/bootadmin/img/js/swiper.js"></script>
<script>
$(".swiper-zhutu").swiper({
        loop: true,
		paginationType:'fraction',
        autoplay:5000
      });
</script>

    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>

  </body>
</html>