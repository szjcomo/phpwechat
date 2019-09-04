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
 * 微信自定义菜单类操作
 */
Class Menu {

	use Reshandler;
	/**
	 * 创建自定义菜单接口
	 */
	Protected const AddMenuURL 			= 'menu/create?access_token=%s';
	/**
	 * 查询自定义菜单接口
	 */
	Protected const findMenuURL			= 'menu/get?access_token=%s';
	/**
	 * 删除自定义菜单接口
	 */
	Protected const DelMenuURL 			= 'menu/delete?access_token=%s';
	/**
	 * 获取自定义菜单配置接口
	 */
	Protected const GetMenuConfigURL    = 'get_current_selfmenu_info?access_token=%s';
	/**
	 * [addCurMenu 添加自定义菜单]
	 * @author szjcomo
	 * @DateTime 2019-09-02T11:37:42+0800
	 * @param    array                    $data         [description]
	 * @param    string|null              $access_token [description]
	 * @param    string|null              $host         [description]
	 * @return   array                                  [description]
	 */
	Public static function addCurMenu(string $access_token = null,array $data = [],string $host = null,$debug = false):array
	{
		try{
			$url = sprintf($host.self::AddMenuURL,$access_token);
			$res = Tools::curl_post($url,json_encode($data,JSON_UNESCAPED_UNICODE),[],$debug);
			return self::responseHandler($res);
		} catch(\Exception $err){
			return Tools::appResult($err->getMessage());
		}
	}
	/**
	 * [findMenu 查询自定义菜单接口]
	 * @author szjcomo
	 * @DateTime 2019-09-02T12:57:41+0800
	 * @param    string|null              $access_token [description]
	 * @return   [type]                                 [description]
	 */
	static function findMenu(string $access_token = null,string $host = null,$debug = false):array
	{
		try{
			$url = sprintf($host.self::findMenuURL,$access_token);
			$res = Tools::curl_get($url,[],$debug);
			return self::responseHandler($res);
		} catch(\Exception $err){
			return Tools::appResult($err->getMessage());
		}
	}
	/**
	 * [delMenu 删除自定义菜单]
	 * @author szjcomo
	 * @DateTime 2019-09-02T14:10:38+0800
	 * @param    string|null              $access_token [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 * @return   [type]                                 [description]
	 */
	static function delMenu(string $access_token = null,string $host = null,$debug = false):array
	{
		try{
			$url = sprintf($host.self::DelMenuURL,$access_token,[],$debug);
			$res = Tools::curl_get($url,[],$debug);
			return self::responseHandler($res);
		} catch(\Exception $err){
			return Tools::appResult($err->getMessage());
		}
	}
	/**
	 * [getMenuConfig 获取自定义菜单配置接口]
	 * @author szjcomo
	 * @DateTime 2019-09-02T16:11:40+0800
	 * @param    string|null              $access_token [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 * @return   [type]                                 [description]
	 */
	static function getMenuConfig(string $access_token = null,string $host = null,$debug = false):array
	{
		try{
			$url = sprintf($host.self::GetMenuConfigURL,$access_token);
			$res = Tools::curl_get($url,[],$debug);
			return self::responseHandler($res);
		} catch(\Exception $err){
			return Tools::appResult($err->getMessage());
		}
	}
}
