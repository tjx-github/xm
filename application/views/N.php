 <script src="https://unpkg.com/vue/dist/vue.js"></script>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
         <a class="navbar-brand" href="http://admin.zhengpin.com/">优正品管理系统</a>
    </div>
    <div class="navbar-default sidebar" role="navigation" id="app-menu">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li v-for="(arr ,key) in menu">
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> {{key}}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li v-for="value in arr">
                            <a v-bind:href="['/'+value.MenuController]">{{value.MenuName}}</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    new Vue({
        el: '#app-menu',
        data: {
                menu: {"\u5e93\u5b58\u7ba1\u7406":[{"AdminRoleid":"3","MenuController":"home\/product_add","TMenuName":"\u5e93\u5b58\u7ba1\u7406","MenuName":"\u6dfb\u52a0\u4ea7\u54c1"},{"AdminRoleid":"999","MenuController":"home\/product_list","TMenuName":"\u5e93\u5b58\u7ba1\u7406","MenuName":"\u5168\u7f51\u5e93\u5b58"},{"AdminRoleid":"3","MenuController":"home\/product_private_list","TMenuName":"\u5e93\u5b58\u7ba1\u7406","MenuName":"\u6211\u7684\u5e93\u5b58"}],"\u9500\u552e\u7ba1\u7406":[{"AdminRoleid":"3","MenuController":"home\/sale_list","TMenuName":"\u9500\u552e\u7ba1\u7406","MenuName":"\u5168\u90e8\u8ba2\u5355"}],"\u8f85\u52a9\u9009\u9879":[{"AdminRoleid":"999","MenuController":"home\/store_list","TMenuName":"\u8f85\u52a9\u9009\u9879","MenuName":"\u4ed3\u5e93\u7ba1\u7406"},{"AdminRoleid":"999","MenuController":"home\/sale_platform_list","TMenuName":"\u8f85\u52a9\u9009\u9879","MenuName":"\u9500\u552e\u6e20\u9053"},{"AdminRoleid":"999","MenuController":"home\/sale_payment_list","TMenuName":"\u8f85\u52a9\u9009\u9879","MenuName":"\u4ed8\u6b3e\u65b9\u5f0f"}],"\u767b\u9646\u7ba1\u7406":[{"AdminRoleid":"999","MenuController":"home\/set_my_pass","TMenuName":"\u767b\u9646\u7ba1\u7406","MenuName":"\u4fee\u6539\u6211\u7684\u5bc6\u7801"},{"AdminRoleid":"999","MenuController":"user\/logout","TMenuName":"\u767b\u9646\u7ba1\u7406","MenuName":"\u9000\u51fa"}]}        }
    })
</script>
