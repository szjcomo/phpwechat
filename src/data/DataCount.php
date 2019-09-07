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

namespace szjcomo\phpwechat\data;
use szjcomo\phputils\Tools;
use szjcomo\phpwechat\Reshandler;
/**
 * 微信数据统计接口
 */
Class DataCount {

	use Reshandler;
	/**
	 * 获取用户总数量
	 */
	Protected const GetUserCountURL 		= 'datacube/getusercumulate?access_token=%s';
	/**
	 * 获取限定时间内用户数量情况
	 */
	Protected const GetUserTimeURL  		= 'datacube/getusersummary?access_token=%s';
	/**
	 * 获取图文群发每日数据
	 */
	Protected const GetNewsTodayURL 		= 'datacube/getarticlesummary?access_token=%s';
	/**
	 * 获取图文群发总数据
	 */
	Protected const GetNewsCountURL 		= 'datacube/getarticletotal?access_token=%s';
	/**
	 * 获取图文统计数据
	 */
	Protected const GetTotalNewsURL 		= 'datacube/getuserread?access_token=%s';
	/**
	 * 获取图文统计分时数据
	 */
	Protected const GetNewsHourURL  		= 'datacube/getuserreadhour?access_token=%s';
	/**
	 * 获取图文分享转发数据
	 */
	Protected const GetShareNewsURL 		= 'datacube/getusershare?access_token=%s';
	/**
	 * 获取图文分享转发分时数据
	 */
	Protected const GetShareHourNewsURL 	= 'datacube/getusersharehour?access_token=%s';
	/**
	 * 获取消息发送概况数据
	 */
	Protected const GetMessageCountURL 		= 'datacube/getupstreammsg?access_token=%s';
	/**
	 * 获取消息分送分时数据
	 */
	Protected const GetMessageHourURL 		= 'datacube/getupstreammsghour?access_token=%s';
	/**
	 * 获取消息发送周数据
	 */
	Protected const GetMessageWeekURL 		= 'datacube/getupstreammsgweek?access_token=%s';
	/**
	 * 获取消息发送月数据
	 */
	Protected const GetMessageMonthURL 		= 'datacube/getupstreammsgmonth?access_token=%s';
	/**
	 * 获取消息发送分布数据
	 */
	Protected const GetMessageDistURL  		= 'datacube/getupstreammsgdist?access_token=%s';
	/**
	 * 获取消息发送分布周数据
	 */
	Protected const GetMessageWeekDistURL 	= 'datacube/getupstreammsgdistweek?access_token=%s';
	/**
	 * 获取消息发送分布月数据
	 */
	Protected const GetMessageMonthDistURL 	= 'datacube/getupstreammsgdistmonth?access_token=%s';
	/**
	 * 获取接口统计数据
	 */
	Protected const GetInterfaceURL 		= 'datacube/getinterfacesummary?access_token=%s';
	/**
	 * 获取接口分析分时数据
	 */
	Protected const GetInterfaceHourURL 	= 'datacube/getinterfacesummaryhour?access_token=%s';

	/**
	 * [GetInterfaceData 获取接口分析分时数据]
	 * @author szjcomo
	 * @DateTime 2019-09-06T09:54:36+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetInterfaceHourData(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetInterfaceHourURL,$access_token);
		if(empty($data)){
			$data['end_date'] 	= date('Y-m-d',time() - 1*24*60*60);
			$data['begin_date'] = date('Y-m-d',time() - 1*24*60*60);
		}
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);			
	}

	/**
	 * [GetInterfaceData 获取接口分析数据]
	 * @author szjcomo
	 * @DateTime 2019-09-06T09:52:53+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetInterfaceData(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetInterfaceURL,$access_token);
		if(empty($data)){
			$data['end_date'] 	= date('Y-m-d',time() - 1*24*60*60);
			$data['begin_date'] = date('Y-m-d',time() - 30*24*60*60);
		}
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}


	/**
	 * [GetMessageMonthDistData 获取消息发送分布月数据]
	 * @author szjcomo
	 * @DateTime 2019-09-06T09:30:58+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetMessageMonthDistData(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetMessageMonthDistURL,$access_token);
		if(empty($data)){
			$data['end_date'] 	= date('Y-m-d',time() - 1*24*60*60);
			$data['begin_date'] = date('Y-m-d',time() - 30*24*60*60);
		}
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}

	/**
	 * [GetMessageWeekDistData 获取消息发送分布周数据]
	 * @author szjcomo
	 * @DateTime 2019-09-06T09:29:32+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetMessageWeekDistData(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetMessageWeekDistURL,$access_token);
		if(empty($data)){
			$data['end_date'] 	= date('Y-m-d',time() - 1*24*60*60);
			$data['begin_date'] = date('Y-m-d',time() - 30*24*60*60);
		}
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}

	/**
	 * [GetMessageDistData 获取消息发送分布数据]
	 * @author szjcomo
	 * @DateTime 2019-09-06T09:27:56+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetMessageDistData(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetMessageDistURL,$access_token);
		if(empty($data)){
			$data['end_date'] 	= date('Y-m-d',time() - 1*24*60*60);
			$data['begin_date'] = date('Y-m-d',time() - 15*24*60*60);
		}
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [GetMessageMonthData 获取消息发送月数据]
	 * @author szjcomo
	 * @DateTime 2019-09-06T09:26:31+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetMessageMonthData(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetMessageMonthURL,$access_token);
		if(empty($data)){
			$data['end_date'] 	= date('Y-m-d',time() - 1*24*60*60);
			$data['begin_date'] = date('Y-m-d',time() - 30*24*60*60);
		}
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}	
	/**
	 * [GetMessageHourData 获取消息发送周数据]
	 * @author szjcomo
	 * @DateTime 2019-09-06T09:24:17+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetMessageWeekData(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetMessageWeekURL,$access_token);
		if(empty($data)){
			$data['end_date'] 	= date('Y-m-d',time() - 1*24*60*60);
			$data['begin_date'] = date('Y-m-d',time() - 30*24*60*60);
		}
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [GetMessageData 获取消息分送分时数据]
	 * @author szjcomo
	 * @DateTime 2019-09-06T09:15:56+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetMessageHourData(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetMessageCountURL,$access_token);
		if(empty($data)){
			$data['end_date'] 	= date('Y-m-d',time() - 1*24*60*60);
			$data['begin_date'] = date('Y-m-d',time() - 1*24*60*60);
		}
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [GetMessageData 获取消息发送概况数据]
	 * @author szjcomo
	 * @DateTime 2019-09-06T09:15:56+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetMessageCountData(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetMessageCountURL,$access_token);
		if(empty($data)){
			$data['end_date'] 	= date('Y-m-d',time() - 1*24*60*60);
			$data['begin_date'] = date('Y-m-d',time() - 7*24*60*60);
		}
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}

	/**
	 * [GetShareNewsData 获取图文分享转发分时数据]
	 * @author szjcomo
	 * @DateTime 2019-09-06T08:46:47+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetShareHourNewsData(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetShareHourNewsURL,$access_token);
		if(empty($data)){
			$data['end_date'] 	= date('Y-m-d',time() - 1*24*60*60);
			$data['begin_date'] = date('Y-m-d',time() - 1*24*60*60);
		}
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}


	/**
	 * [GetShareNewsData 获取图文分享转发数据]
	 * @author szjcomo
	 * @DateTime 2019-09-06T08:46:47+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetShareNewsData(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetShareNewsURL,$access_token);
		if(empty($data)){
			$data['end_date'] 	= date('Y-m-d',time() - 1*24*60*60);
			$data['begin_date'] = date('Y-m-d',time() - 7*24*60*60);
		}
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}

	/**
	 * [GetHourNewsData GetNewsHourURL]
	 * @author szjcomo
	 * @DateTime 2019-09-06T08:42:52+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetHourNewsData(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetNewsHourURL,$access_token);
		if(empty($data)){
			$data['end_date'] 	= date('Y-m-d',time() - 1*24*60*60);
			$data['begin_date'] = date('Y-m-d',time() - 1*24*60*60);
		}
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}

	/**
	 * [GetTotalNewsData 获取图文统计数据]
	 * @author szjcomo
	 * @DateTime 2019-09-06T08:36:07+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetTotalNewsData(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetTotalNewsURL,$access_token);
		if(empty($data)){
			$data['end_date'] 	= date('Y-m-d',time() - 1*24*60*60);
			$data['begin_date'] = date('Y-m-d',time() - 3*24*60*60);
		}
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}

	/**
	 * [GetNewsData 获取图文群发每日数据]
	 * @author szjcomo
	 * @DateTime 2019-09-05T20:21:39+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetTodayNewsData(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetNewsTodayURL,$access_token);
		if(empty($data)){
			$data['end_date'] 	= date('Y-m-d',time() - 1*24*60*60);
			$data['begin_date'] = date('Y-m-d',time() - 1*24*60*60);
		}
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [GetNewsData 获取图文群发总数据]
	 * @author szjcomo
	 * @DateTime 2019-09-05T20:37:53+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetNewsData(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetNewsCountURL,$access_token);
		if(empty($data)){
			$data['end_date'] 	= date('Y-m-d',time() - 1*24*60*60);
			$data['begin_date'] = date('Y-m-d',time() - 1*24*60*60);
		}
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}


	/**
	 * [GetUserCountData 获取用户总量数据]
	 * @author szjcomo
	 * @DateTime 2019-09-05T19:39:52+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetUserCountData(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetUserCountURL,$access_token);
		if(empty($data)){
			$data['end_date'] 	= date('Y-m-d',time() - 1*24*60*60);
			$data['begin_date'] = date('Y-m-d',time() - 7*24*60*60);
		}
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [GetUserTimeData 获取限定时间内公众号用户数量信息]
	 * @author szjcomo
	 * @DateTime 2019-09-05T20:08:56+0800
	 * @param    string                   $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string                   $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function GetUserTimeData(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetUserTimeURL,$access_token);
		if(empty($data)){
			$data['end_date'] 	= date('Y-m-d',time() - 1*24*60*60);
			$data['begin_date'] = date('Y-m-d',time() - 7*24*60*60);
		}
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}

}

