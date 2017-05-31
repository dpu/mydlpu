<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta content="telephone=no" name="format-detection"/>
    <title>校内电话查询-工大A梦</title>
    <link rel="stylesheet" href="//res.wx.qq.com/open/libs/weui/1.1.1/weui.min.css"/>
    <link rel="stylesheet" href="//dn-xuyangjie.qbox.me/mydlpu.main.css"/>
</head>

<body>
<div class="container">
    <div class="page">
        <div class="hd">
            <h1 class="page_title">校内电话查询</h1>
            <p class="page_desc">点击右上角按钮分享</p>
        </div>
        <div class="weui-cells">
            @foreach($tels as $item)
            <div class="weui-cell">
                <div class="weui-cell__bd weui-cell__primary">
                    <p>{{ $item['sort'] .' '. $item['name'] }}</p>
                </div>
                <div class="weui-cell__ft">{{ $item['tel'] }}</div>
            </div>
            @endforeach
        </div>
        @if(count($tels) == 0)
        <center><h3 class="icon-box__title">未查询到数据</h3></center>
        @endif
        <div class="weui-btn-area">
            <a class="weui-btn weui-btn_primary" href="{{route('netTel')}}" type="button">继续查电话</a>
        </div>
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