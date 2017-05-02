<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta content="telephone=no" name="format-detection"/>
    <title>教务系统绑定 - 工大A梦</title>
    <link rel="stylesheet" href="//res.wx.qq.com/open/libs/weui/1.1.1/weui.min.css"/>
    <link rel="stylesheet" href="//dn-xuyangjie.qbox.me/mydlpu.main.css"/>
</head>

<body>
<div class="container">
    <div class="page">
        <div class="hd">
            <h1 class="page_title">教务系统绑定</h1>
        </div>
        <form action={{route('eduBindingResult')}} method="post">
            <div class="weui-cells weui-cells_form">
                <div class="weui-cell">
                    <div class="weui-cell__hd"><label class="weui-label">学号</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="number" name="username" pattern="[0-9]*" placeholder="请输入学号" required>
                    </div>
                </div>
                <div class="weui-cell">
                    <div class="weui-cell__hd"><label class="weui-label">密码</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="password" name="password" placeholder="请输入密码" required>
                    </div>
                </div>
                <div class="weui-cell">
                    <div class="weui-cell__hd"><label class="weui-label">手机</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="tel" name="mobile" pattern="[0-9]*" placeholder="请输入手机号" required>
                        <input type="hidden" name="openid" value="{{$openid}}">
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

</body>
</html>