<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo SITENAME?></title>
    
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo site_url('/')?>bootadmin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo site_url('/')?>bootadmin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo site_url('/')?>bootadmin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo site_url('/')?>bootadmin/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo site_url('/')?>bootadmin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DIY UPLOAD -->
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('/')?>/static/diyUpload/css/webuploader.css">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('/')?>/static/diyUpload/css/diyUpload.css">
    <script type="text/javascript" src="<?php echo site_url('/')?>/static/diyUpload/js/webuploader.html5only.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url('/')?>/static/diyUpload/js/diyUpload.js"></script>
    <!-- jQuery -->
    
    <link rel="stylesheet" type="text/css" href="http://fex.baidu.com/webuploader/css/webuploader.css">
    <link rel="stylesheet" type="text/css" href="http://fex.baidu.com/webuploader/css/demo.css">
    
 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php echo $menu;?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">添加销售订单</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
      


            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           添加销售订单
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" id="addform" method="post" action="">
                                       
                                      <input type="hidden" name="agentid" value="<?php echo $product['agentid']?>">
                                      
                                        <div class="form-group form-inline" id="piddiv">
                                            <label class="col-md-2">产品名称：</label>
                                            <input class="form-control" name="title" id="title" value="<?php echo $product['title']?>" placeholder="商品名称">
                                        </div>

                                         <div class="form-group form-inline" id="piddiv">
                                            <label class="col-md-2">产品货号：</label>
                                            <input class="form-control" name="pid" id="pid" value="<?php echo $product['pid']?>" placeholder="请输入货号">
                                        </div>
                                  
                                  <div class="form-group form-inline">
                                   <label class="col-md-2">库存状态:</label>
                                    <select name="saletype" id="saletype" class="form-control">
                                    <option value="">库存状态</option>
                                       <?php 
                                    foreach ($product_status as $key => $value) {

                                      if($product['status']==$value['id']){
                                          echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
                                      }else{
                                          echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                      }
                                      

                                    }
                                  ?> 
                                      
                                  </select>
                                 </div>

                                     <div class="form-group form-inline">
                                   <label class="col-md-2">销售平台：</label>
                                <select name="saleplatform" id="saleplatform" class="form-control">
                                    <option value="">销售平台</option>
                                      <?php 
                                    foreach ($sale_platform as $key => $value) {
                                      echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                    }
                                  ?> 
                                  </select>

                                  <input class="form-control" name="HistoricalRate" id="rate"  style="width:150px;" placeholder="平台手续费率">%
                                 </div>

                             
    
                          <div class="form-group form-inline" id="codediv">
                                <label class="col-md-2">产品售价：<i class="fa fa-1x fa-rmb"></i></label>
                                <input class="form-control" name="price"  id="price" placeholder="产品售价">
                          </div>  

                      <div class="form-group form-inline" id="codediv">
                                <label class="col-md-2">平台手续：<i class="fa fa-1x fa-rmb"></i></label>
                                <input class="form-control" name="platformfee"  id="platformfee" placeholder="平台手续">
                                <input type="button" class="btn btn-default" value="计算" id="getfeebtn"> 
                          </div>

                           <div class="form-group form-inline" id="codediv">
                                <label class="col-md-2">支付定金：<i class="fa fa-1x fa-rmb"></i></label>
                                <input class="form-control" name="preprice"  id="preprice" placeholder="支付定金">
                          </div>  


                          <div class="form-group form-inline" id="codediv">
                                <label class="col-md-2">成本价格：<i class="fa fa-1x fa-rmb"></i></label>
                                <input class="form-control" name="costprice" value="<?php echo $product['costprice']?>" id="costprice" placeholder="成本价格">
                          </div>

                          <div class="form-group form-inline" id="codediv">
                                <label class="col-md-2">护理费用：<i class="fa fa-1x fa-rmb"></i></label>
                                <input class="form-control" name="carefee" value="<?php echo $carefee; ?>" id="carefee" placeholder="护理费用">
                          </div>


                           <div class="form-group form-inline" id="codediv">
                                <label class="col-md-2">其他费用：<i class="fa fa-1x fa-rmb"></i></label>
                                <input class="form-control" name="otherfee" value="<?php echo $product['otherfee']?>" id="otherfee" placeholder="其他费用">
                          </div>


                        




                

                          <div class="form-group form-inline" id="codediv">
                                <label class="col-md-2">客户编号：</label>
                                <input class="form-control" name="cid"  id="cid" placeholder="客户编号">
                          </div>

                    
                    <div class="form-group form-inline">
                     <label class="col-md-2">销 售 员：</label>
                        <select class="form-group form-control"  name="saleman" id="saleman">
                          <option value="">请选择</option>
                             <?php 
                                        foreach ($saleman as $key => $value) {
                                          echo '<option value="'.$value['name'].'">'.$value['name'].'</option>';
                                        }
                              ?> 
                        </select>
                      </div>
                      

                       <div class="form-group form-inline">
                     <label class="col-md-2">收 货 人：</label>
                      <input class="form-control" name="receiver" id="receiver"  placeholder="收货人" value="<?php echo $product['receiver']?>">
                         
                      </div>

                            

                                 <div class="form-group form-inline">
                                   <label class="col-md-2">付款方式：</label>
                                <select name="payment" id="payment" class="form-control">
                                    <option value="">付款方式：</option>
                                     <?php 
                                      foreach ($sale_payment as $key => $value) {
                                      echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                    }
                                    ?>
                                  </select>
                                 </div>


                                <div class="form-group form-inline">
                                   <label class="col-md-2">快递公司：</label>
                                <select name="kuaidicompany" id="kuaidicompany" class="form-control">
                                    <option value="">快递公司：</option>
                                     <?php 
                                      foreach ($kuaidi_company as $key => $value) {
                                      echo '<option value="'.$value['name'].'">'.$value['name'].'</option>';
                                    }
                                    ?>
                                  </select>
                                 </div>
 
                      <div class="form-group form-inline" id="codediv">
                                <label class="col-md-2">快递单号：</label>
                                <input class="form-control" name="kuaidinum"  id="kuaidinum" placeholder="快递单号">
                          </div>

                           <div class="form-group form-inline" id="codediv">
                                <label class="col-md-2">快递费：</label>
                                <input class="form-control" name="kuaidifee"  id="kuaidifee" placeholder="快递费">
                          </div>
 
                          <div class="form-group form-inline" id="codediv">
                                        <label class="col-md-2">售出日期：</label>
                                        <input class="form-control" name="saletime"  id="saletime" value="<?php echo date('Y-m-d', time())?>" placeholder="售出日期">
                       </div>    

                      <div class="form-group form-inline" id="codediv">
                                    <label class="col-md-2">封面照片</label>
                                    
                                    <img src="<?php echo $product['facephoto']?>" id="myimg" height="80" width="80" ><br>

                                    <input type="file" name="pic" id="pic" multiple="multiple" />
                                    <input type="hidden" id="facephoto" name="facephoto" >
                                    <input type="hidden" id="productface" name="productface"  value="<?php echo $product['facephoto']?>">
                        </div>  


                       <div class="form-group" id="codediv">
                                      <label class="col-md-2">备注信息：</label>
                                      <!--<textarea class="form-control" name="content" value="<?php // echo $product['content']; ?>" id="content" rows="3"><?php // echo $product['content']; ?></textarea>-->
                                      <textarea class="form-control" name="content"  id="content" rows="3"></textarea>
                       </div>


 
                                     <button type="button" class="btn btn-success" id="gobtn">提交</button>
                                         
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                
                            
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
           





        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   <script src="<?php echo site_url('/')?>/bootadmin/vendor/jquery/jquery.min.js"></script>
   
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo site_url('/')?>bootadmin/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo site_url('/')?>bootadmin/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo site_url('/')?>bootadmin/vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo site_url('/')?>bootadmin/vendor/morrisjs/morris.min.js"></script>
    <script src="<?php echo site_url('/')?>bootadmin/data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo site_url('/')?>bootadmin/dist/js/sb-admin-2.js"></script>




    <script type="text/javascript">
    // 添加全局站点信息
    var BASE_URL = '/webuploader';
    </script>
   
    <script type="text/javascript" src="http://fex.baidu.com/webuploader/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://fex.baidu.com/webuploader/js/global.js"></script>
    <script type="text/javascript" src="http://fex.baidu.com/webuploader/js/webuploader.js"></script>
    <script type="text/javascript" src="<?php echo site_url('/')?>/static/webuploader/demo.js"></script>
 




    <script type="text/javascript">
 


    $(function(){
 ////////////////

 
 


 $('#gobtn').on('click',function(){
 
 
     if($('#title').val()=='')
      {
          $('#title').focus();
          return false;
      }

       if($('#price').val()=='')
      {
          $('#price').focus();
          return false;
      }

        $.post("/home/sale_add_save/",$("form").serializeArray(),function(data){
            alert(data);
            if(data == 'OK'){
                //跳转
                window.location.href ='/home/sale_list/';
            }
        });
 });


$('#getfeebtn').on('click',function(){

  if($('#price').val()>0 && $('#rate').val()>0)
  {
    platformfee=($('#price').val()*$('#rate').val()/100);
    $('#platformfee').val(platformfee);
  }else
  {
    $('#platformfee').val('0');
  }

});

//////
    });



    $("#pic").change(function () {  
            run(this, function (data) {  
                $('#myimg').attr('src', data);  
                 $('#myimg').show();
                 $('#facephoto').val(data);  
            });  
        }); 

 
        function run(input_file, get_data) {  
            /*input_file：文件按钮对象*/  
            /*get_data: 转换成功后执行的方法*/  
            if (typeof (FileReader) === 'undefined') {  
                alert("抱歉，你的浏览器不支持 FileReader，不能将图片转换为Base64，请使用现代浏览器操作！");  
            } else {  
                try {  
                    /*图片转Base64 核心代码*/  
                    var file = input_file.files[0];  
                    //这里我们判断下类型如果不是图片就返回 去掉就可以上传任意文件  
                    if (!/image\/\w+/.test(file.type)) {  
                        alert("请确保文件为图像类型");  
                        return false;  
                    }  
                    var reader = new FileReader();  
                    reader.onload = function () {  
                        get_data(this.result);  
                    }  
                    reader.readAsDataURL(file);  
                } catch (e) {  
                    alert('图片转Base64出错啦！' + e.toString())  
                }  
            }  
        } 


    </script>

</body>

</html>
