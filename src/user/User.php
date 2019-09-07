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
namespace szjcomo\phpwechat\user;
use szjcomo\phputils\Tools;
use szjcomo\phpwechat\Reshandler;

/**
 * 微信用户管理接口
 */
Class User{

	use Reshandler;

	/**
	 * 用户标签管理接口
	 */
	Protected const AddUserTagsURL 		= 'tags/create?access_token=%s';
	/**
	 * 获取已创建的标签接口
	 */
	Protected const GetUserTagsURL 		= 'tags/get?access_token=%s';
	/**
	 * 编辑标签接口
	 */
	Protected const SaveUserTagsURL 	= 'tags/update?access_token=%s';
	/**
	 * 编辑标签接口
	 */
	Protected const DelUserTagesURL 	= 'tags/delete?access_token=%s';
	/**
	 * 获取标签下粉丝列表
	 */
	Protected const GetTagUserListURL 	= 'user/tag/get?access_token=%s';
	/**
	 * 批量为用户打标签
	 */
	Protected const BatchUserTagsURL 	= 'tags/members/batchtagging?access_token=%s';
	/**
	 * 批量为用户取消标签
	 */
	Protected const CancelUserTagsURL 	= 'tags/members/batchuntagging?access_token=%s';
	/**
	 * 获取用户身上的标签列表
	 */
	Protected const GetUserTagsInfoURL 	= 'tags/getidlist?access_token=%s';
	/**
	 * 获取用户基本信息
	 */
	Protected const GetUserInfoURL 		= 'user/info?access_token=%s&openid=%s&lang=zh_CN';
	/**
	 * 批量获取用户基本信息
	 */
	Protected const GetMoreUersInfoURL 	= 'user/info/batchget?access_token=%s';
	/**
	 * 获取用户列表
	 */
	Protected const GetUsersListURL 	= 'user/get?access_token=%s&next_openid=%s';

	/**
	 * [GetUserTags 获取所有的标签]
	 * @author szjcomo
	 * @DateTime 2019-09-05T15:35:52+0800
	 * @param    string                   $access_token [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetUserTags(string $access_token,string $host = null,$debug = false):array
	{
		$url = sprintf($host.self::GetUserTagsURL,$access_token);
		return self::GetManger($url,$debug);
	}
	/**
	 * [AddUserTags 设置标签]
	 * @author szjcomo
	 * @DateTime 2019-09-05T15:36:06+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function AddUserTags(string $access_token,array $data = [],string $host = null,$debug = false):array
	{
		$url = sprintf($host.self::AddUserTagsURL,$access_token);
		return self::PostManger($url,json_encode(['tag'=>$data],JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [SaveUserTags 编辑标签]
	 * @author szjcomo
	 * @DateTime 2019-09-05T15:36:18+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function SaveUserTags(string $access_token,array $data = [],string $host = null,$debug = false):array
	{
		$url = sprintf($host.self::SaveUserTagsURL,$access_token);
		return self::PostManger($url,json_encode(['tag'=>$data],JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [DelUserTag 删除标签]
	 * @author szjcomo
	 * @DateTime 2019-09-05T15:36:45+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function DelUserTag(string $access_token,array $data = [],string $host = null,$debug = false):array
	{
		$url = sprintf($host.self::DelUserTagesURL,$access_token);
		return self::PostManger($url,json_encode(['tag'=>$data],JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [GetTagUsersList 获取标签下用户列表]
	 * @author szjcomo
	 * @DateTime 2019-09-05T15:36:57+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetTagUsersList(string $access_token,array $data = [],string $host = null,$debug = false):array
	{
		$url = sprintf($host.self::GetTagUserListURL,$access_token);
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [BatchUserTags 批量为用户打标签]
	 * @author szjcomo
	 * @DateTime 2019-09-05T15:46:14+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function BatchUserTags(string $access_token,array $data = [],string $host = null,$debug = false):array
	{
		$url = sprintf($host.self::BatchUserTagsURL,$access_token);
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [BatchCancelTags 批量取消用户标签]
	 * @author szjcomo
	 * @DateTime 2019-09-05T17:40:26+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function BatchCancelTags(string $access_token,array $data = [],string $host = null,$debug = false):array
	{
		$url = sprintf($host.self::CancelUserTagsURL,$access_token);
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [GetUserTagList 获取用户标签列表]
	 * @author szjcomo
	 * @DateTime 2019-09-05T18:22:29+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetUserTagList(string $access_token,array $data = [],string $host = null,$debug = false):array
	{
		$url = sprintf($host.self::GetUserTagsInfoURL,$access_token);
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [UserInfo 获取用户详情]
	 * @author szjcomo
	 * @DateTime 2019-09-05T18:42:19+0800
	 * @param    string                   $access_token [description]
	 * @param    string                   $openid       [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function UserInfo(string $access_token,string $openid,string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetUserInfoURL,$access_token,$openid);
		return self::GetManger($url,$debug);
	}
	/**
	 * [BatchUserInfo 批量获取用户信息]
	 * @author szjcomo
	 * @DateTime 2019-09-05T18:45:38+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function BatchUserInfo(string $access_token,array $data,string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetMoreUersInfoURL,$access_token);
		return self::PostManger($url,json_encode(['user_list'=>$data],JSON_UNESCAPED_UNICODE),[],$debug);
	}
	/**
	 * [GetUserList 获取用户列表]
	 * @author szjcomo
	 * @DateTime 2019-09-05T18:58:46+0800
	 * @param    string                   $access_token [description]
	 * @param    string                   $openid       [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetUserList(string $access_token,string $openid = '',string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetUsersListURL,$access_token,$openid);
		return self::GetManger($url,$debug);
	}

}

