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
                    <h1 class="page-header">编辑洗护订单</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
      


            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           修改洗护订单
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" id="addform" method="post" action="<?php echo site_url('home/care_edit_save')?>">
                                       <input type="hidden" name="id" id="id" value="<?php echo $care['id']?>">
                                       <input type="hidden" name="agentid" value="<?php echo $care['agentid']?>">
                                        
                         <div class="form-group" id="codediv">
                                            <label>护理标题</label>
                                            <input class="form-control" name="title"  id="title" value="<?php echo $care['title']?>" placeholder="输入护理标题">
                                        </div>


                                         <div class="form-group" id="codediv">
                                            <label>护理编号</label>
                                            <input class="form-control" name="code"  id="code" value="<?php echo $care['code']?>" placeholder="输入护理编号">
                                        </div>
                                      
                                   <div class="form-group">
                                   <label>订单状态</label>
                                <select name="status" id="status" class="form-control">
                                    
                                  <?php 
                                    foreach ($status as $key => $value) {
                                      if($care['status']==$value['id']){
                                         echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
                                      }else{
                                         echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                      }

                                     

                                    }
                                  ?> 
                                  </select>

                                 </div>


                                  <div class="form-group" id="sentdiv" <?php if($care['status']!='4'){?>style="display:none"<?php }?>>
                                   <label>发件方式</label>
                                <select name="sentway" id="sentway" class="form-control">
                                   
                                  <?php
                                  if($care['sentway']!=''){
                                    echo ' <option value="'.$care['sentway'].'">'.$care['sentway'].'</option>';
                                  }else
                                  {
                                    echo ' <option value="">发件方式</option>';
                                  }
                                  ?>

                                    <option value="客户上门">客户上门</option>
                                    <option value="工作人员上门">工作人员上门</option>
                                    <option value="快递">快递</option>
                                </select>

                                 </div>


                              <div class="form-group kuaidi"   <?php if($care['sentway']!='快递'){?> style="display:none" <?php }?>>
                                   <label>快递公司</label>
                                <select name="kuaidicompany" id="kuaidicompany" class="form-control">
                                   
                                   <?php 
                                      foreach ($kuaidicompany as $key => $value) {
                                      if($care['kuaidicompany']==$value['name'])
                                          {
                                             echo '<option value="'.$value['name'].'" selected>'.$value['name'].'</option>';
                                           }else
                                           {
                                             echo '<option value="'.$value['name'].'">'.$value['name'].'</option>';
                                           }
                                    }
                                    ?>
                                    
                                </select>

                                 </div>

                                      <div class="form-group kuaidi"  <?php if($care['sentway']!='快递'){?>style="display:none"<?php } ?>>
                                            <label> 快递单号</label>
                                            <input class="form-control" name="kuaidi" id="kuaidi" value="<?php echo $care['kuaidi']?>" placeholder="请输入货号">
                                             
                                        </div>

                                          <div class="form-group kuaidi">
                                            <label>发件快递费</label>
                                            <input class="form-control" name="kuaidifee" id="kuaidifee"  value="<?php echo $care['getkuaidifee']?>"  placeholder="请输入收件快递费">
                                             
                                        </div>



                                        <div class="form-group" id="piddiv">
                                            <label>货号（选填）</label>
                                            <input class="form-control" name="pid" id="pid" value="<?php echo $care['pid']?>" placeholder="请输入货号">
                                             
                                        </div>


                                          <div class="form-group" id="piddiv">
                                            <label>订单来源</label>
                                            <input class="form-control" name="orderfrom" id="orderfrom" value="<?php echo $care['orderfrom']?>" placeholder="订单来源">
                                             
                                        </div>


                                              <div class="form-group" id="piddiv">
                                            <label>顾客姓名（选填）</label>
                                            <input class="form-control" name="username" id="username" value="<?php echo $care['username']?>" placeholder="顾客姓名">
                                             
                                        </div>


                                              <div class="form-group" id="piddiv">
                                            <label>手机号</label>
                                            <input class="form-control" name="mobile" id="mobile" value="<?php echo $care['mobile']?>" placeholder="手机号">
                                             
                                        </div>
                                      
                             
 
                                    
                                 <div class="form-group">
                                   <label>货品类别</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">选择类别</option>
                                  <?php 
                                    foreach ($category as $key => $value) {
                                      //echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';

                                     if($care['category']==$value['id']){
                                         echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
                                      }else{
                                         echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                      }


                                    }


                                  ?> 
                                  </select>

                                 </div>


 
                                   
                        <div class="form-group"   id="otherdiv">
                                    <label>品牌</label>
                                    <input class="form-control" placeholder="品牌" value="<?php echo $care['brandname']?>" name="brandname" id="brandname">
                            </div>



                         


                      <div class="form-group" id="codediv">
                                        <label>配件</label>
                                        <input class="form-control" name="accessory" value="<?php echo $care['accessory']?>"  id="accessory" placeholder="配件">
                       </div>


                         <div class="form-group" id="codediv">
                                        <label>护理内容</label>
                                       <textarea class="form-control" name="carecontent" id="carecontent"   rows="3"><?php echo $care['carecontent']?></textarea>
                       </div>

                        <div class="form-group" id="codediv">
                                        <label>费用</label>
                                        <input class="form-control" name="fee"  id="fee" value="<?php echo $care['fee']?>" placeholder="费用">
                       </div>

                            <div class="form-group" id="codediv">
                                        <label>成本</label>
                                        <input class="form-control" name="cost"  value="<?php echo $care['cost']?>" id="cost" placeholder="成本">
                       </div>


                          <div class="form-group" id="codediv">
                                        <label>是否加急</label>
                                        <input  type="checkbox" name="urgent"  id="urgent"   value="1" <?php if($care['urgent']==1){echo 'checked';}?>>
                       </div>

                         <div class="form-group" id="codediv">
                                        <label>加急备注</label>
                                        <input class="form-control" name="urgentreason"  id="urgentreason" value="<?php echo $care['urgentreason']?>" placeholder="加急原因" >
                       </div>


                                 <div class="form-group">
                                   <label>收件方式</label>
                                <select name="getway" id="getway" class="form-control">
                                  <?php
                                  if($care['getway']!=''){
                                    echo ' <option value="'.$care['getway'].'">'.$care['getway'].'</option>';
                                  }else
                                  {
                                    echo ' <option value="">收件方式</option>';
                                  }
                                  ?>
                                   
                                    <option value="客户上门">客户上门</option>
                                    <option value="工作人员上门">工作人员上门</option>
                                    <option value="客户上门">快递</option>
                                </select>

                                 </div>


                                 <div id="getdiv">
                    <div class="form-group kuaidi"  >
                                   <label>收件快递公司</label>
                                <select name="getkuaidicompany" id="getkuaidicompany" class="form-control">
                                   <option value="">选择快递公司</option>
                                   <?php 
                                      foreach ($kuaidicompany as $key => $value) {
                                       if($care['getkuaidicompany']==$value['name']){
                                        echo '<option value="'.$value['name'].'" selected>'.$value['name'].'</option>';
                                           
                                       }else{
                                        echo '<option value="'.$value['name'].'">'.$value['name'].'</option>';
                                           
                                       }
                                             
                                    }
                                    ?>
                                    
                                </select>
  </div>

                                  <div class="form-group kuaidi">
                                            <label> 快递单号</label>
                                            <input class="form-control" name="getkuaidi" id="getkuaidi"  value="<?php echo $care['getkuaidi']?>"  placeholder="请输入收件快递号">
                                             
                                    </div>


                                        <div class="form-group kuaidi">
                                            <label>收件快递费</label>
                                            <input class="form-control" name="getkuaidifee" id="getkuaidifee"  value="<?php echo $care['getkuaidifee']?>"  placeholder="请输入收件快递费">
                                             
                                        </div>
                        
</div>




              <div class="form-group form-inline">
                                   <label>付款方式：</label>
                                <select name="payment" id="payment" class="form-control">
                                    <option value="">付款方式：</option>
                                     <?php 
                                      foreach ($payment as $key => $value) {
                                       if($care['payment']==$value['id'])
                                          {
                                             echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
                                           }else
                                           {
                                             echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                           }
                                    }
                                    ?>
                                  </select>
                                 </div>



                      

    <div class="form-group" id="codediv">
                                        <label>备注</label>
                                       <textarea class="form-control" name="content" id="content"   rows="3"><?php echo $care['content']?></textarea>
                       </div>


 
   <div class="form-group form-inline" id="codediv">
                                    <label>封面照片</label>
                                    <img src="<?php echo $care['facephoto']?>" id="myimg" height="120" width="120"  ><br>
                                    <input type="file" name="pic" id="pic" multiple="multiple" />
                                    <input type="hidden" id="facephoto" name="facephoto" >
          </div>  



     <div class="form-group" id="photosdiv">
       <label>产品图片：</label>
       <div >
 <?php 
 if(strlen($care['photos'])>5){
                                             $picarr=json_decode($care['photos']);
                                             foreach ($picarr as $key => $v) {
                                                  echo '<a href="'.site_url('/').$v .'" target="_blank"><img src="'.site_url('/').$v .'" height="200" width="200" class="imgborder"></a>&nbsp;';
                                             }
                                           }

                                            ?>
                                          </div>
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



                                     <button type="button" class="btn btn-success" id="gobtn">保存</button>
                                         
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

        // AJAX 读取品牌列表
    $('#category').on('change',function(){
      
        var catid=$('#category').val();

       $.getJSON('/api/brandlist/'+catid, function(data){
           
          //var tname='<select id="brand" name="brand"><option value="">选择品牌</option>';
          var tname='<option value="">选择品牌</option>';

           for(var key in data){
            var str=' ';
            str='<option value="'+data[key]['id']+'">'+data[key]['brandname']+'</option>';
            tname=tname+str;
           }
           tname=tname+'<option value="其他">其他</option>';
           //tname=tname+'</select>';
           
            $('#brand').html(tname);
       });
      
      });
    


// 如果品牌选择了其他
    $('#brand').on('change',function(){
      
        str=$('#brand').val();
        
        if(str=='其他')
        {
           $('#otherdiv').css('display','block');
         }else
         {
           $('#otherdiv').css('display','none');
         }
        

    });
/////////////


//如果选择了已发货，就选择方式
    $('#status').on('change',function(){
      str=$('#status').val();
       if(str=='4')
       {
         $('#sentdiv').css('display','block');
          $('#sentway').focus();
       }
       else{
           $('#sentdiv').css('display','none');
         }

    });


    //如果选择了已发货，就选择方式
    $('#sentway').on('change',function(){
      str=$('#sentway').val();
       if(str=='快递')
       {
         $('.kuaidi').css('display','block');
          $('.kuaidicompany').focus();
       }
       else{
           $('.kuaidi').css('display','none');
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
