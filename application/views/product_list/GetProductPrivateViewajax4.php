<div class="alert alert-success" role="alert">
                    查询总记录：<?php   echo $count; ?>   <a href="<?php  
                               
                                        if(strpos($_SERVER['REQUEST_URI'] ,"?") === false){
                                            echo $_SERVER['REQUEST_URI']."?download=true";
                                        } else {
                                            echo $_SERVER['REQUEST_URI']."&download=true";
                                        }
                                        
                                        
                                        ;?>"  target="_blank" title="excel导出"><i class="fa fa-2x fa-download"></i></a>
</div>
<div id="pp"></div>
<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>商品编号</th>
                    <th>产品名称</th>
                    <th>配件款式</th>
                    <th>图片</th>
                    <th>成本价</th>
                    <th>销售价</th>
                    <th>所在城市</th>
                    <th>所属仓库</th>
                    <th>入库日期</th>
                    <th>状态</th>
                    <th class="row"> <div class="col-md-offset-4 col-xs-3"> <i class="fa fa-3x fa-gear"></i><!--操作--></div></th>
                </tr>
            </thead>
            <tbody id="body">
                <tr v-for="arr  in body">
                    <td>{{arr.id}}</td>
                    <td>{{arr.pid}}</td>
                    <td>{{arr.title}}</td>
                    <td>{{arr.size}}</td>
                    <td class="imglist" v-if="arr.facephoto">
                        <img v-bind:src="[arr.facephoto]" width="80" height="80">
                        <div style="position: absolute; margin-top: -150px; height: 400px; width: 400px; z-index: 999; float: left; display: none;">
                                 <a v-bind:href="[arr.facephoto]" target="_blank"><img v-bind:src="[arr.facephoto]" height="400" width="400" class="imgborder"></a>
                        </div>
                    </td>
                    <td class="imglist" v-else>
                        <img src="/uploads/null.jpg"  width="80" height="80" />
                    </td>
                    <td><i class="fa fa-1x fa-rmb"></i>{{arr.costprice}} </td>
                    <td><i class="fa fa-1x fa-rmb"></i>{{arr.saleprice}} </td>
                    <td>{{arr.cname}}</td>
                    <td>{{arr.stname}}</td>
                    <td>{{arr.storedate | YmdHis}}</td>
                    <td>{{arr.prname}}</td>
                    <th  class="row">
                        <div class="col-xs-4"><a v-bind:href="'/home/sale_add/'+[arr.pid]"  class="btn btn-default" v-if="arr.status < 4">转为售出</a> </div>
                       <!--<div class="col-xs-3  col-md-offset-2"><a href="" title="编辑"><i class="fa fa-2x fa-pencil "></i></a> </div>-->
                                            <!--<div class="col-xs-3  col-md-offset-2"><a v-bind:href="'/home/product_private_edit/'+[arr.id]" title="编辑" v-if="arr.datetime > <?php echo strtotime("-1 day");?>"><i class="fa fa-2x fa-pencil "></i></a> </div>-->
                                            <div class="col-xs-3  col-md-offset-2"><a v-bind:href="'/home/product_private_edit/'+[arr.id]" title="编辑" ><i class="fa fa-2x fa-pencil "></i></a> </div>
                       <div class="col-xs-3"><a href="#"  class="tc" v-bind:value="[arr.id]" title="删除" v-bind:tabindex="[arr.pid]"><i class="fa fa-2x fa-trash-o"></i></a></div>      
                   </th>
<!--                     <th  class="row">
                        <div class="col-xs-4"><a v-bind:href="'/home/sale_add/'+[arr.pid]"  class="btn btn-default">转为售出</a> </div>
                        <div class="col-xs-3  col-md-offset-2"><a v-bind:href="'/home/product_private_edit/'+[arr.id]" title="编辑"><i class="fa fa-2x fa-pencil "></i></a> </div>
                        <div class="col-xs-3"><a href="" title="删除"><i class="fa fa-2x fa-trash-o"></i></a></div>      
                        <div class="col-xs-3 col-md-offset-2"><a href="#"  class="tc" v-bind:value="[arr.id]" title="删除" v-bind:tabindex="[arr.pid]"><i class="fa fa-2x fa-trash-o"></i></a></div>      
                    </th>-->
                </tr>
            </tbody>
        </table>
    </div>  <?php echo $page; ?>
</div>
<div>
</div>


<div class="modal " id="ff" tabindex="12" role="dialog" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" >
					&times;
				</button>
				<h4 class="modal-title">
					删除操作
				</h4>
			</div>
			<div class="modal-body">
                            确定要将<i id="bianh" class="alert alert-success"></i>删除？
			</div>
			<div class="modal-footer">
                            <input type="hidden" id="myid" value="">
                            <button type="button" class="btn btn-danger" id="delok">
                                确认删除
                            </button>
				<button type="button" class="btn btn-default">取消
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>
<?php 
if(mb_strlen($data) == 2){
?>

<div class="alert alert-warning">
    <div class=" col-md-offset-5">
        <!--搜索提示：-->
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  
        <b class="text-inverse">无数据</b> 
    </div> 
</div>

<?php 
}
?>
<script>
 
	

$(function(){
    $(".tc").click(function(){
        $("#myid").val($(this).attr("value"));
 
        $("#bianh").html($(this).attr("tabindex"));
        $("#ff").show(322);
    });
    $(".btn-default").click(function(){
        $("#ff").hide(322);
    });
    $(".close").click(function(){
        $("#ff").hide(322);
    });
    $(".btn-danger").click(function(){
        window.location.href="/home/product_del/"+ $("#myid").val();
    });
    $(".pagination a").click(function(){
        $('body').prop('scrollTop','100px');
        $.get($(this).attr("href"),function(data){
            $("#body_t").html(data);
        });
        return false;
    });
    $(".imglist").mouseover(function(){
       $(this).children().eq(1).show();
    }).mouseout(function(){
        $(this).children().eq(1).hide();
    });
});
new Vue({
     el: '#body',
     data: {
       body: <?php echo $data;   ?>

     },
    filters:{
        YmdHis:function(value){
            if(value){
                return date('Y-m-d',value);
            }else{
                return "";
            }
             
        }
    }
});
</script>
