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

  <!--
  <link rel="stylesheet" type="text/css" href="http://fex.baidu.com/webuploader/css/webuploader.css">
    <link rel="stylesheet" type="text/css" href="http://fex.baidu.com/webuploader/css/demo.css">
      -->
 
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
                    <h1 class="page-header">添加代理商产品</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
      


            <!-- /.row -->
            <div class="row ">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           添加产品
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group form-inline col-lg-5">
                                    <label >代理商：</label>
                                        <select name="agentid" id="agentid" class="form-control  ">
                                            <option value="">选择代理商</option>
                                                <?php 
                                                  foreach ($agent as $key => $value) {
                                                    echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                                  }
                                                ?> 
                                        </select>
                                </div>                                  
                            </div>
                            <div id="form"></div>
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
        $("#agentid").click(function(){
            if($(this).val().length  ){
                $.post("/home/product_agent_ajax_html",{id:$(this).val()},function(html){
                    $("#form").html(html);
                    
                });
            }  
        });
    });
        
    

    </script>

</body>

</html>
