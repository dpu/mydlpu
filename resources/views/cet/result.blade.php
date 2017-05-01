<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta content="telephone=no" name="format-detection"/>
    <title>四六级成绩查询-工大A梦</title>
    <link rel="stylesheet" href="//res.wx.qq.com/open/libs/weui/1.1.1/weui.min.css"/>
    <link rel="stylesheet" href="/assets/css/main.css"/>
</head>

<body>
<div class="container">
    <div class="page">
        <div class="hd">
            <h1 class="page_title"> {{ !is_null($score) ? $score['name'] .'的CET成绩' : 'CET4&6'}} </h1>
            <p class="page_desc">点击右上角按钮分享</p>
        </div>
        <center>
            @if(!is_null($score) && $score['written']['score'] >= 425)
            <div class="icon-box">
                <i class="weui-icon-success weui-icon_msg"></i><br><br>
                <div class="icon-box__ctn">
                    <h3 class="icon-box__title">恭喜你通过了四六级考试！</h3>
                    <p class="icon-box__desc">总分：{{ $score['written']['score'] }}</p>
                    <p class="icon-box__desc">听力：{{ $score['written']['listening'] }}</p>
                    <p class="icon-box__desc">阅读：{{ $score['written']['reading'] }}</p>
                    <p class="icon-box__desc">写作和翻译：{{ $score['written']['translation'] }}</p>
                    <p class="icon-box__desc">请关闭页面 enjoy更多服务</p>
                </div>
            </div>
            @elseif(!is_null($score) && $score['written']['score'] < 425)
            <div class="icon-box">
                <i class="weui-icon-waiting weui-icon_msg"></i><br><br>
                <div class="icon-box__ctn">
                    <h3 class="icon-box__title">很遗憾，没有通过四六级考试</h3>
                    <p class="icon-box__desc">总分：{{ $score['written']['score'] }}</p>
                    <p class="icon-box__desc">听力：{{ $score['written']['listening'] }}</p>
                    <p class="icon-box__desc">阅读：{{ $score['written']['reading'] }}</p>
                    <p class="icon-box__desc">写作和翻译：{{ $score['written']['translation'] }}</p>
                    <p class="icon-box__desc">再接再厉 还有人6次没过呢 加油哟~</p>
                </div>
            </div>
            @else
            <div class="icon-box">
                <i class="weui-icon-warn weui-icon_msg"></i><br><br>
                <div class="icon-box__ctn">
                    <h3 class="icon-box__title">查询出错，可能准考证号错误</h3>
                    <p class="icon-box__desc">请返回上一页，稍后再试</p>
                </div>
            </div>
            @endif
        </center>

        <div class="qrcode">
            <img src="//dn-xuyangjie.qbox.me/footer.png">
        </div>
    </div>
</div>
<script src="//res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
    shareData = {
        title: "{{ $score['name'] }}的英语四六级成绩单",
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