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
namespace szjcomo\phpwechat\media;
use szjcomo\phputils\Tools;
use szjcomo\phpwechat\Reshandler;
use Swoole\Coroutine;

/**
 * 微信素材管理
 */
Class Manager {

	use Reshandler;
	/**
	 * 新增临时素材接口地址
	 */
	Protected const AddTempUploadURL 		= 'media/upload?access_token=%s&type=%s';
	/**
	 * 获取临时素材接口地址
	 */
	Protected const GetTempUploadURL 		= 'media/get?access_token=%s&media_id=%s';
	/**
	 * 获取JSSDK上传的临时素材地址
	 */
	Protected const GetJssdkUploadURL 		= 'media/get/jssdk?access_token=%s&media_id=%s';
	/**
	 * 新增图文永久素材接口地址
	 */
	Protected const AddMaterialNewsURL		= 'material/add_news?access_token=%s';
	/**
	 * 上传图文消息内的图片获取URL
	 */
	Protected const AddMaterialNews1URL 	= 'media/uploadimg?access_token=%s';
	/**
	 * 新增其他类型永久素材
	 */
	Protected const AddMaterialUploadURL	= 'material/add_material?access_token=%s&type=%s';
	/**
	 * 获取永久素材
	 */
	Protected const GetMaterialURL 			= 'material/get_material?access_token=%s';
	/**
	 * 删除永久素材
	 */
	Protected const DelMaterialURL 			= 'material/del_material?access_token=%s';
	/**
	 * 更新永久图文素材
	 */
	Protected const UpdateNewsMaterialURL	= 'material/update_news?access_token=%s';
	/**
	 * 获取永久素材总数
	 */
	Protected const GetMaterialCountURL 	= 'material/get_materialcount?access_token=%s';
	/**
	 * 获取永久素材列表
	 */
	Protected const GetMaterialListURL 		= 'material/batchget_material?access_token=%s';
	/**
	 * [getMaterCount 获取永久素材总数]
	 * @author szjcomo
	 * @DateTime 2019-09-02T17:59:59+0800
	 * @param    string|null              $access_token [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 * @return   [type]                                 [description]
	 */
	static function getMaterCount(string $access_token,string $host,$debug = false):array
	{
		$url = sprintf($host.self::GetMaterialCountURL,$access_token);
		return self::GetManger($url,$debug);
	}
	/**
	 * [addMaterialNews 新增图文素材]
	 * @author szjcomo
	 * @DateTime 2019-09-03T10:22:41+0800
	 * @param    string|null              $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function addMaterialNews(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::AddMaterialNewsURL,$access_token);
		$baseOptions = [
			'author'=>'szjcomo','digest'=>'这是一个测试的图文消息内容','show_cover_pic'=>true,
			'content_source_url'=>'http://www.sizhijie.com','need_open_comment'=>0,'only_fans_can_comment'=>1
		];
		$articles = [];
		foreach($data as $key=>$val){$articles[$key] = array_merge($baseOptions,$val);}
		$options = ['articles'=>$articles];
		return self::PostManger($url,json_encode($options,JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [updateMaterialNews 更新永久图文素材]
	 * @author szjcomo
	 * @DateTime 2019-09-03T10:35:57+0800
	 * @param    string|null              $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 * @return   [type]                                 [description]
	 */
	static function updateMaterialNews(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$url = sprintf($host.self::UpdateNewsMaterialURL,$access_token);
		$baseOptions = [
			'author'=>'szjcomo','digest'=>'这是一个测试的图文消息内容','show_cover_pic'=>true,
			'content_source_url'=>'http://www.sizhijie.com','need_open_comment'=>0,'only_fans_can_comment'=>1
		];
		$data['articles'] = array_merge($baseOptions,$data['articles']);
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}

	/**
	 * [deleteMaterial 删除永久素材]
	 * @author szjcomo
	 * @DateTime 2019-09-03T09:53:31+0800
	 * @param    string|null              $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 * @return   [type]                                 [description]
	 */
	static function deleteMaterial(string $access_token,array $data = [],string $host,$debug = false) :array
	{
		$url = sprintf($host.self::DelMaterialURL,$access_token);
		return self::PostManger($url,json_encode($data,JSON_UNESCAPED_UNICODE),$debug);
	}

	/**
	 * [getMaterList 获取永久素材列表]
	 * @author szjcomo
	 * @DateTime 2019-09-02T18:11:43+0800
	 * @param    string|null              $access_token [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 * @return   [type]                                 [description]
	 */
	static function getMaterList(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$map = array_merge(['type'=>'image','offset'=>0,'count'=>19],$data);
		$url = sprintf($host.self::GetMaterialListURL,$access_token);
		return self::PostManger($url,json_encode($map,JSON_UNESCAPED_UNICODE),$debug);
	}
	/**
	 * [addTempUpload 上传临时素材]
	 * @author szjcomo
	 * @DateTime 2019-09-02T18:50:14+0800
	 * @param    string|null              $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function addTempUpload(string $access_token,array $data = [],string $host,$debug = false):array
	{
		$type = isset($data['type'])?$data['type']:'image';
		$url = sprintf($host.self::AddTempUploadURL,$access_token,$type);
		if(isset($data['filename']) && file_exists($data['filename'])){
			$media = self::addUploadOptions($data['filename']);
			return self::PostManger($url,$media,$debug);
		} else {
			return Tools::appResult('需要上传的文件不存在');
		}
	}
	/**
	 * [addMaterial 新增永久素材接口]
	 * @author szjcomo
	 * @DateTime 2019-09-02T19:09:11+0800
	 * @param    string|null              $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 */
	static function addMaterial(string $access_token = null,array $data = [],string $host = null,$debug = false):array
	{
		$type = isset($data['type'])?$data['type']:'image';
		$url = sprintf($host.self::AddMaterialUploadURL,$access_token,$type);
		if(isset($data['filename']) && file_exists($data['filename'])){
			$media = self::addUploadOptions($data['filename']);
			if($data['type'] == 'video'){
				$media['description'] = urldecode(json_encode($data['description']));
			}
			return self::PostManger($url,$media,$debug);
		} else {
			return Tools::appResult('需要上传的文件不存在');
		}
	}
	/**
	 * [getTempUpload 获取临时素材]
	 * @author szjcomo
	 * @DateTime 2019-09-02T19:05:20+0800
	 * @param    string|null              $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 * @return   [type]                                 [description]
	 */
	static function getTempUpload(string $access_token,array $data = [],string $host,$debug = false):array
	{
		try{
			$url = sprintf($host.self::GetTempUploadURL,$access_token,$data['media_id']);
			$res = Tools::curl_get($url,[],$debug);
			if(isset($data['savepath'])){
				$len = file_put_contents($data['savepath'], $res);
				if(empty($len)) return Tools::appResult('file save fail');
				return Tools::appResult('SUCCESS',$len,false);
			} else {
				return Tools::appResult('请输入需要保存的文件名');
			}
		} catch(\Throwable $err){
			return Tools::appResult($err->getMessage());
		}
	}
	/**
	 * [getMaterial 获取永久素材信息]
	 * @author szjcomo
	 * @DateTime 2019-09-02T19:13:11+0800
	 * @param    string|null              $access_token [description]
	 * @param    array                    $data         [description]
	 * @param    string|null              $host         [description]
	 * @param    boolean                  $debug        [description]
	 * @return   [type]                                 [description]
	 */
	static function getMaterial(string $access_token,array $data = [],string $host,$debug = false):array
	{
		try{
			$url = sprintf($host.self::GetMaterialURL,$access_token);
			$res = Tools::curl_post($url,json_encode($data),[],$debug);
			if(isset($data['savepath'])){
				$len = file_put_contents($data['savepath'], $res);
				if(empty($len)) return Tools::appResult('file save fail');
				return Tools::appResult('SUCCESS',$len,false);
			} else {
				return Tools::appResult('请输入需要保存的文件名');
			}
		} catch(\Throwable $err){
			return Tools::appResult($err->getMessage());
		}
	}

	/**
	 * [addUploadOptions 生成素材上传参数]
	 * @author szjcomo
	 * @DateTime 2019-09-02T18:53:01+0800
	 * @param    string                   $fileName [description]
	 */
	static function addUploadOptions(string $fileName = '',$name = 'media'):array
	{
		if (class_exists('\CURLFile')) {
			$data = array($name => new \CURLFile(realpath($fileName)));
		} else {
			$data = array($name => '@' . realpath($fileName));
		}
		return $data;
	}


}