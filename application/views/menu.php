
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
                menu: <?php echo json_encode($menu); ?>
        }
    })
</script>
