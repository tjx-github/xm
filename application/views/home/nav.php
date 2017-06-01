<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url('/')?>"><?php echo SITENAME?></a>
            </div>
            <!-- /.navbar-header -->

          

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                    
                        <li>
                            <a href="<?php echo site_url('/')?>"><i class="fa fa-dashboard fa-fw"></i> 管理面板</a>
                        </li>
                   

                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> 库存管理 <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('home/product_add')?>">添加产品</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('home/product_list')?>">产品列表</a>
                                </li>
                            </ul>
                        </li>

                             <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> 销售管理 <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('home/sale_add')?>">添加销售</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('home/sale_list')?>">全部订单</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('home/sale_list')?>?saletype=4">售出订单</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('home/sale_list')?>?saletype=5">售出未确认</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('home/sale_list')?>?saletype=4&checktime=today">今日结款</a>
                                </li>

                            </ul>
                        </li>



                    <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> 洗护管理 <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('home/care_add')?>">添加洗护订单</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('home/care_list')?>">洗护订单列表</a>
                                </li>
                            </ul>
                        </li>


<?php if($login['roleid']==5){?>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> 咨询管理 <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('home/agree_add')?>">添加协议</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('home/agree_list')?>">协议列表</a>
                                </li>
                            </ul>
                        </li>


                      

                           <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> 用户管理 <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                
                                 <li>
                                    <a href="<?php echo site_url('home/customer_add')?>">添加客户</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('home/customer_list')?>">客户列表</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('home/user_list')?>">网站用户</a>
                                </li>

                                 <li>
                                    <a href="<?php echo site_url('home/user_add')?>">添加用户</a>
                                </li>


                                 <li>
                                    <a href="<?php echo site_url('home/agent_list')?>">代理商管理</a>
                                </li>

                                 <li>
                                    <a href="<?php echo site_url('home/admin_list')?>">管理员列表</a>
                                </li>
                               
                            </ul>
                        </li>


                        

                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> 证书管理 <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('home/cert_add')?>">添加证书</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('home/cert_list')?>">证书列表</a>
                                </li>
                            </ul>
                        </li>




                              <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> 辅助选项 <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('home/category_list')?>">类别管理</a>
                                </li>

                                 <li>
                                    <a href="<?php echo site_url('home/city_list')?>">城市管理</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('home/store_list')?>">仓库设置</a>
                                </li>
                               
                               <li>
                                    <a href="<?php echo site_url('home/product_status_list')?>">库存状态</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('home/sale_platform_list')?>">销售渠道</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('home/kuaidi_company_list')?>">快递公司</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('home/sale_payment_list')?>">付款方式</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('home/saleman_list')?>">销售员列表</a>
                                </li>


                            </ul>
                        </li>

<?php } ?>

                           <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> 登录管理 <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                
                                <li>
                                    <a href="<?php echo site_url('home/set_my_pass')?>">修改我的密码</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('user/logout')?>">退出系统</a>
                                </li>
                                
                            </ul>
                        </li>
                        
                    
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>