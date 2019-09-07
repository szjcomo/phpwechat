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
 * 二维码功能
 */
Class WechatQrcode {
	use Reshandler;
	/**
	 * 创建二维码请求
	 */
	Protected const AddQrcodeURL 		= 'qrcode/create?access_token=%s';
	/**
	 * 通过ticket换取二维码
	 */
	Protected const GetQrcodeURL 		= 'cgi-bin/showqrcode?ticket=%s';
	/**
	 * 长链接转短链接
	 */
	Protected const GetLongToShortURL 	= 'shorturl?access_token=%s';
	/**
	 * [toShortUrl 长链接转短链接]
	 * @author szjcomo
	 * @DateTime 2019-09-06T15:21:39+0800
	 * @param    string                   $access_token [description]
	 * @param    string                   $url          [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 * @return   [type]                                 [description]
	 */
	static function toShortUrl(string $access_token,string $longurl,string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetLongToShortURL,$access_token);
		return self::PostManger($url,json_encode(['action'=>'long2short','long_url'=>$longurl],JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [CreateQrcode 创建二维码功能]
	 * @author szjcomo
	 * @DateTime 2019-09-06T10:21:12+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function CreateQrcode(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::AddQrcodeURL,$access_token);
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [ShowQrcode 下载qrcode图片]
	 * @author szjcomo
	 * @DateTime 2019-09-06T10:29:12+0800
	 * @param    string                   $ticket   [description]
	 * @param    string|null              $savePath [description]
	 * @param    string                   $host     [description]
	 * @param    boolean                  $debug    [description]
	 */
	static function ShowQrcode(string $ticket,string $savePath = null,string $host,$debug = false)
	{
		try{
			$url = sprintf($host.self::GetQrcodeURL,$ticket);
			$res = Tools::curl_get($url,[],$debug);
			if(empty($savePath)) return $res;
			$tmp = json_decode($res,true);
			if(empty($tmp)){
				$dir = dirname($savePath);
				$action = Tools::createDirectory($dir) && Tools::createFile($savePath,$res);
				if(empty($action)) return Tools::appResult('ERROR');
				return Tools::appResult('SUCCESS',$savePath,false);					
			} else {
				return Tools::appResult(WechatError::getError($tmp['errcode']));
			}
		} catch(\Throwable $err){
			return Tools::appResult($err->getMessage());
		}
	}
}