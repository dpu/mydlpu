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

$app->get('/', ['as' => 'root', function () use ($app) {
    return $app->version();
}]);

/** 自动化部署 */
$app->post('078f40fa23e0672777adc7c05d4773dd', 'DeployController@deploy');

/** 微信 */
$app->get('wechat', 'WechatController@serve');
$app->post('wechat', 'WechatController@serve');

/** 微信回调 */
$app->get('wechat_oauth_callback', 'WechatController@callback');

/** 自定义菜单 添加 */
$app->get('wechat/menu/add', 'Wechat\MenuController@add');
/** 自定义菜单 获取*/
$app->get('wechat/menu/get', 'Wechat\MenuController@get');

/** 网页 快递查询 */
$app->get('h5/express', ['as' => 'express', 'uses' => 'Express\ExpressController@indexHtml']);

/** 网页 快递查询结果 */
$app->post('h5/express/result', ['as' => 'expressResult', 'uses' => 'Express\ExpressController@resultHtml']);

/** 网页 教务处学号绑定 */
$app->get('h5/edu/binding', ['as' => 'eduBinding', 'uses' => 'Edu\EduController@bindingHtml']);

/** 教务处学号绑定处理 */
$app->post('h5/edu/binding/result', ['as' => 'eduBindingResult', 'uses' => 'Edu\EduController@bindingResultHtml']);

/** 教务处学号解除绑定 */
$app->get('h5/edu/binding/remove', ['as' => 'eduBindingRemove', 'uses' => 'Edu\EduController@removeBindingHtml']);

/** 网页 锐捷自助绑定 */
$app->get('h5/net/binding', ['as' => 'netBinding', 'uses' => 'Net\NetController@bindingHtml']);

/** 锐捷自助绑定处理 */
$app->post('h5/net/binding/result', ['as' => 'netBindingResult', 'uses' => 'Net\NetController@bindingResultHtml']);

/** 网页 四六级成绩查询 */
$app->get('h5/cet', ['as' => 'cet', 'uses' => 'Cet\CetController@indexHtml']);

/** 网页 四六级成绩查询结果 */
$app->get('h5/cet/result', ['as' => 'cetResult', 'uses' => 'Cet\CetController@resultHtml']);

/** 网页 期末成绩 */
$app->get('h5/scores/courses', ['as' => 'scoresCourses', 'uses' => 'Edu\EduController@scoresCoursesHtml']);

$app->get('api/mina/timetable', ['as' => 'apiMinaTimetable', 'uses' => 'Edu\EduController@apiMinaTimetable']);

$app->get('test', function (){
    echo route('eduBinding');
});