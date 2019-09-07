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

namespace szjcomo\phpwechat;
use szjcomo\phputils\Tools;
/**
 * 微信消息类
 */
Class WechatMessage {

	use Reshandler;
	/**
	 * 设置所属行业
	 */
	Protected const SetIndustryURL 	= 'template/api_set_industry?access_token=%s';
	/**
	 * 获取设置的行业信息
	 */
	Protected const GetIndustryURL 	= 'template/get_industry?access_token=%s';
	/**
	 * 获得模板ID
	 */
	Protected const TemplateInfoURL = 'template/api_add_template?access_token=%s';
	/**
	 * 获取模板列表
	 */
	Protected const TemplateListURL = 'template/get_all_private_template?access_token=%s';
	/**
	 * 删除模版
	 */
	Protected const DelTemplateURL  = 'template/del_private_template?access_token=%s';
	/**
	 * 发送模板消息
	 */
	Protected const SendTemplateURL = 'message/template/send?access_token=%s';

	/**
	 * [sendTemplateMessage 发送模版消息]
	 * @author szjcomo
	 * @DateTime 2019-09-03T17:18:13+0800
	 * @param    string|null              $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 * @return   [type]                                 [description]
	 */
	static function sendTemplate(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::SendTemplateURL,$access_token);
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [delTemplate 删除模版]
	 * @author szjcomo
	 * @DateTime 2019-09-03T17:57:46+0800
	 * @param    string|null              $access_token [description]
	 * @param    string|null              $id           [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 * @return   [type]                                 [description]
	 */
	static function delTemplate(string $access_token,string $id,string $host,$debug = false):array
	{
		$url = sprintf($host.self::DelTemplateURL,$access_token);
		return self::PostManger($url,json_encode(['template_id'=>$id],JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [getTemplateList 获取模版列表]
	 * @author szjcomo
	 * @DateTime 2019-09-03T16:15:41+0800
	 * @param    string|null              $access_token [description]
	 * @param    boolean                  $debug        [description]
	 * @return   [type]                                 [description]
	 */
	static function getTemplateList(string $access_token,string $host,$debug = false):array
	{
		$url = sprintf($host.self::TemplateListURL,$access_token);
		return self::GetManger($url,$debug);
	}
	/**
	 * [getIndustryInfo 获取所属行业详情]
	 * @author szjcomo
	 * @DateTime 2019-09-03T16:19:39+0800
	 * @param    string|null              $access_token [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 * @return   [type]                                 [description]
	 */
	static function getIndustryInfo(string $access_token,string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetIndustryURL,$access_token);
		return self::GetManger($url,$debug);
	}
	/**
	 * [getTemplateInfo 获取模版详情]
	 * @author szjcomo
	 * @DateTime 2019-09-03T16:21:37+0800
	 * @param    string|null              $access_token [description]
	 * @param    string|null              $id           [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 * @return   [type]                                 [description]
	 */
	static function getTemplateInfo(string $access_token,string $id,string $host,$debug = false):array
	{
		$url = sprintf($host.self::TemplateInfoURL,$access_token);
		return self::PostManger($url,json_encode(['template_id'=>$id],JSON_UNESCAPED_UNICODE),$debug);
	}

}
