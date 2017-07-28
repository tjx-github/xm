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
                    <h1 class="page-header">证书列表</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            证书列表 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form action="" method="get">
                                <div class="form-group input-group col-lg-4">
                                    <input type="text" name="search" class="form-control" placeholder="输入关键词">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default"  id="submit"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                       <div class="table-responsive">
                                <table class="table  table-bordered table-hover">
                                    <thead>
                                        <tr style="background:#f1f1f1">
                                            <th>ID</th>
                                            <th>商品货号</th>
                                            <th>证书编号</th>
                                            <th>商品品牌</th>
                                            <th>款式</th>
                                           
                                            <th>图片</th>
                                            <th>操作</th>
                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($certlist as $key => $value) {
                                            # code...
                                        
                                        ?>
                                        <tr>
                                            <td><?php echo $value['id']?></td>
                                            <td><?php echo $value['pid']?></td>
                                            <td><?php echo $value['code']?></td>
                                            <td><?php echo $value['brandname']?></td>
                                            <td><?php echo $value['style']?></td>
                                            
                                         <td class="imglist" id="<?php echo $value['id'];?>">
                                              
                                          
                                              <a href="<?php echo $value['facephoto']?>" target="_blank"><img src="<?php echo $value['facephoto']?>" width="80" height="80"></a>


                                             <div style="position:absolute;margin-top:-150px;height:200px;width:200px;z-index:999;float:left;display:none;" id="imgdiv<?php echo $value['id'];?>"> <img src="<?php echo site_url('/').$value['facephoto']?>" height="200" width="200" class="imgborder" ></div>
                                      
                                        </td>
                                             <th><a href="http://wx.uzhengpin.com/cert/certview?code=<?php echo $value['code']?>" target="_blank">预览</a>&nbsp;
<!--                                                 <a href="<?php echo site_url('home/cert_edit/'.$value['id']);?>">编辑</a> &nbsp;
                                                 <a href="http://www.baidu.com" data-toggle="modal" data-target="#myModal" class="delbtn" value="<?php echo $value['id']?>" onclick="getid(<?php echo $value['id']?>)">删除</a>-->
                                             </th>
                                        </tr>
                                        <?php } ?>

                                         
                                    </tbody>
                                </table>
                                 <?php echo $pagelink?>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                   

                </div>
                <!-- /.col-lg-6 -->
                
            </div>
            <!-- /.row -->
           





        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->






    <!-- jQuery -->
    <script src="<?php echo site_url('/')?>bootadmin/vendor/jquery/jquery.min.js"></script>

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
     $("#submit").click(function(){
         $(this).submit();
     })
    </script>

</body>

</html>
