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
                    <?php if($search['checktime']=='today'){?>
                    <h1 class="page-header">今日需要结款订单</h1>
                    <?php }else{
                            switch ($search['saletype']) {
                                case '4':
                                    $titlestr='售出订单';
                                    break;

                                    case '5':
                                    $titlestr='售出未确认';
                                    break;
                                
                                default:
                                    $titlestr='全部订单';
                                    break;
                            }
                        ?>
                    <h1 class="page-header"><?php echo $titlestr?></h1>
                    <?php }?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
      


            <!-- /.row -->
             <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="<?php echo site_url('home/sale_list')?>">全部销售列表 </a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                             <div class="form-group input-group col-lg-12  ">
                               
                                    <p><input type="text" class="form-control" name="title" id="title" value="<?php echo $search['title']?>" placeholder="关键词" style="width:100px;">
                                    <input type="text" class="form-control" name="pid" id="pid" value="<?php echo $search['pid']?>" placeholder="货号" style="width:100px;">
                                    <input type="text" class="form-control" name="receiver" id="receiver" value="<?php echo $search['receiver']?>" placeholder="收货人" style="width:100px;">
                            
                            <select name="saleman" id="saleman" class="form-control" style="width:120px;">
                                     <option value="">销售员</option>
                                     <?php 
                                    foreach ($saleman as $key => $value) {
                                     
                                      if($search['saleman']==$value['name']){
                                          echo '<option value="'.$value['name'].'" selected>'.$value['name'].'</option>';
                                      }else{
                                          echo '<option value="'.$value['name'].'">'.$value['name'].'</option>';
                                      }
                                       
                                    }
                                  ?> 
                                  </select> 

                                    <input type="text" class="form-control" name="cid" id="cid" value="<?php echo $search['cid']?>" placeholder="客户编号" style="width:100px;">
                                     <select name="saletype" id="saletype" class="form-control" style="width:120px;">
                                        <option value="">全部状态</option>
                                        <?php 
                                    foreach ($status as $key => $value) {
                                     
                                      if($search['saletype']==$value['name']){
                                          echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
                                      }else{
                                          echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                      }
                                       
                                    }
                                  ?> 
                                     </select> 
                                    <select name="saleplatform" id="saleplatform" class="form-control" style="width:120px;">
                                     
                                    <option value="">全部平台</option>
                                     <?php 
                                    foreach ($platform as $key => $value) {
                                     
                                      if($search['saleplatform']==$value['id']){
                                          echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
                                      }else{
                                          echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                      }
                                       
                                    }
                                  ?> 
                                  </select> 

                                         <select class="form-control" name="agentid" id="agentid" style="width:120px;">
                                        <option value="">代理商</option>
                             <?php 
                                        foreach ($agent as $key => $value) {
                                          if($search['agentid']==$value['id'])
                                          {
                                             echo '<option value="'.$value['id'].'" selected>'.$value['fullname'].'</option>';
                                           }else
                                           {
                                             echo '<option value="'.$value['id'].'">'.$value['fullname'].'</option>';
                                           }
                                         

                                        }
                              ?> 
                        </select>
                                   </div>
    <div class="form-group input-group col-lg-12  form-inline">

           <select name="payment" id="payment" class="form-control" style="width:120px;">
                                     <option value="">付款方式</option>
                                     <?php 
                                    foreach ($payment as $key => $value) {
                                     
                                      if($search['payment']==$value['id']){
                                          echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
                                      }else{
                                          echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                      }
                                       
                                    }
                                  ?> 
                                  </select> 

   <select name="ispayback" id="ispayback" class="form-control" style="width:120px;">
                                     <option value="">结款状态</option>
                                     <option value="0" <?php if($search['ispayback']=='0'){echo 'selected';}?>>未结款</option>
                                     <option value="1" <?php if($search['ispayback']=='1'){echo 'selected';}?>>已结款</option>
                                      
                                    
                                  </select> 

    <input type="text" class="form-control" name="startday" id="startday" value="<?php echo $search['startday']?>" placeholder="开始日期 如：<?php echo date('Y-m-d',time())?>" style="width:200px;">
    <input type="text" class="form-control" name="endday" id="endday" value="<?php echo $search['endday']?>" placeholder="结束日期 如：<?php echo date('Y-m-d',time())?>" style="width:200px;">
         
            <button class="btn btn-success " type="button" id="searchbtn">搜索 </button>
                                      
                            </div>

<div class="alert alert-success" role="alert">
    查询总记录：<?php echo $count?>  <a href="<?php echo site_url('export/sale').'?id>0'.$searchstr?>" target="_blank">导出EXCEL格式</a>
</div>



                            <div class="table-responsive">
                                <table class="table  table-bordered table-hover">
                                    <thead>
                                        <tr style="background:#f1f1f1">
                                            <th>ID</th>
                                            <th>产品货号</th>
                                            <th>产品名称</th>
                                             <th>产品图片</th>
                                            <th>状态</th>
                                            <th>售价</th>
                                            <th>成本价</th>
                                            <th>定金</th>
                                            <th>销售员</th>
                                            <th>平台</th>
                                            <th>付款</th>

                                            <th>利润</th>
                                           <th>日期</th>
                                           
                                             <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 

                                        foreach ($salelist as $key => $value) {

                                        ?>
                                        <tr>
                                            <td><?php echo $value->id?></td>
                                            <td><?php echo $value->pid?></td>
                                            <td><?php echo $value->title?></td>
                                             <td class="imglist" id="<?php echo $value->id;?>">

                                              <a href="<?php echo $value->facephoto?>" target="_blank"><img src="<?php echo $value->facephoto?>" width="80" height="80"></a>


                                             <div style="position:absolute;margin-top:-150px;height:400px;width:400px;z-index:999;float:left;display:none;" id="imgdiv<?php echo $value->id;?>"> <img src="<?php echo site_url('/').$value->facephoto?>" height="400" width="400" class="imgborder" ></div>
                                      

                                      </td>
                                            <td><?php echo $value->saletype?></td>
                                            <td><?php echo $value->price?></td>
                                            <td><?php echo $value->costprice?></td>
                                            <td><?php echo $value->preprice?></td>
                                            <td><?php echo $value->saleman?></td>
                                            <td><?php echo $value->platformname?></td>
                                            <td><?php echo $value->payment?></td>
                                            <td>￥<?php echo $value->siteprofit?></td>
                                            
                                            <td>
                                            <?php echo date('Y-m-d',$value->saletime);?>
                                        </td>
                                             <th>
                                             <?php 
                                             if($value->ispayback==0)
                                            {
                                                echo '<a data-toggle="modal" data-target="#payback" class="paybackbtn" value="'.$value->id.'" onclick="getid('.$value->id.')">未结款</a>';
                                            }else
                                            {
                                                echo "已结款";
                                            }
                                             ?>


                                                <a href="<?php echo site_url('home/sale_edit/'.$value->id)?>">编辑</a> 
                                                &nbsp;&nbsp;<a href="http://www.baidu.com" data-toggle="modal" data-target="#myModal" class="delbtn" value="<?php echo $value->id?>" onclick="getid(<?php echo $value->id?>)">删除</a></th>
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
 <div class="modal fade" id="payback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                  请确定该笔订单已返点完毕？
                </h4>
            </div>
            <input type="hidden" id="saleid">
           
            <div class="modal-footer">
                 <button type="button" class="btn btn-danger" id="payok">
                    确认完成
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
         $('#saleid').val(id);
    }

    $('#delok').on('click',function(){
        //alert($('#myid').val());
        window.location='<?php echo site_url("home/sale_del")?>/'+$('#myid').val();
    });


     $('#payok').on('click',function(){
        //alert($('#myid').val());
        window.location='<?php echo site_url("home/sale_set_payback")?>/'+$('#saleid').val();
    });
        
       $('#searchbtn').on('click',function(){
        title=$('#title').val();
        pid=$('#pid').val();
        cid=$('#cid').val();
        saleman=$('#saleman').val();
        receiver=$('#receiver').val();
        saletype=$('#saletype').val();
        saleplatform=$('#saleplatform').val();
        agentid=$('#agentid').val();
        payment=$('#payment').val();
        startday=$('#startday').val();
        endday=$('#endday').val();
         ispayback=$('#ispayback').val();

        query='?';
        query=query+'title='+title;
        query=query+'&pid='+pid;
        query=query+'&cid='+cid;
        query=query+'&saleman='+saleman;
        query=query+'&receiver='+receiver;
        query=query+'&saletype='+saletype;
        query=query+'&saleplatform='+saleplatform;
        query=query+'&startday='+startday;
        query=query+'&endday='+endday;
        query=query+'&agentid='+agentid;
        query=query+'&payment='+payment;
        query=query+'&ispayback='+ispayback;


        window.location='<?php echo site_url("home/sale_list/1")?>/'+query;
       // alert($('#wd').val());
    });  


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
    </script>

</body>

</html>
