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

    <link rel="stylesheet" type="text/css" href="<?php echo site_url('/')?>/static/baidufex/css/webuploader.css">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('/')?>/static/baidufex/css/demo.css">

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
                    <h1 class="page-header">添加鉴定证书</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
      


            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           添加鉴定证书
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" id="addform" method="post" action="<?php echo site_url('home/cert_add_save')?>">
                                        <div class="form-group" id="piddiv">
                                            <label>货号</label>
                                            <input class="form-control" name="pid" id="pid" placeholder="请输入货号">
                                             
                                        </div>
                                        <div class="form-group" id="codediv">
                                            <label>证书编号</label>
                                            <input class="form-control" name="code"  id="code" placeholder="输入证书编号">
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
                                        <label>款式</label>
                                        <input class="form-control" name="style"  id="style" placeholder="款式">
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
            <p>或将照片拖到这里，单次最多可选300张</p>
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
   
    <script type="text/javascript" src="<?php echo site_url('/')?>/static/baidufex/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url('/')?>/static/baidufex/js/global.js"></script>
    <script type="text/javascript" src="<?php echo site_url('/')?>/static/baidufex/js/webuploader.js"></script>
    <script type="text/javascript" src="<?php echo site_url('/')?>/static/baidufex/js/demo.js"></script>
 



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



 $('#gobtn').on('click',function(){
    var $piclist=$('#piclist');
    var inputstr='';
    $("#uploader img").each(function(i){
               //alert("no:"+"  src:"+$(this).attr("src"));
               inputstr=inputstr+'<input name="img[]" type="hidden" value="'+$(this).attr("src")+'">';
               
         }); 
    $piclist.html(inputstr);
   
 
     if($('#pid').val()=='')
      {
          $('#pid').focus();
          return false;
      }

       if($('#code').val()=='')
      {
          $('#code').focus();
          return false;
      }

         if($('#category').val()=='')
      {
          $('#category').focus();
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
