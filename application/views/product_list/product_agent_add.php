 
    <!-- Bootstrap Core CSS -->
    <link href="/bootadmin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/bootadmin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/bootadmin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/bootadmin/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/bootadmin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

   
  
    <link rel="stylesheet" type="text/css" href="/static/baidufex/css/webuploader.css">
    <link rel="stylesheet" type="text/css" href="/static/baidufex/css/demo.css">
     <!--<div class=" col-lg-12">-->
<form role="form" id="addform" method="post" action="<?php echo site_url('home/product_add_save')?>">
                                        
                                          <div class="form-group form-inline" id="codediv">
                                            <label>产品名称：</label>
                                            <input class="form-control"  style="width:300px;"  name="title"  id="title" placeholder="输入产品名称">
                                        </div>

                                        <div class="form-group form-inline" id="piddiv">
                                            <label>产品货号：</label>
                                            <input class="form-control" name="pid" id="pid" value="<?php echo $prefix;  ?>" placeholder="请输入货号">
                                            <div class="form-control success" style="display:none" id="checkpid">重复</div>

                                        </div>
                                      
                                      
                               <div class="form-group form-inline" id="codediv">
                                        <label>配件：</label>
                                        <input class="form-control" name="size"  id="size"   placeholder="配件">
                       </div>   
 
                                    
                                 <div class="form-group form-inline">
                                   <label>产品类别：</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">选择类别</option>
                                  <?php 
                                    foreach ($category as $key => $value) {
                                      echo '<option categoryvalue="'.$value['id'].'">'.$value['name'].'</option>';
                                    }
                                  ?> 
                                  </select>

                                 </div>


                    <div class="form-group form-inline">
                                <label>入库类别：</label>
                                <select name="saletype" id="saletype" class="form-control">
                                    <option value="">选择类别</option>
                                    <option value="回收">回收</option>
                                    <option value="寄售">寄售</option>  
                                  </select>
                    </div>


                    <div class="form-group form-inline">
                                <label>所属仓库：</label>
                                <select name="storeid" id="storeid" class="form-control">
                                    <option value="">选择仓库</option>
                                     <?php 
                                    foreach ($store as $key => $value) {
                                      echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                    }
                                  ?> 
                                  </select>
                    </div>


                    <div class="form-group form-inline" id="piddiv">
                        <label>成本价：</label>
                        <input class="form-control" name="costprice" id="costprice" value="0" placeholder="请输入成本价">
                    </div>

                     <div class="form-group form-inline" id="piddiv">
                        <label>销售价：</label>
                        <input class="form-control" name="saleprice" id="saleprice"  value="0"  placeholder="请输入销售价">
                    </div>

                     <div class="form-group form-inline" id="piddiv">
                        <label>代理价：</label>
                        <input class="form-control" name="rivalprice" id="rivalprice"  value="0"  placeholder="请输入代理价">
                    </div>

                     <div class="form-group form-inline" id="piddiv">
                        <label>保留价：</label>
                        <input class="form-control" name="holdprice" id="holdprice"  value="0"  placeholder="请输入保留价">
                    </div>

                    <div class="form-group form-inline" id="piddiv">
                        <label>其他费用：</label>
                        <input class="form-control" name="otherfee" id="otherfee" value="0"  placeholder="其他费用">
                    </div>
               

                       <div class="form-group form-inline">
                                <label>库存状态：</label>
                                 <select name="status" id="status" class="form-control">
                                    <option value="">选择状态</option>
                                  <?php 
                                    foreach ($status as $key => $value) {
                                      echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                    
                                      

                                    }
                                  ?> 
                                  </select>
                    </div>


                      <div class="form-group form-inline">
                                <label>所在城市：</label>
                                <select name="cityid" id="cityid" class="form-control">
                                    <option value="">选择城市</option>
                                    <?php 
                                    foreach ($city as $key => $value) {
                                      echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                    }
                                  ?> 
                                  </select>
                    </div>


                    <div class="form-group form-inline">
                                <label>代理商ID：</label>
                                <input type="text" name="agentid"  value="<?php  echo (int)$_POST['id'] ?>" readonly> 
<!--                                <input type="text" name="agentid" id="agentid"> 
                                <input type="text" name="agentsearch" id="agentsearch" placeholder="搜索名字" value="0" autocomplete="off" > 
                                <div style="position:absolute;border:1px solid #000;margin-left:220px;margin-top:0px;height:auto;width:150px;z-index:999;float:left;display:none;background:#fff;list-style:none" id="suggestdiv" ></div>-->
                                
                    </div>


                    <div class="form-group form-inline">
                     <label>收 货 人：</label>
                         <input class="form-control" name="receiver" id="receiver"  placeholder="收货人">
                      </div>
                      

                      <div class="form-group form-inline" id="piddiv">
                        <label>来源客户：</label>
                        <input class="form-control" name="owner" id="owner"  placeholder="来源客户">
                    </div>

                    
                                 <div class="form-group form-inline">
                                   <label>付款方式：</label>
                                <select name="payment" id="payment" class="form-control">
                                    <option value="">付款方式：</option>
                                     <?php 
                                      foreach ($payment as $key => $value) {
                                      echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                    }
                                    ?>
                                  </select>
                                 </div>

                             

                                

                     <div class="form-group form-inline" id="codediv">
                                    <label>入库时间</label>
                                    <input class="form-control" name="storedate"  id="storedate" value="<?php echo date('Y-m-d', time())?>" placeholder="款式">
                       </div>  

                      <div class="form-group form-inline" id="codediv">
                                    <label>是否拍照</label>
                                   <input type="checkbox" name="havephoto" value="1">
                       </div> 

    <div class="form-group " id="codediv">
                                        <label>备注信息：</label>
                                       <textarea class="form-control col-lg-5" name="content" id="content" rows="3"></textarea>
                       </div>

 

    <div class="form-group form-inline" id="codediv">
                                    <label>封面照片</label>
                                    <img src="" id="myimg" height="80" width="80" style="display:none"><br>
                                    <input type="file" name="pic" id="pic" multiple="multiple" />
                                    <input type="hidden" id="facephoto" name="facephoto" >
          </div>  



                     <div class="form-group">
                                            
<div id="uploader" class="wu-example col-lg-5">
    <div class="queueList">
        <div id="dndArea" class="placeholder">
            <div id="filePicker"></div>
            <p>或将照片拖到这里，单次最多可选26张</p>
        </div>
    </div>
  
<div id="piclist"></div>

</div>


                     </div>
    <div class="col-lg-12"> <button type="button" class="btn btn-success" id="gobtn">提交</button></div>
</form>
    <script type="text/javascript">
    // 添加全局站点信息
    var BASE_URL = '/webuploader';
    </script>
   
    <script type="text/javascript" src="/static/baidufex/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/static/baidufex/js/global.js"></script>
    <script type="text/javascript" src="/static/baidufex/js/webuploader.js"></script>
    <script type="text/javascript" src="/static/baidufex/js/demo.js"></script>
 
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


      if($('#saletype').val()=='')
      {
          $('#saletype').focus();
          return false;
      }
 

       if($('#status').val()=='')
      {
          $('#status').focus();
          return false;
      }
       if($('#storeid').val()=='')
      {
          $('#storeid').focus();
          return false;
      }


        if($('#cityid').val()=='')
      {
          $('#cityid').focus();
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
  $.get('//home/searchagent/'+$('#agentsearch').val(), function(result){
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
$('#pid').on('blur',function(){
    $('#checkpid').show();
    $.get('//home/checkpid/'+$('#pid').val(), function(result){
    $("#checkpid").html(result);
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