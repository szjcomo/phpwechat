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

namespace szjcomo\phpwechat
use szjcomo\szjcore\Controller;

/**
 * 微信sdk类
 */
Class Wechat extends Controller{

	/**
	 * [checkSignature 验证微信通信签名函数]
	 * @Author    como
	 * @DateTime  2019-03-22
	 * @copyright 思智捷管理系统
	 * @version   [1.5.0]
	 * @param     string     $token [description]
	 * @return    [type]            [description]
	 */
	Public static function checkSignature($token = ''){
		$echostr    = $this->context->get('echostr','');
        $signature 	= $this->context->get('signature','');
        $timestamp 	= $this->context->get('timestamp','');
        $nonce 		= $this->context->get('nonce','');
		$tmpArr 	= array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		return $tmpStr == $signature ? $echostr : 'not access';
	}

}


