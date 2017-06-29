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
                    <h1 class="page-header">管理中心</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <div class="row">
                  <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           使用说明
                        </div>
                        <div class="panel-body">
                            <p><?php echo $login['fullname']?> 欢迎使用优正品后台管理系统</p>
                        </div>
                         
                    </div>
                </div>
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

</body>

</html>
