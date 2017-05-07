<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta content="telephone=no" name="format-detection"/>
    <title>校内电话查询 - 工大A梦</title>
    <link rel="stylesheet" href="//res.wx.qq.com/open/libs/weui/1.1.1/weui.min.css"/>
    <link rel="stylesheet" href="//dn-xuyangjie.qbox.me/mydlpu.main.css"/>
</head>

<body>
<div class="container">
    <div class="page">
        <div class="hd">
            <h1 class="page_title">校内电话查询</h1>
        </div>
        <form action="{{route('netTelResult')}}" method="get">
            <div class="weui-cells weui-cells_form">
                <div class="weui-cell">
                    <div class="weui-cell__hd"><label class="weui-label">关键字</label></div>
                    <div class="weui-cell__bd">
                        <input name="keyword" class="weui-input" type="text" placeholder="请输入要查询的关键字" required minlength="2"/>
                    </div>
                </div>
            </div>
            <div class="weui-btn-area">
                <input class="weui-btn weui-btn_primary" type="submit" value="确定"/>
            </div>
        </form>

        <div class="qrcode">
            <img src="//dn-xuyangjie.qbox.me/footer.png">
        </div>
    </div>
</div>
<script src="//res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
    shareData = {
        title: '大工大校内电话查询',
        desc: "简约\n\t\t快捷\n\t\t\t\t高效",
        link: "{{route('netTel')}}",
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