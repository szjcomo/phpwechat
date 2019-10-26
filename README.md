# phpwechat
微信开发sdk
```
require './vendor/autoload.php';
use szjcomo\phpwechat\Wechat;
$appid = 'xxx';
$secret = 'xxx';


/**
 * 获取access_token的值 请自行保存并刷新
 */
$result = Wechat::getAccessToken($appid,$secret);

$access_token = 'xxx';
/**
 * 获取微信服务器列表
 */
$result = Wechat::getWeixinIpList($access_token);

// ==============================微信AI接口====================================
/**
 * 身份证识别
 */
$res = Wechat::ai($access_token,'xxx.jpg','idcard');
/**
 * 营业执照识别
 */
$res = Wechat::ai($access_token,'xxx.jpg','biz');


// ==============================客服管理接口====================================
/**
 * 获取公众号客服列表
 */
$res = Wechat::customer($access_token);
/**
 * 添加一个客服
 */
// $data = ['kf_account'=>'szj@xxx','nickname'=>'思智捷罗生'];
$res = Wechat::customer($access_token,$data,'add');
/**
 * 更新客服信息
 */
// $data = ['kf_account'=>'szj@xxx','nickname'=>'szjcomo'];
$res = Wechat::customer($access_token,$data,'save');
/**
 * 邀请客服人员
 */
// $data = ['kf_account'=>'szj@xxx','invite_wx'=>'xxx'];
$res = Wechat::customer($access_token,$data,'inv');
/**
 * 设置客服头像
 */
// $data = ['account'=>'szj@l15219840108','filename'=>'headimg.jpg'];
$res = Wechat::customer($access_token,$data,'headimg');
/**
 * 删除一个客服账号
 */
// $data = ['account'=>'szj@l15219840108'];
$res = Wechat::customer($access_token,$data,'del');
/**
 * 发送客服消息接口
 */
$data = [
	'touser'=>'okXHRwVqk39baIntOSADkiFLSNNQ','msgtype'=>'text',
	'text'=>['content'=>'消息内容']
];
$res = Wechat::customer($access_token,$data,'message');

// ==============================微信网页开发接口====================================

$code = 'xxx';
$appid = 'xxx';
$secret = 'xxx';
/**
 * 获取用户授权的access_token 和用户的openid 以及 refresh_token
 */
$result = Wechat::web($appid,$secret,'token',$code);
/**
 * 获取用户详细信息 此处的access_token是用户授权后获取的access_token 并非公众号的那个access_token
 */
$openid = 'oSF4duIAfTLdEMukzNOpYPAuJxEo'; 
$access_token = 'xxx';
$result = Wechat::web($access_token,$openid,'info');
/**
 * 检测用户授权的access_token是否过期
 */
$result = Wechat::web($access_token,$openid,'check');
/**
 * 刷新获取用户授权的access_token
 */
$refresh_token = 'xxx';
$result = bWechat::web($appid,$refresh_token,'refresh');
/**
 * 获取jssdk需要的ticket 此处的access_token 是公众号获取的不是个人授权的那个
 */
$access_token = 'xxx';
$result = Wechat::web($access_token,'','ticket');
/**
 * 获取jssdk签名
 */
$ticket = 'xxx';
$result = baseWechat::web($appid,$ticket,'sign','http://xxx.sizhijie.com/');


// ==============================二维码接口====================================
/**
 * 获取永久二维码
 */
$data = ['action_info'=>['scene'=>['scene_str'=>'szjcomo']]];
$res = Wechat::qrcode($access_token,$data,'long');
/**
 * 获取临时二维码
 */
$data = ['action_info'=>['scene'=>['scene_id'=>456]]];
$res = Wechat::qrcode($access_token,$data,'tmp');
/**
 * 下载二维码
 */
$ticket = 'xxx';
$savepath = './xxx.jpg';
$res = Wechat::qrcode($ticket,$savepath,'get');
/**
 * 长链接转短链接
 */
$res = Wechat::qrcode($access_token,'https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1443433600','url');

// ==============================数据统计接口====================================
/**
 * 获取用户总数
 */
$res = Wechat::data($access_token);
/**
 * 获取指定时间段时用户总数
 */
// $data = ['begin_date'=>'xxx-xx-xx','end_date'=>'xxxx-xx-xx'];
$data = [];
$res = Wechat::data($access_token,$data,'usertime');
/**
 * 获取指定日期推送的图文信息
 */
// $data = ['begin_date'=>'xxx-xx-xx','end_date'=>'xxxx-xx-xx'];
$data = [];
$res = baseWechat::data($access_token,$data,'newstime');
/**
 * 获取图文群发每日数据
 */
// $data = ['begin_date'=>'xxx-xx-xx','end_date'=>'xxxx-xx-xx'];
$data = [];
$res = baseWechat::data($access_token,$data,'newstime');
/**
 * 获取图文群发总数据
 */
// $data = ['begin_date'=>'xxx-xx-xx','end_date'=>'xxxx-xx-xx'];
$data = [];
$res = Wechat::data($access_token,$data,'news');
/**
 * 获取图文统计数据 $data = 同上
 */
$res = Wechat::data($access_token,$data,'total');
/**
 * 获取图文统计分时数据 $data = 同上
 */
$res = Wechat::data($access_token,$data,'hour');
/**
 * 获取图文分享转发数据 $data = 同上
 */
$res = Wechat::data($access_token,$data,'share');
/**
 * 获取图文分享转发分时数据 $data = 同上
 */
$res = Wechat::data($access_token,$data,'hourshare');
/**
 * 获取消息发送概况数据 $data = 同上
 */
$res = Wechat::data($access_token,[],'message');
/**
 * 获取消息分送分时数据 $data = 同上
 */
$res = Wechat::data($access_token,[],'messagehour');
/**
 * 获取消息发送周数据 $data = 同上
 */
$res = Wechat::data($access_token,[],'messageweek');
/**
 * 获取消息发送月数据 $data = 同上
 */
$res = Wechat::data($access_token,[],'messagemonth');
/**
 * 获取消息发送分布数据 $data = 同上
 */
$res = Wechat::data($access_token,[],'messagedist');
/**
 * 获取消息发送分布周数据 $data = 同上
 */
$res = Wechat::data($access_token,[],'messageweekdist');
/**
 * 获取消息发送分布月数据 $data = 同上
 */
$res = Wechat::data($access_token,[],'messagemonthdist');
/**
 * 获取接口分析数据
 */
$res = baseWechat::data($access_token,[],'interface');
/**
 * 获取接口分析分时数据
 */
$res = baseWechat::data($access_token,[],'interfacehour');

// ==============================用户管理接口====================================
/**
 * 获取标签列表
 */
$res = Wechat::user($access_token,null,'tags');
/**
 * 添加标签
 */
$res = Wechat::user($access_token,['name'=>'忠实粉丝'],'addtag');
/**
 * 编辑标签
 */
$res = Wechat::user($access_token,['id'=>100,'name'=>'老铁'],'savetag');
/**
 * 删除标签
 */
$res = Wechat::user($access_token,['id'=>100],'deltag');
/**
 * 获取标签下用户列表
 */
$res = Wechat::user($access_token,['tagid'=>2],'usertag');
/**
 * 批量给用户打标签
 */
$res = Wechat::user($access_token,['openid_list'=>['oSF4duGdMCd4q-kthyYjwCQl8DHI','oSF4duAEZkskbPmuKXbFQB2_RyzM'],'tagid'=>2],'batchtag');
/**
 * 批量取消用户标签
 */
$res = Wechat::user($access_token,['openid_list'=>['oSF4duGdMCd4q-kthyYjwCQl8DHI','oSF4duAEZkskbPmuKXbFQB2_RyzM'],'tagid'=>2],'canceltag');
/**
 * 获取用户标签列表
 */
$res = Wechat::user($access_token,['openid'=>'oSF4duIAfTLdEMukzNOpYPAuJxEo'],'taguser');
/**
 * 获取单用户基本信息
 */
$res = Wechat::user($access_token,'oSF4duIAfTLdEMukzNOpYPAuJxEo','info');
/**
 * 获取多用户基本信息
 */
$res = Wechat::user($access_token,['oSF4duIAfTLdEMukzNOpYPAuJxEo','oSF4duIAfTLdEMukzNOpYPAuJxEo'],'info');
/**
 * 获取公众号用户列表
 */
$openid = '';//不填默认从头开始拉取
$res = Wechat::user($access_token,$openid);

// ==============================素材管理接口====================================
/**
 * 获取永久素材列表
 */
$result = Wechat::material($access_token,['type'=>'image','offset'=>0,'count'=>20],'list');
/**
 * 获取永久素材总数
 */
$result = Wechat::material($access_token,[],'count');
/**
 * 获取单个永久素材信息
 */
$result = Wechat::material($access_token,['media_id'=>'xxx','savepath'=>'./hello.png'],'get');
/**
 * 新增临时素材信息
 */
$result = Wechat::material($access_token,['type'=>'image','filename'=>'public/123.jpg'],'addtmp');
/**
 * 获取临时素材信息
 */
$result = Wechat::::material($access_token,['media_id'=>'n8dPBhv6-G2JqHcSOpNFYBnfoqmC60dKEVMTd26II7LVXeFAS_GwNZ_72ASsU9Z7','savepath'=>'public/456.jpg'],'gettmp');
/**
 * 新增永久素材信息
 */
$result = Wechat::material($access_token,['type'=>'image','filename'=>'public/456.jpg'],'add');
/**
 * 删除永久素材
 */
$result = Wechat::material($access_token,['media_id'=>'Oi7l9egxpX1GgIzJNeXWg1Vz-YBoKWcYYQnF03pzIsQ'],'del');
/**
 * 新增图文素材
 */
$data = [
	[
		'title'=>'测试新增图文',
		'thumb_media_id'=>'xxx',
		'author'=>'szjcomo',
		'digest'=>'这是一个测试的图文消息内容',
		'content'=>'这是一个测试的图文消息内容',
	]
];
$result = baseWechat::material($access_token,$data,'addnews');

/**
 * 编辑图文素材
 */
$data = [
	'articles'=>[
		'title'=>'这是一个修改后的图文消息',
		'thumb_media_id'=>'xxx',
		'author'=>'szjcomo',
		'digest'=>'这是一个测试的图文消息内容',
		'content'=>'不知道这样写可以不',
	],
	'media_id'=>'xxx',
	'index'=>0
];
$result = baseWechat::material($access_token,$data,'savenews');

// ==============================自定义菜单接口====================================
$menu = [
	'button'=>[
		['type'=>'click','name'=>'今日歌曲','key'=>'V1001_TODAY_MUSIC'],
		['name'=>'菜单导航','sub_button'=>[
			['type'=>'view','name'=>'搜索菜单','url'=>'http://www.baidu.com'],
			['type'=>'miniprogram','name'=>'小程序','url'=>'http://mp.weixin.qq.com','appid'=>'wx286b93c14bbf93aa','pagepath'=>'pages/lunar/index'],
			['type'=>'click','name'=>'赞一下我们','key'=>'V1001_GOOD']
		]]
	]
];
/**
 * 添加自定义菜单
 */
$res = Wechat::cusMenu($access_token,$menu,'add');
/**
 * 查询自定义菜单接口
 */
$res = Wechat::cusMenu($access_token);
/**
 * 删除自定义菜单接口
 */
$res = Wechat::cusMenu($access_token,[],'del');
/**
 * 查询自定义菜单配置
 */
$res = Wechat::cusMenu($access_token,[],'config');

// ==============================模版消息接口====================================
/**
 * 获取模版消息列表
 */
$res = Wechat::template($access_token,null,'list');
/**
 * 获取模版详情
 */
$template_id = 'xxx';
$res = Wechat::template($access_token,$template_id,'info');
/**
 * 获取行业设置信息
 */
$res = Wechat::template($access_token,null, 'industry');
/**
 * 发送模版消息
 */
$data = [
	'touser'=>'oSF4duIAfTLdEMukzNOpYPAuJxEo',
	'template_id'=>'0lVAeJntZFHi950PI-iHl08Fo2Uuoa3P2Hx_DRofbqg',
	'url'=>'http://www.sizhijie.com',
    /*"miniprogram"=>[
        "appid"=>"wx286b93c14bbf93aa",
        "pagepath"=>"pages/lunar/index"
    ],  */
	"data"=>[
		'name'=>['value'=>'罗生','color'=>'#173177'],
		'remark'=>['value'=>'皮鞋100元','color'=>'#ff0000']
	]
];
$result = Wechat::template($access_token,$data,'message');
/**
 * 删除模版
 */
$template_id = 'xxx';
$res = Wechat::template($access_token,$template_id,'del');

```