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
 * 微信网页开发
 */
Class WechatWeb {
	use Reshandler;
	/**
	 * 网页授权获取code地址
	 */
	Protected const GetAccessTokenURL 	= 'sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code';
	/**
	 * 刷新access_token（如果需要）
	 */
	Protected const RefreshTokenURL 	= 'sns/oauth2/refresh_token?appid=%s&grant_type=refresh_token&refresh_token=%s';
	/**
	 * 获取用户详细信息
	 */
	Protected const GetUserInfoURL 		= 'sns/userinfo?access_token=%s&openid=%s&lang=zh_CN';
	/**
	 * 检验授权凭证（access_token）是否有效
	 */
	Protected const CheckAccessTokenURL = 'sns/auth?access_token=%s&openid=%s'; 

	/**
	 * [$getTicketURL 获取JS参数]
	 * @var string
	 */
	Protected const GetJsTicketURL 		= 'ticket/getticket?type=jsapi&access_token=%s';

	/**
	 * [AuthAccessToken 用取用户的openid和access_token]
	 * @author szjcomo
	 * @DateTime 2019-09-06T16:12:29+0800
	 * @param    string                   $appid  [description]
	 * @param    string                   $secret [description]
	 * @param    string                   $code   [description]
	 * @param    string                   $host   [description]
	 * @param    boolean                  $debug  [description]
	 */
	static function AuthAccessToken(string $appid,string $secret,string $code,string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetAccessTokenURL,$appid,$secret,$code);
		return self::GetManger($url,$debug);
	}
	/**
	 * [RefreshToken 刷新用户的登录授权码]
	 * @author szjcomo
	 * @DateTime 2019-09-06T16:12:43+0800
	 * @param    string                   $appid         [description]
	 * @param    string                   $refresh_token [description]
	 * @param    string                   $host          [description]
	 * @param    boolean                  $debug         [description]
	 */
	static function RefreshToken(string $appid,string $refresh_token,string $host,$debug = false):array
	{
		$url = sprintf($host.self::RefreshTokenURL,$appid,$refresh_token);
		return self::GetManger($url);
	}
	/**
	 * [GetUserInfo 获取用户详细信息]
	 * @author szjcomo
	 * @DateTime 2019-09-06T16:12:54+0800
	 * @param    string                   $access_token [description]
	 * @param    string                   $openid       [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetUserInfo(string $access_token,string $openid,string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetUserInfoURL,$access_token,$openid);
		return self::GetManger($url,$debug);
	}
	/**
	 * [CheckToken 检测用户的授权码是否有效]
	 * @author szjcomo
	 * @DateTime 2019-09-06T16:14:38+0800
	 * @param    string                   $access_token [description]
	 * @param    string                   $openid       [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function CheckToken(string $access_token,string $openid,string $host,$debug = false):array
	{
		$url = sprintf($host.self::CheckAccessTokenURL,$access_token,$openid);
		return self::GetManger($url,$debug);
	}
	/**
	 * [getJsApiTicket 获取网页的jssdk 的 ticket]
	 * @author szjcomo
	 * @DateTime 2019-09-06T16:19:25+0800
	 * @param    string                   $access_token [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 * @return   [type]                                 [description]
	 */
	static function getJsApiTicket(string $access_token,string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetJsTicketURL,$access_token);
		return self::GetManger($url);
	}
	/**
	 * [getJsSdkSign 获取JSSDK的接口签名]
	 * @author szjcomo
	 * @DateTime 2019-09-06T16:35:30+0800
	 * @param    string                   $ticket [description]
	 * @param    string                   $uri    [description]
	 * @return   [type]                           [description]
	 */
	static function getJsSdkSign(string $appid,string $ticket,string $uri,array $data = []):array
	{
		try{
			$noncestr = Tools::getRandStr(16);
			$curTime = time();
			$tmp = [
				'nonceStr'=>$noncestr,
				'timestamp'=>$curTime,
				'url'=>$uri,
				'rawString'=>'jsapi_ticket='.$ticket.'&noncestr='.$noncestr.'&timestamp='.$curTime.'&url='.$uri
			];
			$options = array_merge($tmp,$data);
			$signPackage = [
				'appId'=>$appid,'nonceStr'=>$options['nonceStr'],'timestamp'=>$options['timestamp'],'url'=>$options['url'],'signature'=>sha1($options['rawString']),'rawString'=>$options['rawString']
			];
			return Tools::appResult('SUCCESS',$signPackage,false,0);
		} catch(\Throwable $err){
			return Tools::appResult($err->getMessage());
		}
	}
}
