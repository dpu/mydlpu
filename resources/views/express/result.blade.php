<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta content="telephone=no" name="format-detection"/>
    <title>工大A梦</title>
    <link rel="stylesheet" href="//res.wx.qq.com/open/libs/weui/1.1.1/weui.min.css"/>
    <link rel="stylesheet" href="//dn-xuyangjie.qbox.me/mydlpu.main.css"/>
</head>

<body>
<div class="container">
    <div class="page">
        <div class="hd">
            <h1 class="page_title">快递追踪</h1>
        </div>
        <center>
            <div class="icon-box">
                <i class="weui-icon-{{$data['icon'] ?? 'warn'}} weui-icon_msg"></i><br><br>
                <div class="icon-box__ctn">
                    <h3 class="icon-box__title">{{$data['title'] ?? ''}}</h3>
                    <p class="icon-box__desc">{{$data['desc'] ?? ''}}</p>
                </div>
            </div>
        </center>
        <div class="qrcode">
            <img src="//dn-xuyangjie.qbox.me/footer.png">
        </div>
    </div>
</div>

<script src="//res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
    shareData = {
        title: '物流追踪 实时接收快递动态',
        desc: '',
        link: location.href.split('#')[0],
        imgUrl: "https://dn-xuyangjie.qbox.me/icon.png"
    };
    wx.config({!! $jsconfig !!});
    wx.ready(function () {
        wx.onMenuShareTimeline(shareData);
        wx.onMenuShareAppMessage(shareData);
        wx.onMenuShareQQ(shareData);
        wx.onMenuShareQZone(shareData);
    });
</script>
</body>
</html>