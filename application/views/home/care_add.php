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
        <?php echo $nav?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">添加洗护订单</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
      


            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           添加洗护订单
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" id="addform" method="post" action="<?php echo site_url('home/care_add_save')?>">
                                       
                                         <div class="form-group" id="codediv">
                                            护理标题 <input class="form-control" name="title"  id="title" placeholder="输入标题">
                                        </div>

                                         <div class="form-group" id="codediv">
                                            护理编号 <input class="form-control" name="code"  id="code" placeholder="输入护理编号">
                                        </div>
                                      


                                        <div class="form-group" id="piddiv">
                                            <label>货号（选填）</label>
                                            <input class="form-control" name="pid" id="pid" placeholder="请输入货号">
                                             
                                        </div>


                                          <div class="form-group" id="piddiv">
                                            <label>订单来源</label>
                                            <input class="form-control" name="orderfrom" id="orderfrom" placeholder="订单来源">
                                             
                                        </div>


                                              <div class="form-group" id="piddiv">
                                            <label>顾客姓名（选填）</label>
                                            <input class="form-control" name="username" id="username" placeholder="顾客姓名">
                                             
                                        </div>


                                              <div class="form-group" id="piddiv">
                                            <label>手机号</label>
                                            <input class="form-control" name="mobile" id="mobile" placeholder="手机号">
                                             
                                        </div>
                                      
                             
 
                                    
                                 <div class="form-group">
                                   <label>货品类别</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">选择类别</option>
                                  <?php 
                                    foreach ($category as $key => $value) {
                                      echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                    }
                                  ?> 
                                  </select>

                                 </div>


 
                                   
                     


                             <div class="form-group"   id="otherdiv">
                                    <label>品牌</label>
                                    <input class="form-control" placeholder="品牌" name="brandname" id="brandname">
                            </div>


                      <div class="form-group" id="codediv">
                                        <label>配件</label>
                                        <input class="form-control" name="accessory"  id="accessory" placeholder="配件">
                       </div>


                         <div class="form-group" id="codediv">
                                        <label>护理内容</label>
                                       <textarea class="form-control" name="carecontent" id="carecontent" rows="3"></textarea>
                       </div>

                        <div class="form-group" id="codediv">
                                        <label>费用</label>
                                        <input class="form-control" name="fee"  id="fee" placeholder="费用">
                       </div>

                          <div class="form-group" id="codediv">
                                        <label>成本</label>
                                        <input class="form-control" name="cost"  id="cost" placeholder="成本">
                       </div>

                          <div class="form-group" id="codediv">
                                        <label>是否加急</label>
                                        <input  type="checkbox" name="urgent"  id="urgent"  value="1">
                       </div>

                         <div class="form-group" id="codediv">
                                        <label>加急备注</label>
                                        <input class="form-control" name="urgentreason"  id="urgentreason" placeholder="加急原因">
                       </div>


                                 <div class="form-group">
                                   <label>收件方式</label>
                                <select name="getway" id="getway" class="form-control">
                                    <option value="">收件方式</option>
                                    <option value="客户上门">客户上门</option>
                                    <option value="工作人员上门">工作人员上门</option>
                                    <option value="快递">快递</option>
                                </select>

                                 </div>

<div id="getdiv" style="display:none">
                    <div class="form-group kuaidi"  >
                                   <label>收件快递公司</label>
                                <select name="getkuaidicompany" id="getkuaidicompany" class="form-control">
                                    <option value="">选择快递公司</option>
                                   <?php 
                                      foreach ($kuaidicompany as $key => $value) {
                                       
                                             echo '<option value="'.$value['name'].'">'.$value['name'].'</option>';
                                           
                                    }
                                    ?>
                                    
                                </select>
  </div>

                                  <div class="form-group kuaidi">
                                            <label> 快递单号</label>
                                            <input class="form-control" name="getkuaidi" id="getkuaidi"   placeholder="请输入收件快递号">
                                             
                                        </div>


                                       <div class="form-group kuaidi">
                                            <label>收件快递费</label>
                                            <input class="form-control" name="getkuaidifee" id="getkuaidifee"   placeholder="请输入收件快递费">
                                             
                                        </div>
                        
</div>


      <div class="form-group form-inline">
                                   <label>付款方式：</label>
                                <select name="payment" id="payment" class="form-control">
                                    <option value="">付款方式：</option>
                                     <?php 
                                      foreach ($payment as $key => $value) {
                                      echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                    }
                                    ?>
                                  </select>
                                 </div>

                                 

    <div class="form-group" id="codediv">
                                        <label>备注</label>
                                       <textarea class="form-control" name="content" id="content"   rows="3"> </textarea>
                       </div>


<!--
                             <div class="form-group" id="codediv">
                                        <label>材质</label>
                                        <input class="form-control" name="material"  id="material" placeholder="材质">
                                    </div>
-->


  <div class="form-group form-inline" id="codediv">
                                    <label>封面照片</label>
                                    <img src="" id="myimg" height="80" width="80" style="display:none"><br>
                                    <input type="file" name="pic" id="pic" multiple="multiple" />
                                    <input type="hidden" id="facephoto" name="facephoto" >
          </div>  


                    <div class="form-group">
                                            
<div id="uploader" class="wu-example">
    <div class="queueList">
        <div id="dndArea" class="placeholder">
            <div id="filePicker"></div>
            <p>或将照片拖到这里，单次最多可选26张</p>
        </div>
    </div>
  
<div id="piclist"></div>

</div>


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

 


 



    //如果选择了已发货，就选择方式
    $('#getway').on('change',function(){
      str=$('#getway').val();
       if(str=='快递')
       {
         $('#getdiv').css('display','block');
          $('.getkuaidicompany').focus();
       }
       else{
           $('.getkuaidi').css('display','none');
         }
         
    });



 $('#gobtn').on('click',function(){
    var $piclist=$('#piclist');
    var inputstr='';
    $("#uploader img").each(function(i){
               //alert("no:"+"  src:"+$(this).attr("src"));
               inputstr=inputstr+'<input name="img[]" type="hidden" value="'+$(this).attr("src")+'">';
               
         }); 
    $piclist.html(inputstr);
   
 
    
     if($('#title').val()=='')
      {
          $('#title').focus();
          return false;
      }
       if($('#code').val()=='')
      {
          $('#code').focus();
          return false;
      }

        if($('#mobile').val()=='')
      {
          $('#mobile').focus();
          return false;
      }

         if($('#category').val()=='')
      {
          $('#category').focus();
          return false;
      }

  

          if($('#getway').val()=='')
      {
          $('#getway').focus();
          return false;
      }
      
      $('#addform').submit();


     



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




//////
    });

    </script>

</body>

</html>
