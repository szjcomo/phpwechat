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
 * 素材管理类
 */
use szjcomo\phpwechat\media\Manager as mediaManager;

/**
 * 微信sdk类
 */
Class Wechat{

	use Reshandler;
	/**
	 * 微信通信域名
	 */
	Protected const WeixinHOST 			= 'https://api.weixin.qq.com/cgi-bin/';
	/**
	 * 获取微信服务器可用IP
	 */
	Protected const GetCallBackIpURL 	= 'getcallbackip?access_token=%s';

	/**
	 * 定义消息类型
	 */
	Protected const MSGTYPE_TEXT 		= 'text';
	Protected const MSGTYPE_IMAGE 		= 'image';
	Protected const MSGTYPE_LOCATION 	= 'location';
	Protected const MSGTYPE_LINK 		= 'link';
	Protected const MSGTYPE_EVENT 		= 'event';
	Protected const MSGTYPE_MUSIC 		= 'music';
	Protected const MSGTYPE_NEWS 		= 'news';
	Protected const MSGTYPE_VOICE		= 'voice';
	Protected const MSGTYPE_VIDEO		= 'video';
	Protected const MSGTYPE_SHORTVIDEO	= 'shortvideo';
	/**
	 * [checkSignature 验证微信通信签名函数]
	 * @Author    como
	 * @DateTime  2019-03-22
	 * @copyright 思智捷管理系统
	 * @version   [1.5.0]
	 * @param     string     $token [description]
	 * @return    [type]            [description]
	 */
	static function checkSignature(string $token,&$context):string
	{
		$echostr    = $context->get('echostr','111');
        $signature 	= $context->get('signature','');
        $timestamp 	= $context->get('timestamp','');
        $nonce 		= $context->get('nonce','');
		$tmpArr 	= array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		return $tmpStr == $signature ? $echostr : 'not access';
	}
	/**
	 * [start 开始监听消息接口]
	 * @author szjcomo
	 * @DateTime 2019-09-02T16:34:45+0800
	 * @param    [type]                   &$context [description]
	 * @return   [type]                             [description]
	 */
	static function start(&$context){
		try{
			$xmlStr = $context->put();
			libxml_disable_entity_loader(true);
			if (!empty($xmlStr)) {
				$xmlObj =  @simplexml_load_string($xmlStr, 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NOBLANKS);
				$data = json_decode(json_encode($xmlObj),true);
				return Tools::appResult('SUCCESS',$data,false);
			} else {
				return Tools::appResult(WechatError::getError('-100002'));
			}
		} catch(\Exception $err){
			return Tools::appResult($err->getMessage());
		}
	}
	/**
	 * [run 开始执行回调]
	 * @author szjcomo
	 * @DateTime 2019-09-03T14:14:50+0800
	 * @param    string|null              $callbackClass [description]
	 * @param    string|null              $callback      [description]
	 * @param    array                    $reqData       [description]
	 * @return   [type]                                  [description]
	 */
	static function run(string $callbackClass = null,string $callback = null,array $reqData = []):string
	{
		try{
			if(empty($callbackClass) || empty($callback)) return self::replyText('温馨提示：对不起,未指定回复的内容',$reqData);
			if(!class_exists($callbackClass)) return self::replyText('温馨提示：对不起,指定的回调类不存在',$reqData);
			$obj = new \ReflectionClass($callbackClass);
			if($obj->hasMethod($callback)){
				$result = call_user_func([$callbackClass,$callback],$reqData);
				return self::reply($result,$reqData);
			} else {
				return self::replyText('温馨提示：对不起,指定的回调函数不存在',$reqData);
			}
		} catch(\Exception $err){
			return self::replyText($err->getMessage());
		}
	}
	/**
	 * [reply 执行统一回复标准]
	 * @author szjcomo
	 * @DateTime 2019-09-03T14:22:32+0800
	 * @param    array                    $result  [description]
	 * @param    array                    $reqData [description]
	 * @return   [type]                            [description]
	 */
	Protected static function reply(array $info = [],array $reqData = []):string
	{
		$result = self::replyText('温馨提示：对不起,指定的消息内容无法回复',$reqData);
		try{
			switch($info['type']){
				case self::MSGTYPE_TEXT:
					$result = self::replyText($info['data'],$reqData);
					break;
				case self::MSGTYPE_NEWS:
					$result = self::replyNews($info['data'],$reqData);
					break;
				case self::MSGTYPE_IMAGE:
					$result = self::replyImage($info['data'],$reqData);
					break;
				case self::MSGTYPE_VOICE:
					$result = self::replyVoice($info['data'],$reqData);
					break;
				case self::MSGTYPE_VIDEO:
					$result = self::replyVideo($info['data'],$reqData);
					break;
				default:
					$result = self::replyText('系统提醒：对不起,暂未查询相关的回复消息',$reqData);
			}			
		} catch(\Exception $err){
			$result = slef::replyText($err->getMessage(),$reqData);
		}
		return $result;
	}
	/**
	 * [getWeixinIpList 获取微信服务器IP列表]
	 * @author szjcomo
	 * @DateTime 2019-09-02T16:28:51+0800
	 * @param    string|null              $access_token [description]
	 * @return   [type]                                 [description]
	 */
	static function getWeixinIpList(string $access_token = null,$debug = false):array
	{
		try{
			$url = sprintf(self::WeixinHOST.self::GetCallBackIpURL,$access_token);
			$res = Tools::curl_get($url,[],$debug);
			return self::responseHandler($res);
		} catch(\Exception $err){
			return Tools::appResult($err->getMessage());
		}
	}
	/**
	 * [getAccessToken 获取access_token]
	 * @author szjcomo
	 * @DateTime 2019-09-02T11:39:47+0800
	 * @param    string|null              $appid  [description]
	 * @param    string|null              $secret [description]
	 * @return   [type]                           [description]
	 */
	static function getAccessToken(string $appid = null,string $secret = null):array
	{
		try{
			return AccessToken::getAccessToken($appid,$secret,self::WeixinHOST);
		} catch(\Exception $err){
			return Tools::appResult($err->getMessage());
		}
	}

	/**
	 * [模版消息操作]
	 * @author szjcomo
	 * @DateTime 2019-09-03T16:23:43+0800
	 * @param    string|null              $access_token [description]
	 * @param    [type]                   $data         [description]
	 * @param    string                   $type         [description]
	 * @param    boolean                  $debug        [description]
	 * @return   [type]                                 [description]
	 */
	static function template(string $access_token = null,$data = null,$type = 'list',$debug = false):array
	{
		try{
			switch ($type) {
				case 'list':
					$result = WechatMessage::getTemplateList($access_token,self::WeixinHOST,$debug);
					break;
				case 'info':
					$result = WechatMessage::getTemplateInfo($access_token,$data,self::WeixinHOST,$debug);
					break;
				case 'industry':
					$result = WechatMessage::getIndustryInfo($access_token,self::WeixinHOST,$debug);
					break;
				case 'message':
					$result = WechatMessage::sendTemplate($access_token,$data,self::WeixinHOST,$debug);
					break;
				case 'del':
					$result = WechatMessage::delTemplate($access_token,$data,self::WeixinHOST,$debug);
					break;
				default:
					$result = Tools::appResult('ERROR');
					break;
			}
		} catch(\Exception $err){
			$result = Tools::appResult($err->getMessage());
		}
		return $result;
	}


	/**
	 * [menu 自定义菜单操作]
	 * @author szjcomo
	 * @DateTime 2019-09-02T13:59:27+0800
	 * @param    string|null              $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $type         [description]
	 * @return   [type]                                 [description]
	 */
	static function cusMenu(string $access_token = null,array $data = [],string $type = 'find',$debug = false):array
	{
		try{
			switch ($type) {
				case 'find':
					$result = Menu::findMenu($access_token,self::WeixinHOST,$debug);
					break;
				case 'add':
					$result = Menu::addCurMenu($access_token,$data,self::WeixinHOST,$debug);
					break;
				case 'del':
					$result = Menu::delMenu($access_token,self::WeixinHOST,$debug);
					break;
				default:
					$result = Menu::getMenuConfig($access_token,self::WeixinHOST,$debug);
					break;
			}
			return $result;
		} catch(\Exception $err){
			return Tools::appResult($err->getMessage());
		}
	}
	/**
	 * [MaterManager 素材管理功能]
	 * @author szjcomo
	 * @DateTime 2019-09-02T18:04:30+0800
	 * @param    string|null              $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $type         [description]
	 */
	static function material(string $access_token = null,array $data = [],string $type = 'count',$debug = false):array
	{
		try{
			switch ($type) {
				case 'count':
					$result = mediaManager::getMaterCount($access_token,self::WeixinHOST,$debug);
					break;
				case 'list':
					$result = mediaManager::getMaterList($access_token,$data,self::WeixinHOST,$debug);
					break;
				case 'gettmp':
					$result = mediaManager::getTempUpload($access_token,$data,self::WeixinHOST,$debug);
					break;
				case 'get':
					$result = mediaManager::getMaterial($access_token,$data,self::WeixinHOST,$debug);
					break;
				case 'addtmp':
					$result = mediaManager::addTempUpload($access_token,$data,self::WeixinHOST,$debug);
					break;
				case 'add':
					$result = mediaManager::addMaterial($access_token,$data,self::WeixinHOST,$debug);
					break;
				case 'del':
					$result = mediaManager::deleteMaterial($access_token,$data,self::WeixinHOST,$debug);
					break;
				case 'addnews':
					$result = mediaManager::addMaterialNews($access_token,$data,self::WeixinHOST,$debug);
					break;
				case 'savenews':
					$result = mediaManager::updateMaterialNews($access_token,$data,self::WeixinHOST,$debug);
					break;
				default:
					$result = Tools::appResult('ERROR');
					break;
			}
			return $result;
		} catch(\Exception $err){
			return Tools::appResult($err->getMessage());
		}
	}
	/**
	 * [arrayToXml 数组转xml]
	 * @Author    como
	 * @DateTime  2019-03-22
	 * @copyright 思智捷管理系统
	 * @version   [1.5.0]
	 * @param     array      $arr [description]
	 * @return    [type]          [description]
	 */
	static function arrayToXml($data = [],$root='xml', $attr =''){
	    if(is_array($attr)){
	        $_attr = array();
	        foreach ($attr as $key => $value) {
	            $_attr[] = "{$key}=\"{$value}\"";
	        }
	        $attr = implode(' ', $_attr);
	    }
	    $attr   = trim($attr);
	    $attr   = empty($attr) ? '' : " {$attr}";
	    $xml 	= '';
	    $xml   .= "<{$root}{$attr}>";
	    $xml   .= self::data_to_xml($data);
	    $xml   .= "</{$root}>";
	    return $xml;
	}

	/**
	 * [数据XML编码]
	 * @作者     como
	 * @时间     2018-07-16
	 * @版权     FASTNODEJS WEB   FRAMEWORK
	 * @版本     1.0.1
	 * @param  [type]     $data [description]
	 * @return [type]           [description]
	 */
	static function data_to_xml($data) {
	    $xml = '';
	    foreach ($data as $key => $val) {
	        is_numeric($key) && $key = "item";
	        $xml    .=  "<$key>";
	        $xml    .=  ( is_array($val) || is_object($val)) ? self::data_to_xml($val)  : self::xmlSafeStr($val);
	        list($key, ) = explode(' ', $key);
	        $xml    .=  "</$key>";
	    }
	    return $xml;
	}	
	/**
	 * [xmlSafeStr xml转换成字符串]
	 * @作者     como
	 * @时间     2018-07-16
	 * @版权     FASTNODEJS WEB  FRAMEWORK
	 * @版本     1.0.1
	 * @param  [type]     $str [description]
	 * @return [type]          [description]
	 */
	static function xmlSafeStr($str){   
		return '<![CDATA['.preg_replace("/[\\x00-\\x08\\x0b-\\x0c\\x0e-\\x1f]/",'',$str).']]>';   
	} 

	/**
	 * [replyText 回复文本消息]
	 * @author szjcomo
	 * @DateTime 2019-09-02T16:54:30+0800
	 * @param    string                   $text    [description]
	 * @param    array                    $reqData [description]
	 * @return   [type]                            [description]
	 */
	static function replyText(string $text = '',array $reqData = []):string
	{
		$options = ['Content'=>$text];
		return self::arrayToXml(self::baseReplyMessage($reqData,self::MSGTYPE_TEXT,$options));
	}
	/**
	 * [replyNews 回复图文消息]
	 * @author szjcomo
	 * @DateTime 2019-09-02T17:03:45+0800
	 * @param    array                    $data    [description]
	 * @param    array                    $reqData [description]
	 * @return   [type]                            [description]
	 */
	static function replyNews(array $data = [],array $reqData = []):string
	{
		//Oi7l9egxpX1GgIzJNeXWgzIt2_dNUVHqo38mjlfS5oA  图文素材ID
		$options = ['ArticleCount'=>count($data),'Articles'=>self::toUcField($data,true)];
		return self::arrayToXml(self::baseReplyMessage($reqData,self::MSGTYPE_NEWS,$options));
	}
	/**
	 * [replyImage 回复图片消息]
	 * @author szjcomo
	 * @DateTime 2019-09-03T10:14:28+0800
	 * @param    array                    $data    [description]
	 * @param    array                    $reqData [description]
	 * @return   [type]                            [description]
	 */
	static function replyImage(string $mediaId,array $reqData = []):string
	{
		//Oi7l9egxpX1GgIzJNeXWgztnCq6EsFW1ZCYnhAsUBX8  永久
		//n8dPBhv6-G2JqHcSOpNFYBnfoqmC60dKEVMTd26II7LVXeFAS_GwNZ_72ASsU9Z7 临时
		$options = ['Image'=>['MediaId'=>$mediaId]];
		return self::arrayToXml(self::baseReplyMessage($reqData,self::MSGTYPE_IMAGE,$options));
	}
	/**
	 * [replyMusic 回复音乐消息]
	 * @author szjcomo
	 * @DateTime 2019-09-03T11:25:22+0800
	 * @param    array                    $data    [description]
	 * @param    array                    $reqData [description]
	 * @return   [type]                            [description]
	 */
	static function replyMusic(array $data = [],array $reqData = []):string
	{
		$options = ['Music'=>self::toUcField($data)];
		return self::arrayToXml(self::baseReplyMessage($reqData,self::MSGTYPE_MUSIC,$options));
	}
	/**
	 * [replyVoice 回复语音消息]
	 * @author szjcomo
	 * @DateTime 2019-09-03T11:57:35+0800
	 * @param    string|null              $medai_id [description]
	 * @param    array                    $reqData  [description]
	 * @return   [type]                             [description]
	 */
	static function replyVoice(string $medai_id = null,array $reqData = []):string
	{
		//cp45nwR_qYeHd_gfMHsv0-8vvdaSySM-EoN27pU_3soCE0jUIy9QclRDqEwOv6OE
		$options = ['Voice'=>['MediaId'=>$medai_id]];
		return self::arrayToXml(self::baseReplyMessage($reqData,self::MSGTYPE_VOICE,$options));
	}
	/**
	 * [replyVideo 回复视频消息]
	 * @author szjcomo
	 * @DateTime 2019-09-03T12:29:15+0800
	 * @param    array                    $data    [description]
	 * @param    array                    $reqData [description]
	 * @return   [type]                            [description]
	 */
	static function replyVideo(array $data = [],array $reqData = []):string
	{
		//PcC0Tcgy4ifh2KT35hsjo7Q8qVKGfQxyxoVeT5n_EAPyfsA4eP2mXtrpO20zMR-b
		$options = ['Video'=>self::toUcField($data)];
		return self::arrayToXml(self::baseReplyMessage($reqData,self::MSGTYPE_VIDEO,$options));
	}
	/**
	 * [baseReplyMessage 通用的消息回复机制]
	 * @author szjcomo
	 * @DateTime 2019-09-02T16:53:23+0800
	 * @param    array                    $reqData [description]
	 * @param    string                   $type    [description]
	 * @param    array                    $options [description]
	 * @return   [type]                            [description]
	 */
	static function baseReplyMessage(array $reqData = [],string $type = 'text',array $options = []):array
	{
		$msg = [
			'ToUserName'	=> $reqData['FromUserName'],
			'FromUserName'	=> $reqData['ToUserName'],
			'MsgType'		=> $type,
			'CreateTime'	=> time()
		];
		return array_merge($msg,$options);
	}
	/**
	 * [toUcField 将首字母转为大写]
	 * @author szjcomo
	 * @DateTime 2019-09-02T17:06:45+0800
	 * @param    array                    $data [description]
	 * @param    boolean                  $next [description]
	 * @return   [type]                         [description]
	 */
	Protected static function toUcField(array $data = [],$next = false):array
	{
		$newData = [];
		$callback = function($val,$key) use(&$newData,$next){
			if($next){
				foreach($val as $k=>$v){
					$newData[$key][ucwords($k)] = $v;
				}
			} else {
				$newData[ucwords($key)] = $val;
			}
		};
		array_walk($data, $callback);
		return $newData;
	}


}


