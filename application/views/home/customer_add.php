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
                    <h1 class="page-header">添加客户</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
      


            <!-- /.row -->
            <div class="row ">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           添加客户
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" id="addform" method="post" action="<?php echo site_url('home/customer_add_save')?>">
                                        
                                          <div class="form-group form-inline" id="codediv">
                                            <label>客户姓名：</label>
                                            <input class="form-control"  style="width:300px;"  name="fullname"  id="fullname" placeholder="客户姓名">
                                        </div>

                                        <div class="form-group form-inline" id="piddiv">
                                            <label>客户编号：</label>
                                            <input class="form-control" name="cid" id="cid" placeholder="输入客户编号">
                                            <div class="form-control success" style="display:none" id="checkcid">重复</div>

                                        </div>
                                      
                                      
                               <div class="form-group form-inline" id="codediv">
                                        <label>微信昵称：</label>
                                        <input class="form-control" name="weixinname"  id="weixinname"   placeholder="微信名">
                                </div> 

                                <div class="form-group form-inline" id="codediv">
                                        <label>微 信 号：</label>
                                        <input class="form-control" name="weixinid"  id="weixinid"   placeholder="微信昵称">
                                </div> 

                                <div class="form-group form-inline" id="codediv">
                                        <label>手机号码：</label>
                                        <input class="form-control" name="mobile"  id="mobile"   placeholder="手机号码">
                                </div>   
 
                <div class="form-group form-inline" id="codediv">
                                        <label>收货地址：</label>
                                        <input class="form-control" style="width:300px;"   name="address"  id="address"   placeholder="收货地址">
                                </div>   
 
                <div class="form-group form-inline" id="codediv">
                                           <label>付款账号：</label>
                                            <input class="form-control"  style="width:300px;"  name="payaccount"  id="payaccount" placeholder="付款账号">
                                        </div>
                      <div class="form-group" id="codediv">
                                           <label>个人特征：(身高，体重，尺码等信息)</label>
                                            <input class="form-control"    name="personal"  id="personal" placeholder="身高，体重，尺码等信息">
                                        </div>

              <div class="form-group" id="codediv">
                                           <label>家庭情况：</label>
                                            <input class="form-control"   name="family"  id="family" placeholder="家庭情况">
                                        </div>

                            <div class="form-group" id="codediv">
                                           <label>职业信息：</label>
                                            <input class="form-control"   name="career"  id="career" placeholder="职业信息">
                                        </div>



                         <div class="form-group" id="codediv">
                                        <label>交易信息：</label>
                                       <textarea class="form-control" name="tradeinfo" id="tradeinfo" rows="3"></textarea>
                       </div>


                  <div class="form-group" id="codediv">
                                        <label>备注信息：</label>
                                       <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                       </div>

                                  


                    <div class="form-group form-inline">
                     <label>来源渠道：</label>
                        <select class="form-group" name="channel" id="channel">
                          <option value="">来源渠道</option>
                             <?php 
                                        foreach ($saleman as $key => $value) {
                                          echo '<option value="'.$value['name'].'">'.$value['name'].'</option>';
                                        }
                              ?> 
                        </select>
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
  
 
     if($('#cid').val()=='')
      {
          $('#cid').focus();
          return false;
      }
 
      
      $('#addform').submit();


     



 });


/*  代理商搜索功能  */

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




/*检查PID是否存在*/
$('#cid').on('blur',function(){
    $('#checkcid').show();
    $.get('<?php echo site_url('/')?>/home/checkcid/'+$('#cid').val(), function(result){
    $("#checkcid").html(result);
    //alert(result);
  });
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

    </script>

</body>

</html>
