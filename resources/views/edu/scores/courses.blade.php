<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta content="telephone=no" name="format-detection"/>
    <title>{{ $data['title'] }} - 工大A梦</title>
    <link rel="stylesheet" href="//res.wx.qq.com/open/libs/weui/1.1.1/weui.min.css"/>
    <link rel="stylesheet" href="//dn-xuyangjie.qbox.me/mydlpu.main.css"/>
</head>

<body>
<div class="container">
    <div class="page">
        <div class="hd">
            <h1 class="page_title"> {{ $data['title'] }}</h1>
        </div>
        <div class="weui-cells_title">{{ $data['semester'] }}</div>
        <div class="weui-cells">
            @foreach( $data['scores'] as $item)
                <div class="weui-cell">
                    <div class="weui-cell__bd weui-cell__primary">
                        <p>{{ $item['3'] }}</p>
                    </div>
                    <div class="weui-cell__ft">{{ $item['4'] }} </div>
                </div>
            @endforeach
        </div>
        <div class="qrcode">
            <img src="//dn-xuyangjie.qbox.me/footer.png">
        </div>
    </div>
</div>

<script src="//res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
    shareData = {
        title: "{{ $data['title'] }}",
        desc: '大连工业大学 微信查成绩',
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