<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta content="telephone=no" name="format-detection"/>
    <title>四六级成绩查询 - 工大A梦</title>
    <link rel="stylesheet" href="//res.wx.qq.com/open/libs/weui/1.1.1/weui.min.css"/>
    <link rel="stylesheet" href="/assets/css/main.css"/>
</head>

<body>
<div class="container">
    <div class="page">
        <div class="hd">
            <h1 class="page_title">CET4&6</h1>
        </div>
        <form action="{{route('cetResult')}}" method="get">
            <div class="weui-cells weui-cells_form">
                <div class="weui-cell">
                    <div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
                    <div class="weui-cell__bd">
                        <input name="name" class="weui-input" type="text" placeholder="请输入您的姓名"/>
                    </div>
                </div>
                <div class="weui-cell">
                    <div class="weui-cell__hd"><label class="weui-label">准考证号</label></div>
                    <div class="weui-cell__bd">
                        <input name="number" class="weui-input" type="text" placeholder="请输入准考证号"/>
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
        title: '英语四六级成绩查询',
        desc: "简约\n\t\t快捷\n\t\t\t\t高效",
        link: "{{route('cet')}}",
        imgUrl: "{{url('assets/img/icon.png')}}"
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