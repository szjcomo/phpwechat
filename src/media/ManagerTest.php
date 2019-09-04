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

require '../vendor/autoload.php';

use szjcomo\phpwechat\Wechat;

$access_token = 'xxx';
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
