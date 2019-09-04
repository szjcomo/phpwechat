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

$access_token = 'xxxx';

/**
 * 增加自定义菜单
 */
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




