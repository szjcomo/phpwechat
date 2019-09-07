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
use szjcomo\phpwechat\media\Manager;
/**
 * 微信ai接口
 */
Class WechatAi {
	use Reshandler;
	/**
	 * 提交语音接口
	 */
	Protected const UploadVoiceURL 		= 'media/voice/addvoicetorecofortext?access_token=%s&format=mp3&voice_id=%s&lang=zh_CN';
	/**
	 * 获取语音内容
	 */
	Protected const GetVoiceResultURL 	= 'media/voice/queryrecoresultfortext?access_token=%s&voice_id=%s&lang=zh_CN';
	/**
	 * 身份证号码识别
	 */
	Protected const IdCardResultURL 	= 'cv/ocr/idcard?type=photo&access_token=%s';
	/**
	 * 银行卡识别接口
	 */
	Protected const BankCardResultURL	= 'cv/ocr/bankcard?access_token=%s';
	/**
	 * 行驶证识别接口
	 */
	Protected const DrivingResultURL 	= 'cv/ocr/driving?access_token=%s';
	/**
	 * 驾驶证识别接口
	 */
	Protected const DrivingLicenseURL 	= 'cv/ocr/drivinglicense?access_token=%s';
	/**
	 * 营业执照识别
	 */
	Protected const BizlicenseURL 		= 'cv/ocr/bizlicense?access_token=%s';

	/**
	 * [PostVoiceData 提交语音]
	 * @author szjcomo
	 * @DateTime 2019-09-06T18:10:08+0800
	 * @param    string                   $access_token [description]
	 * @param    string                   $voice_id     [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function UploadVoiceData(string $access_token,string $voice_id,string $filename,string $host,$debug = false):array
	{
		$url = sprintf($host.self::UploadVoiceURL,$access_token,$voice_id);
		$data = Manager::addUploadOptions($filename);
		return self::PostManger($url,$data,$debug);
	}
	/**
	 * [IdCardInfo 身份证识别接口]
	 * @author szjcomo
	 * @DateTime 2019-09-06T18:46:47+0800
	 * @param    string                   $access_token [description]
	 * @param    string                   $filename     [description]
	 * @param    string                   $host         [description]
	 */
	static function IdCardInfo(string $access_token,string $filename,string $host,$debug = false):array
	{
		$url = sprintf($host.self::IdCardResultURL,$access_token);
		if(self::isURL($filename)){
			return self::GetManger($url.'&img_url='.$filename);
		} else {
			$data = Manager::addUploadOptions($filename,'img');
			return self::PostManger($url,$data,$debug);			
		}
	}
	/**
	 * [IdCardInfo 银行卡识别接口]
	 * @author szjcomo
	 * @DateTime 2019-09-06T18:46:47+0800
	 * @param    string                   $access_token [description]
	 * @param    string                   $filename     [description]
	 * @param    string                   $host         [description]
	 */
	static function BankCardInfo(string $access_token,string $filename,string $host,$debug = false):array
	{
		$url = sprintf($host.self::BankCardResultURL,$access_token);
		if(self::isURL($filename)){
			return self::GetManger($url.'&img_url='.$filename);
		} else {
			$data = Manager::addUploadOptions($filename,'img');
			return self::PostManger($url,$data,$debug);			
		}
	}
	/**
	 * [IdCardInfo 行驶证识别接口]
	 * @author szjcomo
	 * @DateTime 2019-09-06T18:46:47+0800
	 * @param    string                   $access_token [description]
	 * @param    string                   $filename     [description]
	 * @param    string                   $host         [description]
	 */
	static function DrivingInfo(string $access_token,string $filename,string $host,$debug = false):array
	{
		$url = sprintf($host.self::DrivingResultURL,$access_token);
		if(self::isURL($filename)){
			return self::GetManger($url.'&img_url='.$filename);
		} else {
			$data = Manager::addUploadOptions($filename,'img');
			return self::PostManger($url,$data,$debug);			
		}
	}
	/**
	 * [IdCardInfo 驾驶证识别接口]
	 * @author szjcomo
	 * @DateTime 2019-09-06T18:46:47+0800
	 * @param    string                   $access_token [description]
	 * @param    string                   $filename     [description]
	 * @param    string                   $host         [description]
	 */
	static function DrivingLicenseInfo(string $access_token,string $filename,string $host,$debug = false):array
	{
		$url = sprintf($host.self::DrivingLicenseURL,$access_token);
		if(self::isURL($filename)){
			return self::GetManger($url.'&img_url='.$filename);
		} else {
			$data = Manager::addUploadOptions($filename,'img');
			return self::PostManger($url,$data,$debug);			
		}
	}
	/**
	 * [IdCardInfo 营业执照接口]
	 * @author szjcomo
	 * @DateTime 2019-09-06T18:46:47+0800
	 * @param    string                   $access_token [description]
	 * @param    string                   $filename     [description]
	 * @param    string                   $host         [description]
	 */
	static function BizlicenseInfo(string $access_token,string $filename,string $host,$debug = false):array
	{
		$url = sprintf($host.self::BizlicenseURL,$access_token);
		if(self::isURL($filename)){
			return self::GetManger($url.'&img_url='.$filename);
		} else {
			$data = Manager::addUploadOptions($filename,'img');
			return self::PostManger($url,$data,$debug);			
		}
	}
	/**
	 * [isURL 判断是否url地址]
	 * @author szjcomo
	 * @DateTime 2019-09-07T18:36:28+0800
	 * @param    string                   $urlstr [description]
	 * @return   boolean                          [description]
	 */
	static function isURL(string $urlstr):bool
	{
		$pattern="#(http|https)://(.*\.)?.*\..*#i";
		if(preg_match($pattern,$urlstr)){ 
			return true;
		} else { 
			return false;
		}
	}

}
