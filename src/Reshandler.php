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

trait Reshandler
{
	/**
	 * [responseHandler 处理响应的数据]
	 * @author szjcomo
	 * @DateTime 2019-09-02T16:14:27+0800
	 * @param    string|null              $res [description]
	 * @return   [type]                        [description]
	 */
	static function responseHandler(string $res = null):array
	{
		if(empty($res)) return Tools::appResult(WechatError::getError('-100001'));
		$data = json_decode($res,true);
		if(empty($data)) return Tools::appResult(WechatError::getError('-100002'));
		if(!empty($data['errcode']))
			return Tools::appResult(WechatError::getError($data['errcode']),null,true,$data['errcode']);
		return Tools::appResult('SUCCESS',$data,false);
	}
	/**
	 * [GetUserManger 所有用户管理的get请求]
	 * @author szjcomo
	 * @DateTime 2019-09-05T14:44:24+0800
	 * @param    string|null              $url   [description]
	 * @param    boolean                  $debug [description]
	 */
	static function GetManger(string $url = null,$debug = false):array
	{
		try{
			$res = Tools::curl_get($url,[],$debug);
			return self::responseHandler($res);
		} catch(\Throwable $err){
			return Tools::appResult($err->getMessage());
		}
	}
	/**
	 * [PostUserManger post数据]
	 * @author szjcomo
	 * @DateTime 2019-09-05T14:54:56+0800
	 * @param    string|null              $url   [description]
	 * @param    [type]                   $data  [description]
	 * @param    boolean                  $debug [description]
	 */
	static function PostManger(string $url = null,$data = null,$debug = false):array
	{
		try{
			$res = Tools::curl_post($url,$data,[],$debug);
			return self::responseHandler($res);
		} catch(\Throwable $err){
			return Tools::appResult($err->getMessage());
		}
	}
}