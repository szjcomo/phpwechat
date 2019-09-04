<?php
/**
*-----------------------------------------------------------------------------------
////////////////////////////////////////////////////////////////////
//                          _ooOoo_                               //
//                         o8888888o                              //
//                         88" . "88                              //
//                         (| ^_^ |)                              //
//                         O\  =  /O                              //
//                      ____/`---'\____                           //
//                    .'  \|     |//  `.                         //
//                   /  \|||  :  |||//  \                        //
//                  /  _||||| -:- |||||-  \                       //
//                  |   | \\  -  /// |   |                       //
//                  | \_|  ''\---/''  |   |                       //
//                  \  .-\__  `-`  ___/-. /                       //
//                ___`. .'  /--.--\  `. . ___                     //
//            \  \ `-.   \_ __\ /__ _/   .-` /  /                 //
//      ========`-.____`-.___\_____/___.-`____.-'========         //
//                           `=---='                              //
//      ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^        //
//         佛祖保佑       永无BUG       永不修改                    //
////////////////////////////////////////////////////////////////////
* @Copyright 思智捷科技(c) this is a snippet.
* @Website: www.sizhijie.com
* @Author : szjcomo 
*-----------------------------------------------------------------------------------
*/

require './vendor/autoload.php';
use szjcomo\phpwechat\Wechat;
$appid = 'xxx';
$secret = 'xxx';


/**
 * 获取access_token的值 请自行保存并刷新
 */
$result = Wechat::getAccessToken($appid,$secret);

$access_token = 'xxx';
/**
 * 获取微信服务器列表
 */
$result = Wechat::getWeixinIpList($access_token);

// ==============================素材管理接口====================================
/**
 * 获取永久素材列表
 */
$result = Wechat::material($access_token,['type'=>'image','offset'=>0,'count'=>20],'list');
/**
 * 获取永久素材总数
 */
$result = Wechat::material($access_token,[],'count');
/**
 * 获取单个永久素材信息
 */
$result = Wechat::material($access_token,['media_id'=>'xxx','savepath'=>'./hello.png'],'get');
/**
 * 新增临时素材信息
 */
$result = Wechat::material($access_token,['type'=>'image','filename'=>'public/123.jpg'],'addtmp');
/**
 * 获取临时素材信息
 */
$result = Wechat::::material($access_token,['media_id'=>'n8dPBhv6-G2JqHcSOpNFYBnfoqmC60dKEVMTd26II7LVXeFAS_GwNZ_72ASsU9Z7','savepath'=>'public/456.jpg'],'gettmp');
/**
 * 新增永久素材信息
 */
$result = Wechat::material($access_token,['type'=>'image','filename'=>'public/456.jpg'],'add');
/**
 * 删除永久素材
 */
$result = Wechat::material($access_token,['media_id'=>'Oi7l9egxpX1GgIzJNeXWg1Vz-YBoKWcYYQnF03pzIsQ'],'del');
/**
 * 新增图文素材
 */
$data = [
	[
		'title'=>'测试新增图文',
		'thumb_media_id'=>'xxx',
		'author'=>'szjcomo',
		'digest'=>'这是一个测试的图文消息内容',
		'content'=>'这是一个测试的图文消息内容',
	]
];
$result = baseWechat::material($access_token,$data,'addnews');

/**
 * 编辑图文素材
 */
$data = [
	'articles'=>[
		'title'=>'这是一个修改后的图文消息',
		'thumb_media_id'=>'xxx',
		'author'=>'szjcomo',
		'digest'=>'这是一个测试的图文消息内容',
		'content'=>'不知道这样写可以不',
	],
	'media_id'=>'xxx',
	'index'=>0
];
$result = baseWechat::material($access_token,$data,'savenews');

// ==============================自定义菜单接口====================================
$menu = [
	'button'=>[
		['type'=>'click','name'=>'今日歌曲','key'=>'V1001_TODAY_MUSIC'],
		['name'=>'菜单导航','sub_button'=>[
			['type'=>'view','name'=>'搜索菜单','url'=>'http://www.baidu.com'],
			['type'=>'miniprogram','name'=>'小程序','url'=>'http://mp.weixin.qq.com','appid'=>'wx286b93c14bbf93aa','pagepath'=>'pages/lunar/index'],
			['type'=>'click','name'=>'赞一下我们','key'=>'V1001_GOOD']
		]]
	]
];
/**
 * 添加自定义菜单
 */
$res = Wechat::cusMenu($access_token,$menu,'add');
/**
 * 查询自定义菜单接口
 */
$res = Wechat::cusMenu($access_token);
/**
 * 删除自定义菜单接口
 */
$res = Wechat::cusMenu($access_token,[],'del');
/**
 * 查询自定义菜单配置
 */
$res = Wechat::cusMenu($access_token,[],'config');

// ==============================模版消息接口====================================
/**
 * 获取模版消息列表
 */
$res = Wechat::template($access_token,null,'list');
/**
 * 获取模版详情
 */
$template_id = 'xxx';
$res = Wechat::template($access_token,$template_id,'info');
/**
 * 获取行业设置信息
 */
$res = Wechat::template($access_token,null, 'industry');
/**
 * 发送模版消息
 */
$data = [
	'touser'=>'oSF4duIAfTLdEMukzNOpYPAuJxEo',
	'template_id'=>'0lVAeJntZFHi950PI-iHl08Fo2Uuoa3P2Hx_DRofbqg',
	'url'=>'http://www.sizhijie.com',
    /*"miniprogram"=>[
        "appid"=>"wx286b93c14bbf93aa",
        "pagepath"=>"pages/lunar/index"
    ],  */
	"data"=>[
		'name'=>['value'=>'罗勇','color'=>'#173177'],
		'remark'=>['value'=>'皮鞋100元','color'=>'#ff0000']
	]
];
$result = Wechat::template($access_token,$data,'message');
/**
 * 删除模版
 */
$template_id = 'xxx';
$res = Wechat::template($access_token,$template_id,'del');








