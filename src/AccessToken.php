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
 * 获取access_token类
 */
Class AccessToken {
	/**
	 * 获取access_token值
	 */
	Protected const AccessTokenURL 		= 'token?grant_type=client_credential&appid=%s&secret=%s';
	/**
	 * [getAccessToken 获取access_token的值]
	 * @author szjcomo
	 * @DateTime 2019-09-02T11:46:33+0800
	 * @param    string|null              $appid  [description]
	 * @param    string|null              $secret [description]
	 * @param    string|null              $host   [description]
	 * @return   [type]                           [description]
	 */
	static function getAccessToken(string $appid = null,string $secret = null,string $host = null,$debug = false):array
	{
		try{
			$url = sprintf($host.self::AccessTokenURL,$appid,$secret);
			$res = Tools::curl_get($url,[],$debug);
			if(empty($res)) return Tools::appResult(WechatError::getError('-100001'));
			$data = json_decode($res,true);
			if(empty($data)) return Tools::appResult(WechatError::getError('-100002'));
			if(isset($data['errcode']) && !empty($data['errcode']))
				return Tools::appResult(WechatError::getError($data['errcode']),null,true,$data['errcode']);
			return Tools::appResult('SUCCESS',$data,false);
		} catch(\Exception $err){
			return Tools::appResult($err->getMessage());
		}
	}
}

