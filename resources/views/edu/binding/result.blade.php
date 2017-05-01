<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta content="telephone=no" name="format-detection"/>
    <title>教务系统绑定 - 工大A梦</title>
    <link rel="stylesheet" href="//res.wx.qq.com/open/libs/weui/1.1.1/weui.min.css"/>
    <link rel="stylesheet" href="/assets/css/main.css"/>
</head>

<body>
<div class="container">
    <div class="page">
        <div class="hd">
            <h1 class="page_title">教务系统绑定</h1>
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
    </div>
</div>
</body>
</html>