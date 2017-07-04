<div class="panel-body" id="showone">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <tbody id="body">
                <tr>
                    <td> 产品名称 </td>
                    <td> {{v.title}} </td>
                </tr>
                <tr>
                    <td> 产品货号 </td>
                    <td> {{v.pid}} </td>
                </tr>
                <tr>
                    <td> 产品类别 </td>
                    <td> {{v.saletype}} </td>
                </tr>
                <tr>
                    <td> 规格 </td>
                    <td> {{v.size}} </td>
                </tr>
                <tr>
                    <td> 产品类型 </td>
                    <td> {{v.caname}} </td>
                </tr>
                <tr>
                    <td> 入库类型 </td>
                    <td> {{v.saletype}} </td>
                </tr>
                <tr>
                    <td> 销售价 </td>
                    <td> {{v.saleprice}} </td>
                </tr>
                <tr>
                    <td> 代理价 </td>
                    <td> {{v.rivalprice}} </td>
                </tr>
                <tr>
                    <td> 保留价 </td>
                    <td> {{v.holdprice}} </td>
                </tr>
                <tr>
                    <td> 其他费用 </td>
                    <td> {{v.otherfee}} </td>
                </tr>
                <tr>
                    <td> 库存状态 </td>
                    <td> {{v.prname}} </td>
                </tr>
                <tr>
                    <td> 备注 </td>
                    <td> {{v.content}} </td>
                </tr>
                <tr>
                    <td> 封面照片 </td>
                    <td> <img v-bind:src="[v.facephoto]" style="width: 140px; height: 140px;"  /> </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script>

new Vue({
        el: '#showone',
        data: {
                v: <?php echo $data; ?>
        }
    })

</script>