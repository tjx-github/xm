<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo SITENAME?></title>


   <script src="<?php echo site_url('/')?>/bootadmin/vendor/jquery/jquery.min.js"></script>
   
    
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
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('/')?>/static/webuploader/demo2.css">
     
 
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
                    <h1 class="page-header">管理协议项目</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
      


            <!-- /.row -->
            <div class="row">


                <div class="col-lg-12">


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <form class="form-inline" role="form" id="setday" action="<?php echo site_url('home/agree_set_day')?>" method="post">
                           协议编号：<?php echo $agree['code']?>    起止日期：
                           <input type="hidden" id="aid" name="aid" value="<?php echo $agree['id']?>">
                           <input class="form-control" name="startday" id="startday" value="<?php echo date('Y-m-d',$agree['startday'])?>"  <?php echo $disablestr?>>
                           
                            <input class="form-control" name="endday" id="endday" value="<?php echo date('Y-m-d',$agree['endday'])?>"  <?php echo $disablestr?>>
                           <input type="submit" class="btn btn-success" value="保存" <?php echo $disablestr?>>
                           </form>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                        <div class="table-responsive">
                                <table class="table  table-bordered table-hover">
                                    <thead>
                                        <tr style="background:#f1f1f1">
                                          
                                            <th>货号</th>
                                            <th>名称</th>
                                            <th>单价</th>
                                            <th>数量</th>
                                            <th>图片</th>
                                            
                                             <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($item as $key => $value) {
                                            # code...
                                        
                                        ?>
                                        <tr>
                                            <td><input class="form-control"  id="pid<?php echo $value->id ?>" value="<?php echo $value->pid?>" <?php echo $disablestr?>></td>
                                            <td><input class="form-control"  id="brandname<?php echo $value->id ?>" value="<?php echo $value->brandname?>" <?php echo $disablestr?>> </td>
                                            <td><input class="form-control"  id="site_sale_price<?php echo $value->id ?>" value="<?php echo $value->site_sale_price?>" <?php echo $disablestr?>> </td>
                                            <td><input class="form-control"  id="amount<?php echo $value->id ?>" value="<?php echo $value->amount?>" <?php echo $disablestr?>></td>
                                            <td>
                                                <img id="myimg<?php echo $value->id ?>" src="<?php echo $value->pic?>" width="100" height="100">
                                                <?php
                                                if($agree['ck']==0){
                                                ?>
                                                <input type="file" name="pic<?php echo $value->id ?>" id="pic<?php echo $value->id ?>" multiple="multiple" class="listpic"/>
                                                <input type="hidden" id="img<?php echo $value->id ?>" name="img<?php echo $value->id ?>" >
                                          <?php } ?>
                                            </td>
                                             <td> 
                                                <?php 
                                                 if($agree['ck']==0){
                                                ?>
                                                <div class="form-inline" >
                                               
                                                    <input type="button" id="<?php echo $value->id?>" class="editbtn btn btn-success" value="修改"> &nbsp;
                                                    <a href="#" data-toggle="modal" data-target="#myModal" class=" form-control delbtn btn btn-danger" value="<?php echo $value->id?>" onclick="getid(<?php echo $value->id?>)">删除</a>
                                                
                                                </div>
                                                    <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>

                                       <?php 
                                       if($agree['ck']==0){
                                       ?>
                                         <tr>
                                            <input type="hidden" name="aid" id="aid" value="<?php echo $agree['id']?>">
                                            <th> <input class="form-control" name="pid" id="pid" placeholder="货号"></th>
                                            <th> <input class="form-control" name="brandname" id="brandname" placeholder="名称"></th>
                                            <th> <input class="form-control" name="site_sale_price" id="site_sale_price" placeholder="寄售价 ￥"></th>
                                            <th> <input class="form-control" name="amount" id="amount" value="1" placeholder="数量"></th>
                                            <th> 
                                                         <div class="form-group">
                                    <img src="" id="myimg" height="80" width="80" style="display:none"><br>
                                    <input type="file" name="pic" id="pic" multiple="multiple" />
                                    <input type="hidden" id="img" name="img" >

                                            </th>
                                            <th><button class="btn btn-success" id="addbtn">添加</button></th>
                                     
                                        </tr>
                                         
                                         <?php }?>
                                    </tbody>
                                </table>
                                 
                            </div>
                            <!-- /.table-responsive -->
                             
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



  <!---弹出确认框-->
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                   确定要删除么？
                </h4>
            </div>
            <input type="hidden" id="myid">
           
            <div class="modal-footer">
                 <button type="button" class="btn btn-danger" id="delok">
                    确认删除
                </button>

                <button type="button" class="btn btn-default" data-dismiss="modal">取消
                </button>
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>



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
   
     <script type="text/javascript" src="<?php echo site_url('/')?>/static/baidufex/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url('/')?>/static/baidufex/js/global.js"></script>
    <script type="text/javascript" src="<?php echo site_url('/')?>/static/baidufex/js/webuploader.js"></script>
    <script type="text/javascript" src="<?php echo site_url('/')?>/static/baidufex/js/demo.js"></script>
 






    <script type="text/javascript">
  
 
   function getid(id){
         $('#myid').val(id);
    }



$(function(){
 ////////////////

 

 $('#addbtn').on('click',function(){
  
  var pid=$('#pid').val();
  var aid=$('#aid').val();
  var brandname=$('#brandname').val();
  var site_sale_price=$('#site_sale_price').val();
  var amount=$('#amount').val();
  var img=$('#img').val();

  if(pid=='')
  {
    $('#pid').focus();
    return;
  }

    if(brandname=='')
  {
    $('#brandname').focus();
    return;
  }

      if(site_sale_price=='')
  {
    $('#site_sale_price').focus();
    return;
  }

       if(amount=='')
  {
    $('#amount').focus();
    return;
  }

      if(img=='')
  {
    alert('请选择照片');
    return;
  }

  //$('#additem').submit();
 
  var url='<?php echo site_url("home/agree_item_add_save")?>';
  $.post(url, {pid:pid,aid:aid,brandname:brandname,site_sale_price:site_sale_price,amount:amount,img:img}, function(response){
  window.location.reload();
  });



 });



   $("#pic").change(function () {  
            run(this, function (data) {  
                $('#myimg').attr('src', data);  
                 $('#myimg').show();
                 $('#img').val(data);  
            });  
        }); 


   $(".listpic").change(function () {  
            var id=this.id.replace('pic','');

            run(this, function (data) {  
                $('#myimg'+id).attr('src', data);  
                 $('#myimg'+id).show();
                 $('#img'+id).val(data);  
            });  
        });  



 $('.editbtn').on('click',function(){
  var id=this.id;
  var pid=$('#pid'+id).val();
  var aid=$('#aid'+id).val();
  var brandname=$('#brandname'+id).val();
  var site_sale_price=$('#site_sale_price'+id).val();
  var amount=$('#amount'+id).val();
  var img=$('#img'+id).val();


 
  if(pid=='')
  {
    $('#pid'+id).focus();
    return;
  }

    if(brandname=='')
  {
    $('#brandname'+id).focus();
    return;
  }


 

      if(site_sale_price=='')
  {
    $('#site_sale_price'+id).focus();
    return;
  }

       if(amount=='')
  {
    $('#amount'+id).focus();
    return;
  }

 

  //$('#additem').submit();
 
  var url='<?php echo site_url("home/agree_item_edit_save")?>';
  $.post(url, {id:id,pid:pid,aid:aid,brandname:brandname,site_sale_price:site_sale_price,amount:amount,img:img}, function(response){
  window.location.reload();
  alert('修改成功');

          
    });



 });



 $('#delok').on('click',function(){
        //alert($('#myid').val());
        window.location='<?php echo site_url("home/agree_item_del")?>/'+$('#myid').val();
    });


//////
    });



    /*
    转换为BASE64
    */
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
