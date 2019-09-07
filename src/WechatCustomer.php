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
 * 微信客服管理
 */
Class WechatCustomer {
	use Reshandler;
	/**
	 * 获取客服务列表
	 */
	Protected const GetCustomerListURL 	= 'customservice/getkflist?access_token=%s';
	/**
	 * 添加客服信息
	 */
	Protected const AddCustomerURL 		= 'customservice/kfaccount/add?access_token=%s';
	/**
	 * 更新客服信息
	 */
	Protected const SaveCustomerURL 	= 'customservice/kfaccount/update?access_token=%s';
	/**
	 * 邀请人员成为客服
	 */
	Protected const InvitationURL 		= 'customservice/kfaccount/inviteworker?access_token=%s';
	/**
	 * 上传客服头像
	 */
	Protected const UploadHeadImageURL  = 'customservice/kfaccount/uploadheadimg?access_token=%s&kf_account=%s';
	/**
	 * 删除一个客服账号
	 */
	Protected const DelCustomerURL 		= 'customservice/kfaccount/del?access_token=%s&kf_account=%s';
	/**
	 * 发送客服消息
	 */
	Protected const SendCustomerURL 	= 'message/custom/send?access_token=%s';

	/**
	 * [SendMessage 发送客服消息]
	 * @author szjcomo
	 * @DateTime 2019-09-07T17:01:27+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function SendMessage(string $access_token,array $data,string $host,$debug = false):array
	{
		$url = sprintf($host.self::SendCustomerURL,$access_token);
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}

	/**
	 * [GetCustomerList 删除客服信息]
	 * @author szjcomo
	 * @DateTime 2019-09-06T19:05:13+0800
	 * @param    string                   $access_token [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function DelCustomer(string $access_token,array $data,string $host,$debug = false):array
	{
		$url = sprintf($host.self::DelCustomerURL,$access_token,$data['account']);
		return self::GetManger($url,$debug);
	}

	/**
	 * [UploadHeadImage 上传客服头像]
	 * @author szjcomo
	 * @DateTime 2019-09-06T20:27:09+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function UploadHeadImage(string $access_token,array $data,string $host,$debug = false):array
	{
		$url = sprintf($host.self::UploadHeadImageURL,$access_token,$data['account']);
		$data = Manager::addUploadOptions($data['filename']);
		return self::PostManger($url,$data,$debug);
	}

	/**
	 * [GetCustomerList 获取客服列表]
	 * @author szjcomo
	 * @DateTime 2019-09-06T19:05:13+0800
	 * @param    string                   $access_token [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetCustomerList(string $access_token,string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetCustomerListURL,$access_token);
		return self::GetManger($url,$debug);
	}
	/**
	 * [AddCustomer 添加客服]
	 * @author szjcomo
	 * @DateTime 2019-09-06T19:51:02+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function AddCustomer(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::AddCustomerURL,$access_token);
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [SaveCustomer 添加客服]
	 * @author szjcomo
	 * @DateTime 2019-09-06T19:51:02+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function SaveCustomer(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::SaveCustomerURL,$access_token);
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [InvitationCustomer 邀请人员成为客服]
	 * @author szjcomo
	 * @DateTime 2019-09-06T19:51:02+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function InvitationCustomer(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::InvitationURL,$access_token);
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}
}
