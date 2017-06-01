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
                           协议编号：<?php echo $agree['id']?>    起止日期：<?php echo date('Y-m-d',$agree['startday'])?> - <?php echo date('Y-m-d',$agree['endday'])?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                        <div class="table-responsive">
                                <table class="table  table-bordered table-hover">
                                    <thead>
                                        <tr style="background:#f1f1f1">
                                            <th>品牌</th>
                                            <th>货号</th>
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
                                            <td><?php echo $value->brandname?></td>
                                            <td><?php echo $value->pid?></td>
                                            <td><?php echo $value->site_sale_price?></td>
                                            <td><?php echo $value->amount?></td>
                                            <td><?php echo $value->pic?></td>
                                             <th> <a href="#" data-toggle="modal" data-target="#myModal" class="delbtn" value="<?php echo $value->id?>" onclick="getid(<?php echo $value->id?>)">删除</a></th>
                                        </tr>
                                        <?php } ?>

                                       
                                         <tr>
                                            <th> <input class="form-control" name="pid" id="pid" placeholder="货号"></th>
                                            <th> <input class="form-control" name="brandname" id="brandname" placeholder="品牌名"></th>
                                            <th> <input class="form-control" name="site_sale_price" id="site_sale_price" placeholder="寄售价"></th>
                                            <th> <input class="form-control" name="amount" id="amount" placeholder="数量"></th>
                                            <th> 
                                                         <div class="form-group">
                                            
<div id="uploader" class="wu-example">
    <div class="queueList">
        <div id="dndArea" class="placeholder">
            <div id="filePicker"></div>
             
        </div>
    </div>
  
<div id="piclist"></div>

</div>

                                            </th>
                                            <th><button class="btn btn-success" id="addbtn">添加</button></th>
                                        </tr>
                                         
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
    <script type="text/javascript" src="<?php echo site_url('/')?>/static/webuploader/demo2.js"></script>
 




    <script type="text/javascript">
 


    $(function(){
 ////////////////

     



 $('#addbtn').on('click',function(){
  
  alert('Ok');


 });




//////
    });

    </script>

</body>

</html>
