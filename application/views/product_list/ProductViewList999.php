<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>全网库存</title>
        <!--二维码-->
    <script type="text/javascript" src="/bootadmin/qrcode/jquery.min.js"></script>
    <script type="text/javascript" src="/bootadmin/qrcode/qrcode.js"></script>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<!--<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->

<!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
<!--<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">-->

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<!--<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>-->
    <script src="/bootadmin/vendor/datatables/js/jquery.js"></script>
    <!-- Bootstrap Core CSS -->
    <link href="/bootadmin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/bootadmin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="/bootadmin/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="/bootadmin/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/bootadmin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/bootadmin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo site_url('/')?>bootadmin/vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo site_url('/')?>bootadmin/vendor/bootstrap/js/bootstrap.min.js"></script>
    
    <link href="/bootadmin/bootstrap-switch-master/docs/css/highlight.css" rel="stylesheet">
    <link href="/bootadmin/bootstrap-switch-master/docs/css/bootstrap-switch.css" rel="stylesheet">
    
</head>

<body>

<div id="wrapper">
       <?php  echo $menu;?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">全网库存</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <form   action="<?php  echo site_url("home/product_list");  ?>"   method="GET">
                            <div class="row" id="search">
                                <div class="col-xs-12 col-md-2 ">
                                    <input type="text" name="title" class="form-control"  placeholder="关键字">
                                </div>
                                <div class="col-xs-12 col-md-2 ">
                                    <input type="text" name="pid" class="form-control"   placeholder="货号">
                                </div>
                                <div class="col-xs-12 col-md-2" >
                                    <select class="form-control" name="cityid"> 
                                        <option class="btn-lg" disabled   selected="selected">城市</option>
                                        <option class="btn-lg"   v-for="a in search.city" v-if="a.id =='<?php echo isset($_GET['cityid']) ? $_GET['cityid']:'';?>'"  v-bind:value="[a.id]" selected>{{a.name}}</option>
                                        <option class="btn-lg"    v-else  v-bind:value="[a.id]">{{a.name}}</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-md-2" >
                                    <select class="form-control" name="category"> 
                                        <option class="btn-lg"  disabled  selected="selected">产品类别</option>
                                        <option class="btn-lg"   v-for="a in search.category" v-if="a.id =='<?php echo isset($_GET['category']) ? $_GET['category']:'';?>'"  v-bind:value="[a.id]" selected>{{a.name}}</option>
                                        <option class="btn-lg"  v-else  v-bind:value="[a.id]">{{a.name}}</option>
                                    </select>
                                </div>
                                
                                <div class="col-xs-12 col-md-2" >
                                    <select class="form-control" name="desc">
                                        <option class="btn-lg" disabled  selected="selected">价格排序</option>
                                        
                                    <?php
                                        if(isset($_GET['desc'])){
                                            if($_GET['desc'] == 1)  {
                                                echo '<option class="btn-lg" value="1" selected>从价格最高</option><option class="btn-lg" value="2">从价格最低</option>';
                                            }else{
                                                echo '<option class="btn-lg" value="1">从价格最高</option><option class="btn-lg" value="2" selected>从价格最低</option>';
                                            }
                                        }else{
                                            echo '<option class="btn-lg" value="1">从价格最高</option><option class="btn-lg" value="2" >从价格最低</option>';
                                        }
                                    ?>
                                        
                                    </select>
                                </div>
                                <div class="col-xs-12 col-md-2">
                                    <input type="submit" class="btn btn-success "  value="搜索" > </input>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="col-md-3 ">查询总记录:<?php echo $count;?> <a href="<?php  
                               
                                        if(strpos($_SERVER['REQUEST_URI'] ,"?") === false){
                                            echo $_SERVER['REQUEST_URI']."?download=true";
                                        } else {
                                            echo $_SERVER['REQUEST_URI']."&download=true";
                                        }
                                        
                                        
                                        ?>"  target="_blank" title="导出EXCEL格式"> <i class="fa fa-2x fa-download"></i></a></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>商品编号</th>
                                        <th>产品名称</th>
                                        <th>图片</th>
                                        <th>产品类别</th>
                                        <th>销售价</th> 
                                        <th>代理价</th>
                                        <th>地点</th>
                                        <th>查看详情</th>
                                    </tr>
                                </thead>
                                <tbody id="body">
                                    <tr v-for="k in body">
                                        <td v-for="(va,key) in k">
                                            <button class="btn btn-outline btn-success" v-bind:value="[va]" v-if="key === 'id'" data-toggle="modal" data-target="#myModal">查看</button>
                                            <i  v-if="key === 'id'"  class="fa fa-2x fa-qrcode col-md-offset-4"></i>
                                            
                                            <input type="hidden" v-bind:id="'code'+[va]" v-bind:value="'<?php  echo site_url("Share/GetData")  ;?>?pid='+[va]"  v-if="key === 'id'" />
                                            <div v-else-if="key === 'facephoto'" class="imglist">
                                                    <img v-bind:src="[va]" height="50" width="50">
                                                    <div style="position:absolute;margin-top:-150px;height:400px;width:400px;z-index:999;float:left;display:none;"> 
                                                        <a v-bind:href="[va]"  target="_blank"><img v-bind:src="[va]"  height="400" width="400" class="imgborder" ></a> 
                                                    </div>
                                            </div>
                                            <div v-else>{{va}}</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
        echo $page;
    ?>
    </div>
  
        <!-- /#page-wrapper -->
</div>
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">
					库存详情
				</h4>
			</div>
			<div class="modal-body" id="put">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>
<!--<div id="qrcode" style="float: left; width:100px; height:100px; "></div>-->
<!--<div id="qrcode" style="float: left;  "></div>-->

<!--<div id="qrcode" style="float: right;width:100px; height:100px;line-height:100px;"></div>-->

<script>
    $(function(){
        $('.imglist').on("mouseover mouseout",function(event){
            if(event.type == "mouseover"){
                $(this).children().eq(1).show();
            }else if(event.type == "mouseout"){
                    $(this).children().eq(1).hide();
            }
        });
         $(".btn-outline").click(function(){
             $("#put").html("");
             $.get("<?php   echo site_url("home/product_edit");  ?>",{pid:$(this).val()},function(data){                   
                    $("#put").html(data);
             }); 
         });
    });

    new Vue({
        el: '#body',
        data: {
                body: <?php echo $data; ?>
        }
    })
    new Vue({
        el: '#search',
        data: {
                search: <?php echo $search; ?>
        }
    })
    </script>
    <script src="/bootadmin/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/bootadmin/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/bootadmin/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="/bootadmin/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/bootadmin/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="/bootadmin/vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/bootadmin/dist/js/sb-admin-2.js"></script>
    <script src="/bootadmin/bootstrap-switch-master/docs/js/highlight.js"></script>
    <script src="/bootadmin/bootstrap-switch-master/newjavascript.js"></script>
    <script src="/bootadmin/bootstrap-switch-master/docs/js/main.js"></script>

<div id="qrcode" style="width:100px; height:100px;z-index:200;position: fixed;top: 54%;left:85%;"></div>

<script type="text/javascript">
var qrcode = new QRCode(document.getElementById("qrcode"), {
	width : 150,
	height : 150
});
function makeCode (id) {		
	var elText = document.getElementById(id);
	
	if (!elText.value) {
		alert("Input a text");
		elText.focus();
		return;
	}
	qrcode.makeCode(elText.value);
}
$(".fa-qrcode").mouseover(function(){
    makeCode($(this).nextAll("input").attr("id"));
    $("#qrcode").show();
}).mouseout(function(){
    $("#qrcode").hide();
});
</script>

</body>

</html>
