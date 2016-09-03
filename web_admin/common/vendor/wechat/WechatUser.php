<?php
/**
 * 微信公众平台用户管理
 * Author: MaChenghang
 * Date: 2015/06/20
 * Time: 11:47
 */

namespace common\vendor\wechat;

use common\vendor\wechat\wechat_sdk\Wechat;

class WechatUser
{

    protected $wechatSDK ;

    function __construct($options){
        $this->wechatSDK = new Wechat($options);
    }

    /**
     * 批量获取关注用户列表
     * @param unknown $next_openid
     */
    public function getUserList($next_openid=''){
        return $this->wechatSDK->getUserList($next_openid);
    }

    /**
     * 获取关注者详细信息
     * @param string $openid
     * @return array {subscribe,openid,nickname,sex,city,province,country,language,headimgurl,subscribe_time,[unionid]}
     * 注意：unionid字段 只有在用户将公众号绑定到微信开放平台账号后，才会出现。建议调用前用isset()检测一下
     */
    public function getUserInfo($openid){
        return $this->wechatSDK->getUserInfo($openid);
    }

    /**
     * 设置用户备注名
     * @param string $openid
     * @param string $remark 备注名
     * @return boolean|array
     */
    public function updateUserRemark($openid,$remark){
        return $this->wechatSDK->updateUserRemark($openid,$remark);
    }

    /**
     * 获取用户分组列表
     * @return boolean|array
     */
    public function getGroup(){
        return $this->wechatSDK->getGroup();
    }

    /**
     * 获取用户所在分组
     * @param string $openid
     * @return boolean|int 成功则返回用户分组id
     */
    public function getUserGroup($openid){
        return $this->wechatSDK->getUserGroup($openid);
    }

    /**
     * 新增自定分组
     * @param string $name 分组名称
     * @return boolean|array
     */
    public function createGroup($name){
        return $this->wechatSDK->createGroup($name);
    }

    /**
     * 更改分组名称
     * @param int $groupid 分组id
     * @param string $name 分组名称
     * @return boolean|array
     */
    public function updateGroup($groupid,$name){
        return $this->wechatSDK->updateGroup($groupid,$name);
    }

    /**
     * 移动用户分组
     * @param int $groupid 分组id
     * @param string $openid 用户openid
     * @return boolean|array
     */
    public function updateGroupMembers($groupid,$openid){
        return $this->wechatSDK->updateGroupMembers($groupid,$openid);
    }

    /**
     * 批量移动用户分组
     * @param int $groupid 分组id
     * @param string $openid_list 用户openid数组,一次不能超过50个
     * @return boolean|array
     */
    public function batchUpdateGroupMembers($groupid,$openid_list){
        return $this->wechatSDK->batchUpdateGroupMembers($groupid,$openid_list);
    }



}
