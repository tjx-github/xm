<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">


    <title>修改我的密码</title>
    <script src="<?php echo site_url('/')?>bootadmin/layui/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap Core CSS -->
    
    <link href="<?php echo site_url('/')?>bootadmin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo site_url('/')?>bootadmin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?php echo site_url('/')?>bootadmin/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo site_url('/')?>bootadmin/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo site_url('/')?>bootadmin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo site_url('/')?>bootadmin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
 <!--<link href="http://cdn.bootcss.com/twitter-bootstrap/2.2.2/css/bootstrap.min.css" rel="stylesheet">-->
 
</head>

<body>

<div id="wrapper">
       <?php echo $menu;?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">修改我的密码</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading" >
                            <div class="row">
                                <div class="col-md-12">您好，<?PHP  echo $login['username'];?>修改我的密码 </div>
                            </div>
                    </div>
                    <div class="panel-body">
                        
                        
                        <div class="table-responsive" style="height: 600px;">
                            <div class="row">
                                <div class="col-md-5"><input type="password" value="" name="password" class="form-control" placeholder="密码最小6位"/> </div>
                                <div class="col-md-5"><input type="button" id="button" value="提交修改" class="btn btn-success " /> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
    </div>
        <!-- /#page-wrapper -->
</div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <!--<script src="<?php echo site_url('/')?>bootadmin/vendor/jquery/jquery.min.js"></script>-->
    

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo site_url('/')?>bootadmin/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo site_url('/')?>bootadmin/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo site_url('/')?>bootadmin/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo site_url('/')?>bootadmin/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo site_url('/')?>bootadmin/vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo site_url('/')?>bootadmin/dist/js/sb-admin-2.js"></script>
    
    
    <script src="<?php echo site_url('/')?>bootadmin/layer2/layer.js"></script>
    <link href="<?php echo site_url('/')?>bootadmin/layer2/skin/layer.css" rel="stylesheet">
<script>
$(function(){
    $("#button").click(function(){
        p=$("input[name='password']").val();
        $("input[name='password']").val("");
        if(p.length  < 5 ){
            layer.open({
                title: '提示信息'
                ,content: "错误！，密码不能小于6位"
            });
        }else{
            $.getJSON("<?php  echo site_url("home/user_setmypass_save");  ?>",{pass:p},function(Data){
                layer.open({
                    title: '提示信息'
                    ,content: Data.data
                });
            });       
        }
    });
});
</script>

</body>

</html>
