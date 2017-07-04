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
                    <h1 class="page-header">产品列表</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
      


            <!-- /.row -->
             <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            产品列表 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                          <div class="form-group input-group col-lg-12  ">
                               
                                    <p><input type="text" class="form-control" name="title" id="title" value="<?php echo $search['title']?>" placeholder="关键词" style="width:100px;">
                                    <input type="text" class="form-control" name="pid" id="pid" value="<?php echo $search['pid']?>" placeholder="货号" style="width:100px;">
                                          <input type="text" class="form-control" name="size" id="size" value="<?php echo $search['size']?>" placeholder="配件" style="width:100px;">
 
  
                                        <select name="saletype" id="saletype" class="form-control" style="width:120px;">
                                        <option value="">入库类别</option>
                                        <option value="回收" <?php if($search['saletype']=='回收'){echo 'selected';} ?>>回收</option>
                                        <option value="寄售" <?php if($search['saletype']=='寄售'){echo 'selected';} ?>>寄售</option>
                                     </select> 

                                   <select name="category" id="category"  class="form-control" style="width:120px;">
                                    <option value="">产品类别</option>
                                  <?php 
                                    foreach ($category as $key => $value) {

                                      if($search['category']==$value['id']){
                                          echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
                                      }else{
                                          echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                      }
                                      

                                    }
                                  ?> 
                                  </select>


                                   <select name="storeid" id="storeid" class="form-control" style="width:120px;">
                                    <option value="">所属仓库</option>
                                  <?php 
                                    foreach ($store as $key => $value) {

                                      if($search['storeid']==$value['id']){
                                          echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
                                      }else{
                                          echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                      }
                                      

                                    }
                                  ?> 
                                  </select>

                                  <select name="status" id="status" class="form-control" style="width:120px;">
                                  <option value="">库存状态</option>
                                  <?php 
                                    foreach ($status as $key => $value) {

                                      if($search['status']==$value['id']){
                                          echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
                                      }else{
                                          echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                      }
                                      

                                    }
                                  ?> 
                                  </select>


                                   <select name="cityid" id="cityid" class="form-control" style="width:120px;">
                                    <option value="">所在城市</option>
                                  <?php 
                                    foreach ($city as $key => $value) {

                                      if($search['cityid']==$value['id']){
                                          echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
                                      }else{
                                          echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                      }
                                      

                                    }
                                  ?> 
                                  </select>

                                     </div>

                                    <div class="form-group input-group col-lg-12  ">

 <input type="text" class="form-control" name="receiver" id="receiver" value="<?php echo $search['receiver']?>" placeholder="收货人" style="width:100px;">

                                   
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


   <input type="text" class="form-control" name="owner" id="owner" value="<?php echo $search['owner']?>" placeholder="客户来源" style="width:100px;">
   <input type="text" class="form-control" name="startday" id="startday" value="<?php echo $search['startday']?>" placeholder="开始日期 如：<?php echo date('Y-m-d',time())?>" style="width:200px;">
   <input type="text" class="form-control" name="endday" id="endday" value="<?php echo $search['endday']?>" placeholder="结束日期 如：<?php echo date('Y-m-d',time())?>" style="width:200px;">
     

         <select name="havephoto" id="havephoto" class="form-control" style="width:120px;">
            <option value="">是否拍照</option>
             <option value="">全部</option>
            <option value="1" <?php if($search['havephoto']=='1'){echo 'selected';} ?>>是</option>
            <option value="0" <?php if($search['havephoto']=='0'){echo 'selected';} ?>>否</option>
         </select> 
         <select name="video" id="video" class="form-control" style="width:120px;">
            <option value="">是否拍视频</option>
             <option value="">全部</option>
            <option value="1" >是</option>
            <option value="2" >否</option>
         </select> 

  </div>

 <div class="form-group input-group col-lg-12  ">

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
    <!--===================-->
    <select name="datetime_sort" id="datetime_sort" class="form-control" style="width:150px;">
                <option value="">按入库日期排序</option>
                <option value="1">从最近</option>
                <option value="2">从最早</option>
    </select>
    <select name="costprice_sort" id="costprice_sort" class="form-control" style="width:150px;">
                <option value="">按成本价排序</option>
                <option value="1">从价格最高</option>
                <option value="2">从价格最低</option>
    </select>
     <!--==================-->
            <button class="btn btn-success " type="button" id="searchbtn">搜索 </button>
                                      
                            </div>

<div class="alert alert-success" role="alert">
    查询总记录：<?php echo $count?>  <a href="<?php echo site_url('export/product').'?id>0'.$searchstr?>" target="_blank">导出EXCEL格式</a>
</div>

 

                            <div class="table-responsive">
                                <table class="table  table-bordered table-hover">
                                    <thead>
                                        <tr style="background:#f1f1f1">
                                            <th>ID</th>
                                            <th>商品货号</th>
                                            <th>产品名称</th>
                                             <th>配件款式</th>
                                             <th>图片</th>
                                            <!--<th>销售类型</th>-->
                                             <th>成本价</th>
                                             <th>销售价</th>
                                            <th>所在城市</th>
                                            <th>所属仓库</th>
                                            <th>入库日期</th>
                                             <th>状态</th>
                                           
                                           
                                           
                                             <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                        foreach ($productlist as $key => $value) {
                                            # code...
                                        
                                        ?>
                                        <tr >
                                            <td><?php echo $value->id?></td>
                                            <td><?php echo $value->pid?></td>
                                            <td><?php echo $value->title?></td>
                                             <td><?php echo $value->size?></td>
                                            <td class="imglist" id="<?php echo $value->id;?>">
                                             <?php 
                                              
                                               echo '<a href="'.site_url('/').$value->facephoto .'"   target="_blank"><img src="'.site_url('/').$value->facephoto .'" height="50" width="50"></a>&nbsp;';
                                             
                                            ?>

                                            <div style="position:absolute;margin-top:-150px;height:400px;width:400px;z-index:999;float:left;display:none;" id="imgdiv<?php echo $value->id;?>"> <img src="<?php echo site_url('/').$value->facephoto?>" height="400" width="400" class="imgborder" ></div>
                                        </td>

                                            <!--<td><?php // echo $value->saletype?></td>-->
                                            <td><?php echo $value->costprice?></td>
                                            <td><?php echo $value->saleprice;?></td>
                                            <td><?php echo $value->city?></td>
                                            <td><?php echo $value->storename?></td>
                                            <td><?php echo date('Y-m-d',$value->storedate)?></td>
                                           <td><?php echo $value->statusname?></td>
                                            
                                            
                                             <th>
                                              <?php
                                              if($value->status<4){
                                              ?>
                                                <a href="<?php echo site_url('home/sale_add/'.$value->pid)?>" class="btn btn-default">转为售出</a> &nbsp;
                                                <?php }?>
                                                <a href="<?php echo site_url('home/product_edit/'.$value->id)?>">编辑</a> &nbsp;&nbsp;<a href="http://www.baidu.com" data-toggle="modal" data-target="#myModal" class="delbtn" value="<?php echo $value->id?>" onclick="getid(<?php echo $value->id?>)">删除</a></th>
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
        window.location='<?php echo site_url("home/product_del")?>/'+$('#myid').val();
    });
        

    $('#searchbtn').on('click',function(){
        wd=$('#wd').val();
        window.location='<?php echo site_url("home/product_list/1")?>/'+wd;
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



 $('#searchbtn').on('click',function(){
        title=$('#title').val();
        pid=$('#pid').val();
        saletype=$('#saletype').val();
         
        query='?';
        query=query+'title='+title;
        query=query+'&pid='+pid;
        query=query+'&saletype='+saletype;
        query=query+'&size='+$('#size').val();
        query=query+'&status='+$('#status').val();
        query=query+'&category='+$('#category').val();
        query=query+'&storeid='+$('#storeid').val();
        query=query+'&status='+$('#status').val();
        query=query+'&cityid='+$('#cityid').val();
        query=query+'&receiver='+$('#receiver').val();
        query=query+'&agentid='+$('#agentid').val();
        query=query+'&owner='+$('#owner').val();
        query=query+'&startday='+$('#startday').val();
        query=query+'&endday='+$('#endday').val();
        query=query+'&havephoto='+$('#havephoto').val();
        query=query+'&owner='+$('#owner').val();
        query=query+'&payment='+$('#payment').val();
        query += "&video=" +$("#video").val();
        
        query=query+'&datetime_sort='+$("#datetime_sort").val();
        query=query+'&costprice_sort='+$("#costprice_sort").val();

        
 
        window.location='<?php echo site_url("home/product_list/1")?>/'+query;
       // alert($('#wd').val());
    });  

    </script>

</body>

</html>