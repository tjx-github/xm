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
                    <h1 class="page-header">编辑产品</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
      


            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           编辑产品
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" id="addform" method="post" action="<?php echo site_url('home/product_edit_save')?>">
                                        <input type="hidden" name="id" value="<?php echo $product['id']?>">
                                          <div class="form-group form-inline" id="codediv">
                                            <label>产品名称：</label>
                                            <input class="form-control" style="width:300px;" name="title"  id="title" value="<?php echo $product['title']?>" placeholder="输入产品名称">
                                        </div>

                                        <div class="form-group form-inline" id="piddiv">
                                            <label>产品货号：</label>
                                            <input class="form-control" name="pid" id="pid" value="<?php echo $product['pid']?>" disabled placeholder="请输入货号">
                                             
                                        </div>
                                      
                                      
                               <div class="form-group form-inline" id="codediv">
                                        <label>规格款式：</label>
                                        <input class="form-control" name="size"  id="size"   value="<?php echo $product['size']?>" placeholder="规格款式">
                       </div>   
 
                                    
                                 <div class="form-group form-inline">
                                   <label>产品类别：</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">选择类别</option>
                                  <?php 
                                    foreach ($category as $key => $value) {

                                      if($product['category']==$value['id']){
                                          echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
                                      }else{
                                          echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                      }
                                      

                                    }
                                  ?> 
                                  </select>

                                 </div>


                    <div class="form-group form-inline">
                                <label>入库类别：</label>
                                <select name="saletype" id="saletype" class="form-control">
                                    <option value="">选择类别</option>
                                    <option value="回收" <?php if($product['saletype']=='回收'){echo 'selected';}?>>回收</option>
                                    <option value="寄售" <?php if($product['saletype']=='寄售'){echo 'selected';}?>>寄售</option>  
                                  </select>
                    </div>


                    <div class="form-group form-inline">
                                <label>所属仓库：</label>
                                  <select name="storeid" id="storeid" class="form-control">
                                    <option value="">选择仓库</option>
                                  <?php 
                                    foreach ($store as $key => $value) {

                                      if($product['storeid']==$value['id']){
                                          echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
                                      }else{
                                          echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                      }
                                      

                                    }
                                  ?> 
                                  </select>
                    </div>


                    <div class="form-group form-inline" id="piddiv">
                        <label>成本价：</label>
                        <input class="form-control" name="costprice" id="costprice" value="<?php echo $product['costprice']?>" placeholder="请输入成本价">
                    </div>

                     <div class="form-group form-inline" id="piddiv">
                        <label>销售价：</label>
                        <input class="form-control" name="saleprice" id="saleprice"  value="<?php echo $product['saleprice']?>"  placeholder="请输入销售价">
                    </div>

                     <div class="form-group form-inline" id="piddiv">
                        <label>同行价：</label>
                        <input class="form-control" name="rivalprice" id="rivalprice"  value="<?php echo $product['rivalprice']?>"  placeholder="请输入同行价">
                    </div>

                     <div class="form-group form-inline" id="piddiv">
                        <label>保留价：</label>
                        <input class="form-control" name="holdprice" id="holdprice"  value="<?php echo $product['holdprice']?>"  placeholder="请输入保留价">
                    </div>

                    <div class="form-group form-inline" id="piddiv">
                        <label>其他费用：</label>
                        <input class="form-control" name="otherfee" id="otherfee" value="<?php echo $product['otherfee']?>"  placeholder="其他费用">
                    </div>
               

                       <div class="form-group form-inline">
                                <label>库存状态：</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">选择状态</option>
                                  <?php 
                                    foreach ($status as $key => $value) {

                                      if($product['status']==$value['id']){
                                          echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
                                      }else{
                                          echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                      }
                                      

                                    }
                                  ?> 
                                  </select>
                    </div>


                      <div class="form-group form-inline">
                                <label>所属城市：</label>
                               <select name="cityid" id="cityid" class="form-control">
                                    <option value="">选择城市</option>
                                  <?php 
                                    foreach ($city as $key => $value) {

                                      if($product['cityid']==$value['id']){
                                          echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
                                      }else{
                                          echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                      }
                                      

                                    }
                                  ?> 
                                  </select>
                    </div>


                    <div class="form-group form-inline">
                                <label>代理商ID：</label>
                                <input type="text" name="agentid" id="agentid" value="<?php echo $product['agentid']?>"> 
                                <input type="text" name="agentsearch" id="agentsearch" placeholder="搜索名字" value="<?php echo $product['agentname']?>" autocomplete="off" > 
                                <div style="position:absolute;border:1px solid #000;margin-left:230px;margin-top:0px;height:auto;width:150px;z-index:999;float:left;display:none;background:#fff;list-style:none" id="suggestdiv" ></div>
                                
                    </div>


                     <div class="form-group form-inline">
                     <label>收 货 人：</label>
                      <input class="form-control" name="receiver" id="receiver"  placeholder="收货人" value="<?php echo $product['receiver']?>">
                         
                      </div>

                      <div class="form-group form-inline" id="piddiv">
                        <label>来源客户：</label>
                        <input class="form-control" name="owner" id="owner" value="<?php echo $product['owner']?>"  placeholder="来源客户">
                    </div>

                           <div class="form-group form-inline">
                                   <label>付款方式：</label>
                                <select name="payment" id="payment" class="form-control">
                                    <option value="">付款方式：</option>
                                     <?php 
                                      foreach ($payment as $key => $value) {
                                       if($product['payment']==$value['id'])
                                          {
                                             echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
                                           }else
                                           {
                                             echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                           }
                                    }
                                    ?>
                                  </select>
                                 </div>

                                

                     <div class="form-group form-inline" id="codediv">
                                        <label>入库时间：</label>
                                        <input class="form-control" name="storedate"  id="storedate" value="<?php echo date('Y-m-d',$product['storedate'])?>" placeholder="款式">
                       </div>      
 
              <div class="form-group form-inline" id="codediv">
                                    <label>是否拍照</label>
                                   <input type="checkbox" name="havephoto" value="1" <?php if($product['havephoto']=='1'){echo 'checked';}?>>
                       </div> 

               <div class="form-group" id="codediv">
                                        <label>备注信息：</label>
                                       <textarea class="form-control" name="content" id="content" rows="3"><?php echo $product['content']?></textarea>
                       </div>



    <div class="form-group form-inline" id="codediv">
                                    <label>封面照片</label>
                                    <img src="<?php echo $product['facephoto']?>" id="myimg" height="120" width="120"  ><br>
                                    <input type="file" name="pic" id="pic" multiple="multiple" />
                                    <input type="hidden" id="facephoto" name="facephoto" >
          </div>  



    
     <div class="form-group" id="photosdiv">
       <label>产品图片：</label>
       <div >
 <?php 
 if(strlen($product['photos'])>5){
                                             $picarr=json_decode($product['photos']);
                                            if(is_array($picarr))
                                            {
                                             foreach ($picarr as $key => $v) {
                                                  echo '<a href="'.site_url('/').$v .'" target="_blank"><img src="'.site_url('/').$v .'" height="200" width="200" class="imgborder"></a>&nbsp;';
                                             }
                                           }
                                           }

                                            ?>
                                          </div>
    </div>  

 
 <div class="form-group" id="updiv">
        <label>更换图片（如果新上传图片，会覆盖以前的）</label>                                     
<div id="uploader" class="wu-example">
    <div class="queueList">
        <div id="dndArea" class="placeholder">
            <div id="filePicker"></div>
            <p>或将照片拖到这里，单次最多可选26张</p>
        </div>
    </div>
  
<div id="piclist"></div>

</div>


                         </div>



                                     <button type="button" class="btn btn-success" id="gobtn">提交</button>
                                         
                                    </form>
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
   
      <script type="text/javascript" src="<?php echo site_url('/')?>/static/baidufex/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url('/')?>/static/baidufex/js/global.js"></script>
    <script type="text/javascript" src="<?php echo site_url('/')?>/static/baidufex/js/webuploader.js"></script>
    <script type="text/javascript" src="<?php echo site_url('/')?>/static/baidufex/js/demo.js"></script>
 




    <script type="text/javascript">
 


    $(function(){
 ////////////////

        // AJAX 读取品牌列表
    $('#category').on('change',function(){
      
        var catid=$('#category').val();

       $.getJSON('/api/brandlist/'+catid, function(data){
           
          //var tname='<select id="brand" name="brand"><option value="">选择品牌</option>';
          var tname='<option value="">选择品牌</option>';

           for(var key in data){
            var str=' ';
            str='<option value="'+data[key]['id']+'">'+data[key]['brandname']+'</option>';
            tname=tname+str;
           }
           tname=tname+'<option value="其他">其他</option>';
           //tname=tname+'</select>';
           
            $('#brand').html(tname);
       });
      
      });
    


// 如果品牌选择了其他
  
  /*
    $('#brand').on('change',function(){
      
        str=$('#brand').val();
        
        if(str=='其他')
        {
           $('#otherdiv').css('display','block');
         }else
         {
           $('#otherdiv').css('display','none');
         }
        

    });

*/
/////////////



 $('#gobtn').on('click',function(){
    var $piclist=$('#piclist');
    var inputstr='';
    $("#uploader img").each(function(i){
               //alert("no:"+"  src:"+$(this).attr("src"));
               inputstr=inputstr+'<input name="img[]" type="hidden" value="'+$(this).attr("src")+'">';
               
         }); 
    $piclist.html(inputstr);
   


     if($('#title').val()=='')
      {
          $('#title').focus();
          return false;
      }
 
     if($('#pid').val()=='')
      {
          $('#pid').focus();
          return false;
      }

    

      if($('#category').val()=='')
      {
          $('#category').focus();
          return false;
      }

    

       if($('#status').val()=='')
      {
          $('#status').focus();
          return false;
      }


        if($('#cityid').val()=='')
      {
          $('#cityid').focus();
          return false;
      }

    
      
      $('#addform').submit();


 });




$('#agentsearch').keyup(function(){
  $("#suggestdiv").show();
  sendwords();
});
 
 

$('#agentsearch').focus(function(){
    if($('#agentsearch').val()!='')
    {
      $("#suggestdiv").show();

      sendwords();
    }
});




function sendwords(){
  $.get('<?php echo site_url('/')?>/home/searchagent/'+$('#agentsearch').val(), function(result){
    $("#suggestdiv").html(result);
    
    
    //alert(result);
  });
}

function clickagent(id){
  //alert(id);
  alert('ok');
  //$("#agentid").val(id);
}

$('.agentlist').on('click',function(){
  //id=this.id;
  //$("#agentid").val(id);
 alert('okokokok');
});




/*更换图片*/
$('#changeimgbtn').on('click',function(){
  $('#photosdiv').hide();
  $('#updiv').show();

});


$('#showimgbtn').on('click',function(){
  $('#updiv').hide();
  $('#photosdiv').show();
  

});

//////
    });


function clickagent(id,title){
  $("#agentid").val(id);
  $("#agentsearch").val(title);
  $("#suggestdiv").hide();

}

function closesuggest(){
   $("#agentsearch").val('');
  $("#suggestdiv").hide();
}




$("#pic").change(function () {  
            run(this, function (data) {  
                $('#myimg').attr('src', data);  
                 $('#myimg').show();
                 $('#facephoto').val(data);  
            });  
        }); 

 
        function run(input_file, get_data) {  
            /*input_file：文件按钮对象*/  
            /*get_data: 转换成功后执行的方法*/  
            if (typeof (FileReader) === 'undefined') {  
                alert("抱歉，你的浏览器不支持 FileReader，不能将图片转换为Base64，请使用现代浏览器操作！");  
            } else {  
                try {  
                    /*图片转Base64 核心代码*/  
                    var file = input_file.files[0];  
                    //这里我们判断下类型如果不是图片就返回 去掉就可以上传任意文件  
                    if (!/image\/\w+/.test(file.type)) {  
                        alert("请确保文件为图像类型");  
                        return false;  
                    }  
                    var reader = new FileReader();  
                    reader.onload = function () {  
                        get_data(this.result);  
                    }  
                    reader.readAsDataURL(file);  
                } catch (e) {  
                    alert('图片转Base64出错啦！' + e.toString())  
                }  
            }  
        } 
    </script>

</body>

</html>
