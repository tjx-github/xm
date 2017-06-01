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
                    <h1 class="page-header">协议列表</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
      


            <!-- /.row -->
             <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            协议列表 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!--
                              <div class="form-group input-group col-lg-4">
                                            <input type="text" class="form-control" placeholder="输入关键词">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button"><i class="fa fa-search"></i>
                                                </button>
                                            </span>


                                 </div>
                             -->



                            <div class="table-responsive">
                                <table class="table  table-bordered table-hover">
                                    <thead>
                                        <tr style="background:#f1f1f1">
                                            <th>协议编号</th>
                                            <th>所属用户</th>
                                            <th>手机号码</th>
                                            <th>开始日期</th>
                                            <th>结束日期</th>
                                            <th>协议内容</th>
                                            <th>签署状态</th>
                                            
                                             <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($agreelist as $key => $value) {
                                            # code...
                                        
                                        ?>
                                        <tr>
                                            <td><?php echo $value->code?></td>
                                            <td><?php echo $value->userid?></td>
                                             <td><?php echo $value->mobile?></td>
                                            <td><?php echo date('Y-m-d',$value->startday)?></td>
                                            <td><?php echo date('Y-m-d',$value->endday)?></td>
                                            <td>
                                             <a href="<?php echo site_url('home/agree/'.$value->id)?>">协议内容</a>
                                        </td>
                                          <td>
                                              <?php 
                                              switch ($value->ck) {
                                                case '0':
                                                     echo '未签署 ';
                                                      break;

                                                case '1':
                                                     echo '已签署 '. date('Y-m-d',$value->signtime);
                                                      break;
                                                case '2':
                                                     echo '已拒绝 '. date('Y-m-d',$value->signtime);
                                                      break;

                                                 case '3':
                                                     echo '已作废 '. date('Y-m-d',$value->canceltime);
                                                      break;
                                                  
                                                  default:
                                                      # code...
                                                      break;
                                              }
                                              
                                              
                                              ?>

                                        </td>
                                             <th>
                                                <?php  if($value->ck==0) { ?>
                                              <a href="#" data-toggle="modal" data-target="#myModal" class="delbtn" value="<?php echo $value->id?>" onclick="getid(<?php echo $value->id?>)">删除</a>
                                               <?php }?>

                                                <?php  if($value->ck==1) { ?>
                                              <a href="#" data-toggle="modal" data-target="#cancelModal" class="cancelbtn btn btn-default" value="<?php echo $value->id?>" onclick="getid(<?php echo $value->id?>)">作废</a>
                                               <?php }?>

                                                 <?php  if($value->ck==3) { ?>
                                              <a href="<?php echo site_url('home/agree_copy/'.$value->id)?>"   class="cancelbtn btn btn-default">重做一份</a>
                                               <?php }?>


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



  <!---弹出确认框-->
 <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                   确定要作废该协议么？
                </h4>
            </div>
            <input type="hidden" id="cancelid">
           
            <div class="modal-footer">
                 <button type="button" class="btn btn-danger" id="cancelok">
                    确认作废
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
         $('#cancelid').val(id);
         
    }

    $('#delok').on('click',function(){
        //alert($('#myid').val());
        window.location='<?php echo site_url("home/agree_del")?>/'+$('#myid').val();
    });


      $('#cancelok').on('click',function(){
        //alert($('#myid').val());
        window.location='<?php echo site_url("home/agree_cancel")?>/'+$('#cancelid').val();
    });
        
    </script>

</body>

</html>
