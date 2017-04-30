<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta content="telephone=no" name="format-detection"/>
    <title>工大A梦</title>
    <link rel="stylesheet" href="//res.wx.qq.com/open/libs/weui/1.1.1/weui.min.css"/>
    <link rel="stylesheet" href="/assets/css/scores.css"/>
</head>

<body>
<div class="container">
    <div class="page">
        <div class="hd">
            <h1 class="page_title">快递追踪</h1>
        </div>
        <form action="/h5/express/result" method="post">
            <div class="weui-cells weui-cells_form">
                <div class="weui-cell">
                    <div class="weui-cell__hd"><label class="weui-label">单号</label></div>
                    <div class="weui-cell__bd">
                        <input name="nu" class="weui-input" type="text" placeholder="请输入快递单号"/>
                        <input name="openid" value="{{$openid}}" type="hidden"/>
                    </div>
                </div>
                <div class="weui-cell">
                    <div class="weui-cell__hd"><label class="weui-label">备注</label></div>
                    <div class="weui-cell__bd">
                        <input name="note" class="weui-input" type="text" placeholder="请输入备注"/>
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