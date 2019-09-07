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
	use Reshandler;
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
	static function getAccessToken(string $appid,string $secret ,string $host,$debug = false):array
	{
		$url = sprintf($host.self::AccessTokenURL,$appid,$secret);
		return self::GetManger($url,$debug);
	}

}

