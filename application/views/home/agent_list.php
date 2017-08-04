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

    <link href="<?php echo site_url('/')?>static/css/bearadmin.css" rel="stylesheet">


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
                    <h1 class="page-header">合作伙伴列表</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
      


            <!-- /.row -->
             <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           代理商列表
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                          <div class="form-group input-group col-lg-12  ">
                              <form>
                              <p><div class="col-md-1"><input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo $search['fullname']?>" placeholder="姓名" style="width:100px;"></div>
                                <div class="col-md-1"><input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $search['mobile']?>" placeholder="手机号" style="width:100px;"></div> 
                                     
                                   <div class="col-md-2">
                                       <select name="roleid" class="form-control">
                                           <option value="">用户类型</option> 
                                           <option value="3">代理商</option>
                                           <option value="4">合作商</option>
                                           <option value="6">加盟商</option>
                                       </select>
                                   </div>
                                  
                <button class="btn btn-success " type="button" id="searchbtn">搜索 </button>
                </form>
            </div>

 
   <div class="table-responsive">
                                <table class="table  table-bordered table-hover">
                                    <thead>
                                        <tr style="background:#f1f1f1">
                                            <th>ID</th>
                                            <th>姓名</th>
                                             <th>用户名</th>
                                             <th>用户类别</th>
                                            <th>性别</th>
                                            <th>头像</th>
                                            <th>手机号</th>
                                            <th>省份</th>
                                            <th>城市</th>
                                             <th>返点比率</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($userlist as $key => $value) {
                                            # code...
                                        
                                        ?>
                                        <tr >
                                            <td><?php echo $value->id?></td>
                                           
                                            <td><?php echo $value->fullname?></td>
                                             <td><?php echo $value->username?></td>
                                             <td><?php 
                                                 switch ($value->roleid){
                                                    case 3:
                                                        echo "代理商";
                                                        break;
                                                    case 4:
                                                        echo "合作商";
                                                        break;
                                                    case 6:
                                                        echo "加盟商";
                                                        break;
                                                    default :
                                                        echo "未知";
                                                 }
                                             
                                             ?></td>
                                              <td><?php echo $value->sex?></td>
                                              <td><img src="<?php echo $value->facepic?>" width="50" height="50"></td>
                                               <td><?php echo $value->mobile?></td>
                                                <td><?php echo $value->province?></td>
                                                <td><?php echo $value->city?></td>
                                                <td><input type="text" class="agentid" value="<?php echo $value->fee?>" id="agent<?php echo $value->id?>" style="width:50px">%</td>
                                                 
                                              
                                            
                                             <th>
                                                 <a href="<?php echo site_url('home/resetuserpass/'.$value->id)?>">重置密码</a> </th>
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
        window.location='<?php echo site_url("home/agent_del")?>/'+$('#myid').val();
    });
        

//    $('#searchbtn').on('click',function(){
//        wd=$('#wd').val();
//        window.location='<?php echo site_url("home/agent_list/1")?>/'+wd;
//       // alert($('#wd').val());
//    });  

   $('.imglist').on("mouseover mouseout",function(event){
 if(event.type == "mouseover"){
    ID=this.id;
  //alert(ID);
  $('#imgdiv'+ID).show();
 }else if(event.type == "mouseout"){
  //鼠标离开
    $('#imgdiv'+ID).hide();
 }
});


$('.agentid').on('blur',function(){
    //alert(this.id);
    id=this.id;
    value=this.value;
    userid=id.replace('agent','');
     $.post('/home/agent_fee_save', { userid:userid,fee:value}, function(response){
        //alert(response);
        if(response=='OK')
        {
            alert('该代理商的返点率已经改为'+value+'%');
        }
     });
});


 $('#searchbtn').on('click',function(){
//        fullname=$('#fullname').val();
//        
//        mobile=$('#mobile').val();
//         
//        query='?';
//        query=query+'fullname='+fullname;
//       
//        query=query+'&mobile='+mobile;



        window.location='<?php echo site_url("home/agent_list/1")?>/?'+$("form").serialize();
       // alert($('#wd').val());
    });  

    </script>

</body>

</html>
