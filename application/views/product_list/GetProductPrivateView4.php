<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>我的库存</title>
    <script src="/bootadmin/vue.js"></script>
    <script src="/bootadmin/vendor/jquery/jquery.min.js"></script>
    
    <link href="/bootadmin/layer2/skin/layer.css" rel="stylesheet">
    <script src="/bootadmin/layer2/layer.js"></script>
    
    <link href="/bootadmin/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <script src="/bootadmin/admin/documentation/assets/bootstrap/js/bootstrap-tooltip.js"></script>
    
    <script src="/bootadmin/bootstrap/dist/js/bootstrap.js"></script>
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
</head>

<body>

<div id="wrapper">
       <?php echo $menu;?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">产品列表</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                     <div class="panel-heading" id="search">
                        <form action="/home/product_private_list" method="GET">
                        <div class="row">
                            <div class="col-md-1">
                                <input type="text" name="title" class="form-control" name="" placeholder="关键词"/>
                            </div>
                            <div class="col-md-1"><input type="text" class="form-control" name="pid" id="pid" value="" placeholder="货号" /></div>
                            <div class="col-md-1"><input type="text" class="form-control" name="size" id="size" value="" placeholder="规格" /></div>
                            <div class="col-md-1">
                                <select name="saletype" id="saletype" class="form-control" >
                                        <option value="">入库类别</option>
                                        <option value="回收">回收</option>
                                        <option value="寄售">寄售</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <select name="category" id="category" class="form-control">
                                    <option value="">产品类别</option>
                                    <option  v-for="arr in search.category"  v-bind:value="[arr.id]">{{arr.name}}</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <select name="storeid" id="storeid" class="form-control" >
                                    <option value="">所属仓库</option>
                                    <option  v-for="arr in search.store"  v-bind:value="[arr.id]">{{arr.name}}</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <select name="status" id="status" class="form-control">
                                  <option value="">库存状态</option>
                                  <option  v-for="arr in search.product_status"  v-bind:value="[arr.id]">{{arr.name}}</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <select name="cityid" id="cityid" class="form-control">
                                    <option value="">所在城市</option>
                                    <option  v-for="arr in search.city"  v-bind:value="[arr.id]">{{arr.name}}</option>
                                </select>
                            </div>
                            <div class="col-md-1"><input type="text" class="form-control" name="receiver"   value="" placeholder="收货人"></div>
                            <div class="col-md-1"><input type="text" class="form-control" name="owner"  value="" placeholder="客户来源" ></div>
                        </div>
                            <div class="row"><div class="col-md-12">.</div></div>
                            <div class="row">
                                <div class="col-md-2"><input type="text" class="form-control" name="startday" placeholder="开始时间：<?php  echo date("Y-m-d",strtotime("-7 day"));?>"></div>
                                 <div class="col-md-2"><input type="text" class="form-control" name="endday"  placeholder="结束时间：<?php  echo date("Y-m-d");?>"></div>
                                 <div class="col-md-1">
                                     <select name="havephoto" id="havephoto" class="form-control">
                                        <option value="">是否拍照</option>
                                         <option value="">全部</option>
                                        <option value="1">是</option>
                                        <option value="0">否</option>
                                     </select>
                                 </div>
                                 <div class="col-md-1">
                                     <select name="video" id="video" class="form-control">
                                        <option value="">是否拍视频</option>
                                         <option value="">全部</option>
                                        <option value="1">是</option>
                                        <option value="2">否</option>
                                     </select>
                                 </div>
                                 <div class="col-md-1">
                                     <select name="payment" id="payment" class="form-control">
                                     <option value="">付款方式</option>
                                     <option  v-for="arr in search.sale_payment"  v-bind:value="[arr.id]">{{arr.name}}</option>
                                  </select>
                                 </div>
                                 <div class="col-md-1">
                                     <select name="datetime_sort" id="datetime_sort" class="form-control">
                                        <option value="">按入库日期排序</option>
                                        <option value="1">从最近</option>
                                        <option value="2">从最早</option>
                                    </select>
                                 </div>
                                 <div class="col-md-1">
                                     <select name="costprice_sort" id="costprice_sort" class="form-control">
                                                <option value="">按成本价排序</option>
                                                <option value="1">从价格最高</option>
                                                <option value="2">从价格最低</option>
                                    </select>
                                 </div>
                                 <div class="col-md-1"><input type="text" class="form-control" name="bz"  value="" placeholder="备注"></div>
                                 <div class="col-md-2"><input type="submit" class="btn btn-success "  onclick="return GetData();" value="搜索"> </div>
                            </div>
                    </form>
                </div>
                 <div id="body_t">
                    <div class="alert alert-success" role="alert">
                                        查询总记录：<?php   echo $count; ?>  <a href="<?php  
                               
                                        if(strpos($_SERVER['REQUEST_URI'] ,"?") === false){
                                            echo $_SERVER['REQUEST_URI']."?download=true";
                                        } else {
                                            echo $_SERVER['REQUEST_URI']."&download=true";
                                        }
                                        
                                        
                                        ?>"  target="_blank" title="excel导出"><i class="fa fa-2x fa-download"></i></a>
                    </div>
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
                                        <td>{{arr.storedate |YmdHis}}</td>
                                        <td>{{arr.prname}}</td>
                                        <th  class="row">
                                            <div class="col-xs-4"><a v-bind:href="'/home/sale_add/'+[arr.pid]"  class="btn btn-default" v-if="arr.status < 4">转为售出</a> </div>
                                            <!--<div class="col-xs-3  col-md-offset-2"><a href="" title="编辑"><i class="fa fa-2x fa-pencil "></i></a> </div>-->
                                            <!--<div class="col-xs-3  col-md-offset-2"><a v-bind:href="'/home/product_private_edit/'+[arr.id]" title="编辑" v-if="arr.datetime > <?php echo strtotime("-1 day");?>"><i class="fa fa-2x fa-pencil "></i></a> </div>-->
                                            <div class="col-xs-3  col-md-offset-2"><a v-bind:href="'/home/product_private_edit/'+[arr.id]" title="编辑"><i class="fa fa-2x fa-pencil "></i></a> </div>
                                            <div class="col-xs-3"><a href="#"  class="tc" v-bind:value="[arr.id]" title="删除" v-bind:tabindex="[arr.pid]"><i class="fa fa-2x fa-trash-o"></i></a></div>      
                                        </th>
<!--                                        <th  class="row">
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
                
            </div>
        </div>
    </div>
        <!-- /#page-wrapper -->
</div>

        

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

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->

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
    
<script>
    function date(format, timestamp){ 
    var a, jsdate=((timestamp) ? new Date(timestamp*1000) : new Date());
    var pad = function(n, c){
        if((n = n + "").length < c){
            return new Array(++c - n.length).join("0") + n;
        } else {
            return n;
        }
    };
    var txt_weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    var txt_ordin = {1:"st", 2:"nd", 3:"rd", 21:"st", 22:"nd", 23:"rd", 31:"st"};
    var txt_months = ["", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]; 
    var f = {
        // Day
        d: function(){return pad(f.j(), 2)},
        D: function(){return f.l().substr(0,3)},
        j: function(){return jsdate.getDate()},
        l: function(){return txt_weekdays[f.w()]},
        N: function(){return f.w() + 1},
        S: function(){return txt_ordin[f.j()] ? txt_ordin[f.j()] : 'th'},
        w: function(){return jsdate.getDay()},
        z: function(){return (jsdate - new Date(jsdate.getFullYear() + "/1/1")) / 864e5 >> 0},
      
        // Week
        W: function(){
            var a = f.z(), b = 364 + f.L() - a;
            var nd2, nd = (new Date(jsdate.getFullYear() + "/1/1").getDay() || 7) - 1;
            if(b <= 2 && ((jsdate.getDay() || 7) - 1) <= 2 - b){
                return 1;
            } else{
                if(a <= 2 && nd >= 4 && a >= (6 - nd)){
                    nd2 = new Date(jsdate.getFullYear() - 1 + "/12/31");
                    return date("W", Math.round(nd2.getTime()/1000));
                } else{
                    return (1 + (nd <= 3 ? ((a + nd) / 7) : (a - (7 - nd)) / 7) >> 0);
                }
            }
        },
      
        // Month
        F: function(){return txt_months[f.n()]},
        m: function(){return pad(f.n(), 2)},
        M: function(){return f.F().substr(0,3)},
        n: function(){return jsdate.getMonth() + 1},
        t: function(){
            var n;
            if( (n = jsdate.getMonth() + 1) == 2 ){
                return 28 + f.L();
            } else{
                if( n & 1 && n < 8 || !(n & 1) && n > 7 ){
                    return 31;
                } else{
                    return 30;
                }
            }
        },
      
        // Year
        L: function(){var y = f.Y();return (!(y & 3) && (y % 1e2 || !(y % 4e2))) ? 1 : 0},
        //o not supported yet
        Y: function(){return jsdate.getFullYear()},
        y: function(){return (jsdate.getFullYear() + "").slice(2)},
      
        // Time
        a: function(){return jsdate.getHours() > 11 ? "pm" : "am"},
        A: function(){return f.a().toUpperCase()},
        B: function(){
            // peter paul koch:
            var off = (jsdate.getTimezoneOffset() + 60)*60;
            var theSeconds = (jsdate.getHours() * 3600) + (jsdate.getMinutes() * 60) + jsdate.getSeconds() + off;
            var beat = Math.floor(theSeconds/86.4);
            if (beat > 1000) beat -= 1000;
            if (beat < 0) beat += 1000;
            if ((String(beat)).length == 1) beat = "00"+beat;
            if ((String(beat)).length == 2) beat = "0"+beat;
            return beat;
        },
        g: function(){return jsdate.getHours() % 12 || 12},
        G: function(){return jsdate.getHours()},
        h: function(){return pad(f.g(), 2)},
        H: function(){return pad(jsdate.getHours(), 2)},
        i: function(){return pad(jsdate.getMinutes(), 2)},
        s: function(){return pad(jsdate.getSeconds(), 2)},
        //u not supported yet
      
        // Timezone
        //e not supported yet
        //I not supported yet
        O: function(){
            var t = pad(Math.abs(jsdate.getTimezoneOffset()/60*100), 4);
            if (jsdate.getTimezoneOffset() > 0) t = "-" + t; else t = "+" + t;
            return t;
        },
        P: function(){var O = f.O();return (O.substr(0, 3) + ":" + O.substr(3, 2))},
        //T not supported yet
        //Z not supported yet
      
        // Full Date/Time
        c: function(){return f.Y() + "-" + f.m() + "-" + f.d() + "T" + f.h() + ":" + f.i() + ":" + f.s() + f.P()},
        //r not supported yet
        U: function(){return Math.round(jsdate.getTime()/1000)}
    };
      
    return format.replace(/[\\]?([a-zA-Z])/g, function(t, s){
        if( t!=s ){
            // escaped
            ret = s;
        } else if( f[s] ){
            // a date function exists
            ret = f[s]();
        } else{
            // nothing special
            ret = s;
        }
        return ret;
    });
}

    function GetData(){
        $.get("/home/product_private_list/",$("form").serializeArray(),function(data){
            if(data){
                $("#body_t").html(data);
            }
        });
        return false;
    }
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
     new Vue({
        el:"#search",
        data:{
            search:<?php  echo $search; ?>
        }
    });

   
    </script>

</body>

</html>
