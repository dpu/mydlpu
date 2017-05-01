<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

/** 自动化部署 */
$app->post('078f40fa23e0672777adc7c05d4773dd', 'DeployController@deploy');

/** 微信 */
$app->get('wechat', 'WechatController@serve');
$app->post('wechat', 'WechatController@serve');

/** 微信回调 */
$app->get('wechat_oauth_callback', 'WechatController@callback');

/** 添加自定义菜单 */
$app->get('wechat/menu/add', 'Wechat\MenuController@add');

/** 网页 快递查询 */
$app->get('h5/express', 'Express\ExpressController@indexHtml');

/** 网页 快递查询结果 */
$app->post('h5/express/result', 'Express\ExpressController@resultHtml');

/** 网页 教务处学号绑定 */
$app->get('h5/edu/binding', function () {
    return view('edu.binding.index');
});

/** 教务处学号绑定处理 */
$app->post('h5/edu/binding/result', 'Edu\EduController@binding');


$app->get('test', function () {
    $modelEduUser = \App\Models\EduUsers::where('openid', 'ol_LCw0IAYwE7m3tFKwgvjUKHxa8')->where('username', '1305040229')->first();
    var_dump($modelEduUser);
});