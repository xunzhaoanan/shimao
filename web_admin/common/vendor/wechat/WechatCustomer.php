<?php
/**
 * 微信公众平台多客服
 * Author: MaChenghang
 * Date: 2015/06/20
 * Time: 11:47
 */

namespace common\vendor\wechat;

use common\vendor\wechat\wechat_sdk\Wechat;

class WechatCustomer
{

    protected $wechatSDK ;

    function __construct($options){
        $this->wechatSDK = new Wechat($options);
    }

    /**
     * 获取多客服会话状态推送事件 - 接入会话
     * 当Event为 kfcreatesession 即接入会话
     * @return string | boolean  返回分配到的客服
     */
    public function getRevKFCreate(){
            return $this->wechatSDK->getRevKFCreate();
    }

    /**
     * 获取多客服会话状态推送事件 - 关闭会话
     * 当Event为 kfclosesession 即关闭会话
     * @return string | boolean  返回分配到的客服
     */
    public function getRevKFClose(){
        return $this->wechatSDK->getRevKFClose();
    }

    /**
     * 获取多客服会话状态推送事件 - 转接会话
     * 当Event为 kfswitchsession 即转接会话
     * @return array | boolean  返回分配到的客服
     * {
     *     'FromKfAccount' => '',      //原接入客服
     *     'ToKfAccount' => ''            //转接到客服
     * }
     */
    public function getRevKFSwitch(){
        return $this->wechatSDK->getRevKFSwitch();
    }

    /**
     * 发送客服消息
     * @param array $data 消息结构{"touser":"OPENID","msgtype":"news","news":{...}}
     * @return boolean|array
     */
    public function sendCustomMessage($data){
        return $this->wechatSDK->sendCustomMessage($data);
    }

    /**
     * 获取多客服会话记录
     * @param array $data 数据结构{"starttime":123456789,"endtime":987654321,"openid":"OPENID","pagesize":10,"pageindex":1,}
     * @return boolean|array
     */
    public function getCustomServiceMessage($data){
        return $this->wechatSDK->getCustomServiceMessage($data);
    }

    /**
     * 转发多客服消息
     * Example: $obj->transfer_customer_service($customer_account)->reply();
     * @param string $customer_account 转发到指定客服帐号：test1@test
     */
    public function transfer_customer_service($customer_account = '')
    {
       return $this->wechatSDK->transfer_customer_service($customer_account);
    }

    /**
     * 获取多客服客服基本信息
     *
     * @return boolean|array
     */
    public function getCustomServiceKFlist(){
        return $this->wechatSDK->getCustomServiceKFlist();
    }

    /**
     * 获取多客服在线客服接待信息
     *
     * @return boolean|array {
    "kf_online_list": [
    {
    "kf_account": "test1@test",	//客服账号@微信别名
    "status": 1,			//客服在线状态 1：pc在线，2：手机在线,若pc和手机同时在线则为 1+2=3
    "kf_id": "1001",		//客服工号
    "auto_accept": 0,		//客服设置的最大自动接入数
    "accepted_case": 1		//客服当前正在接待的会话数
    }
    ]
    }
     */
    public function getCustomServiceOnlineKFlist(){
        return $this->wechatSDK->getCustomServiceOnlineKFlist();
    }

    /**
     * 创建指定多客服会话
     * @tutorial 当用户已被其他客服接待或指定客服不在线则会失败
     * @param string $openid           //用户openid
     * @param string $kf_account     //客服账号
     * @param string $text                 //附加信息，文本会展示在客服人员的多客服客户端，可为空
     * @return boolean | array            //成功返回json数组
     * {
     *   "errcode": 0,
     *   "errmsg": "ok",
     * }
     */
    public function createKFSession($openid,$kf_account,$text=''){
        return $this->wechatSDK->createKFSession($openid,$kf_account,$text);
    }

    /**
     * 关闭指定多客服会话
     * @tutorial 当用户被其他客服接待时则会失败
     * @param string $openid           //用户openid
     * @param string $kf_account     //客服账号
     * @param string $text                 //附加信息，文本会展示在客服人员的多客服客户端，可为空
     * @return boolean | array            //成功返回json数组
     * {
     *   "errcode": 0,
     *   "errmsg": "ok",
     * }
     */
    public function closeKFSession($openid,$kf_account,$text=''){
        return $this->wechatSDK->closeKFSession($openid,$kf_account,$text);
    }

    /**
     * 获取用户会话状态
     * @param string $openid           //用户openid
     * @return boolean | array            //成功返回json数组
     * {
     *     "errcode" : 0,
     *     "errmsg" : "ok",
     *     "kf_account" : "test1@test",    //正在接待的客服
     *     "createtime": 123456789,        //会话接入时间
     *  }
     */
    public function getKFSession($openid){
        return $this->wechatSDK->getKFSession($openid);
    }

    /**
     * 获取指定客服的会话列表
     * @param string $openid           //用户openid
     * @return boolean | array            //成功返回json数组
     *  array(
     *     'sessionlist' => array (
     *         array (
     *             'openid'=>'OPENID',             //客户 openid
     *             'createtime'=>123456789,  //会话创建时间，UNIX 时间戳
     *         ),
     *         array (
     *             'openid'=>'OPENID',             //客户 openid
     *             'createtime'=>123456789,  //会话创建时间，UNIX 时间戳
     *         ),
     *     )
     *  )
     */
    public function getKFSessionlist($kf_account){
        return $this->wechatSDK->getKFSessionlist($kf_account);
    }

    /**
     * 获取未接入会话列表
     * @param string $openid           //用户openid
     * @return boolean | array            //成功返回json数组
     *  array (
     *     'count' => 150 ,                            //未接入会话数量
     *     'waitcaselist' => array (
     *         array (
     *             'openid'=>'OPENID',             //客户 openid
     *             'kf_account ' =>'',                   //指定接待的客服，为空则未指定
     *             'createtime'=>123456789,  //会话创建时间，UNIX 时间戳
     *         ),
     *         array (
     *             'openid'=>'OPENID',             //客户 openid
     *             'kf_account ' =>'',                   //指定接待的客服，为空则未指定
     *             'createtime'=>123456789,  //会话创建时间，UNIX 时间戳
     *         )
     *     )
     *  )
     */
    public function getKFSessionWait(){
        return $this->wechatSDK->getKFSessionWait();
    }

    /**
     * 添加客服账号
     *
     * @param string $account      //完整客服账号，格式为：账号前缀@公众号微信号，账号前缀最多10个字符，必须是英文或者数字字符
     * @param string $nickname     //客服昵称，最长6个汉字或12个英文字符
     * @param string $password     //客服账号明文登录密码，会自动加密
     * @return boolean|array
     * 成功返回结果
     * {
     *   "errcode": 0,
     *   "errmsg": "ok",
     * }
     */
    public function addKFAccount($account,$nickname,$password){
        return $this->wechatSDK->addKFAccount($account,$nickname,$password);
    }

    /**
     * 修改客服账号信息
     *
     * @param string $account      //完整客服账号，格式为：账号前缀@公众号微信号，账号前缀最多10个字符，必须是英文或者数字字符
     * @param string $nickname     //客服昵称，最长6个汉字或12个英文字符
     * @param string $password     //客服账号明文登录密码，会自动加密
     * @return boolean|array
     * 成功返回结果
     * {
     *   "errcode": 0,
     *   "errmsg": "ok",
     * }
     */
    public function updateKFAccount($account,$nickname,$password){
        return $this->wechatSDK->updateKFAccount($account,$nickname,$password);
    }

    /**
     * 删除客服账号
     *
     * @param string $account      //完整客服账号，格式为：账号前缀@公众号微信号，账号前缀最多10个字符，必须是英文或者数字字符
     * @return boolean|array
     * 成功返回结果
     * {
     *   "errcode": 0,
     *   "errmsg": "ok",
     * }
     */
    public function deleteKFAccount($account){
        return $this->wechatSDK->deleteKFAccount($account);
    }

    /**
     * 上传客服头像
     *
     * @param string $account //完整客服账号，格式为：账号前缀@公众号微信号，账号前缀最多10个字符，必须是英文或者数字字符
     * @param string $imgfile //头像文件完整路径,如：'D:\user.jpg'。头像文件必须JPG格式，像素建议640*640
     * @return boolean|array
     * 成功返回结果
     * {
     *   "errcode": 0,
     *   "errmsg": "ok",
     * }
     */
    public function setKFHeadImg($account,$imgfile){
        return $this->wechatSDK->setKFHeadImg($account,$imgfile);
    }



}
