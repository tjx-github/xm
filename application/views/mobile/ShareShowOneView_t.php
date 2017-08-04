
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <script src="/bootadmin/sosh.js"></script>
    <title>分享</title>
    <script src="<?php echo site_url('/')?>bootadmin/vendor/jquery/jquery.min.js"></script>
    <link href="<?php echo site_url('/')?>bootadmin/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <script src="<?php echo site_url('/')?>bootadmin/bootstrap/dist/js/bootstrap.js"></script>
    <script src="/bootadmin/weUI/zepto.min.js"></script>
    <!--<script src="/bootadmin/sosh.js"></script>-->
    <link rel="stylesheet" href="/bootadmin/weUI/weui.css"/>
    <link rel="stylesheet" href="/bootadmin/weUI/example.css"/>
</head>
<body ontouchstart>
    <div class="weui-toptips weui-toptips_warn js_tooltips">错误提示</div>
<div id="showone">
    <div class="weui-form-preview__bd" id="body">
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">产品名称</label>
            <span class="weui-form-preview__value"><?php  echo  $v["title"]; ?></span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">产品货号</label>
            <span class="weui-form-preview__value"><?php  echo  $v["pid"]; ?></span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">产品类别</label>
            <span class="weui-form-preview__value"><?php  echo  $v["saletype"]; ?></span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">规格</label>
            <span class="weui-form-preview__value"><?php  echo  $v["size"]; ?> </span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">产品类型</label>
            <span class="weui-form-preview__value"><?php  echo  $v["caname"]; ?></span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">入库类型</label>
            <span class="weui-form-preview__value"><?php  echo  $v["saletype"]; ?></span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">销售价</label>
            <span class="weui-form-preview__value"><i class="fa fa-1x fa-rmb"></i><?php  echo  $v["saleprice"]; ?> </span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">代理价</label>
            <span class="weui-form-preview__value"><i class="fa fa-1x fa-rmb"></i> <?php  echo  $v["rivalprice"]; ?></span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">保留价</label>
            <span class="weui-form-preview__value"><i class="fa fa-1x fa-rmb"></i><?php  echo  $v["holdprice"]; ?></span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">其他费用</label>
            <span class="weui-form-preview__value"><i class="fa fa-1x fa-rmb"></i> <?php  echo  $v["otherfee"]; ?></span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">库存状态</label>
            <span class="weui-form-preview__value"><?php  echo  $v["prname"]; ?></span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">备注</label>
            <span class="weui-form-preview__value"><?php  echo  $v["content"]; ?></span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">封面照片</label>
            <span class="weui-form-preview__value"><img  src="<?php echo $v["facephoto"] ; ?>" style="width: 140px; height: 140px;"  /></span>
        </div>
    </div>
</div>
<!--<div class="g_p1 g_share  clearfix">
        <span class="fl">分享到</span>
        百度分享
        <div class="bdsharebuttonbox fl">
            <a href="#" class="bds_more" data-cmd="more"></a>
            <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
            <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
            <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
            <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
            <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
        </div>
        <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
         分享 end
</div>-->
<!--<script>

new Vue({
        el: '#showone',
        data: {
                v: <?php // echo $data; ?>
        }
    })

</script>-->

    <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="https://res.wx.qq.com/open/libs/weuijs/1.0.0/weui.min.js"></script>
    <script src="/bootadmin/weUI/example.js"></script>
</body>
</html>
