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
                    <h1 class="page-header">城市管理</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
      


            <!-- /.row -->
             <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            城市管理 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                   


                            <div class="table-responsive">
                                <table class="table  table-bordered table-hover">
                                    <thead>
                                        <tr style="background:#f1f1f1">
                                            <th>ID</th>
                                            <th>名称</th>
                                            <th>排序</th>
                                            <th>操作</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($city as $key => $value) {
                                            # code...
                                        
                                        ?>
                                        <tr>
                                            <form name="saveform<?php echo $value->id?>" method="post" action="<?php echo site_url('home/city_edit_save')?>">
                                            <td><?php echo $value->id?><input name="id" type="hidden" value="<?php echo $value->id?>"></td>
                                            <td> <input name="name" type="text" value="<?php echo $value->name?>"></td>
                                            <td><input name="ordernum" type="text" value="<?php echo $value->ordernum?>"></td>
                                             <th><input type="submit" name="Submit" value="保存" class="btn btn-success"> <a href="http://www.baidu.com" data-toggle="modal" data-target="#myModal" class="delbtn btn btn-danger" value="<?php echo $value->id?>" onclick="getid(<?php echo $value->id?>)">删除</a></th>
                                            </form>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <form name="addform" method="post" action="<?php echo site_url('home/city_add_save')?>">
                                            <td>增加记录</td>
                                            <td> <input name="name" type="text"  ></td>
                                            <td><input name="ordernum" type="text"  value="<?php echo $maxnum?>"> </td>
                                             <th><input type="submit" name="Submit" value="添加" class="btn btn-default"> </th>
                                            </form>
                                        </tr>
                                         
                                    </tbody>
                                </table>
                                 
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
    function getid(id){
         $('#myid').val(id);
    }

    $('#delok').on('click',function(){
        //alert($('#myid').val());
        window.location='<?php echo site_url("home/city_del")?>/'+$('#myid').val();
    });
        
 
    </script>

</body>

</html>
