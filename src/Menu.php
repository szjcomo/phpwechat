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
	 * @DateTime 2019-09-06T11:06:42+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function addCurMenu(string $access_token,array $data,string $host,$debug = false):array
	{
		$url = sprintf($host.self::AddMenuURL,$access_token);
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [findMenu 查询自定义菜单接口]
	 * @author szjcomo
	 * @DateTime 2019-09-06T11:06:54+0800
	 * @param    string                   $access_token [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 * @return   [type]                                 [description]
	 */
	static function findMenu(string $access_token,string $host,$debug = false):array
	{
		$url = sprintf($host.self::findMenuURL,$access_token);
		return self::GetManger($url,$debug);
	}
	/**
	 * [delMenu 删除自定义菜单]
	 * @author szjcomo
	 * @DateTime 2019-09-06T11:07:08+0800
	 * @param    string                   $access_token [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 * @return   [type]                                 [description]
	 */
	static function delMenu(string $access_token,string $host,$debug = false):array
	{
		$url = sprintf($host.self::DelMenuURL,$access_token,[],$debug);
		return self::GetManger($url,$debug);
	}
	/**
	 * [getMenuConfig 获取自定义菜单配置接口]
	 * @author szjcomo
	 * @DateTime 2019-09-06T11:07:18+0800
	 * @param    string                   $access_token [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 * @return   [type]                                 [description]
	 */
	static function getMenuConfig(string $access_token,string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetMenuConfigURL,$access_token);
		return self::GetManger($url,$debug);
	}
}
