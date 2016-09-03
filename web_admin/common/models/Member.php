<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/10
 * Time: 15:00
 * 会员类
 */
namespace common\models;

use common\cache\MemberCache;
use Yii;
use yii\base\Model;

/**
 * shop model
 */
class Member extends BaseModel
{
    # 已经关注公众号
    const ATTENTION = 1;

    # 还没有关注公众号
    const UN_ATTENTION = 2;

    protected $memberCache ;

    public function init()
    {
        $this->memberCache = new MemberCache();
    }

    /**
     * 创建会员
     * @return mixed
     */
    public function create($params)
    {
        $apiParams = [
            'wxUser' => [
                'open_id' => isset($params['open_id']) ? $params['open_id'] : null,
            ],
            'userInfo' => [
                'mobile' => isset($params['mobile']) ? $params['mobile'] : null,
                'province' => isset($params['province']) ? $params['province'] : null,
                'nickname' => isset($params['nickname']) ? $params['nickname'] : null,
                'sex' => isset($params['sex']) ? $params['sex'] : null,
                'city' => isset($params['city']) ? $params['city'] : null,
                'country' => isset($params['country']) ? $params['country'] : null,
                'headimgurl' => isset($params['headimgurl']) ? $params['headimgurl'] : null,
                'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
                'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
                'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
                'group_id' => isset($params['group_id']) ? $params['group_id'] : null,
                'password' => isset($params['password']) ? $params['password'] : null,
                'type' => isset($params['type']) ? $params['type'] : null,
                'status' => isset($params['status']) ? $params['status'] : null,
                'scene_id' => isset($params['scene_id']) ? $params['scene_id'] : null,
                'mpath' => isset($params['mpath']) ? $params['mpath'] : null,
                'mid' => isset($params['mid']) ? $params['mid'] : null,
                'is_subscribe' => isset($params['is_subscribe']) ? $params['is_subscribe'] : null,
                'level_id' => isset($params['level_id']) ? $params['level_id'] : null,
                'point' => isset($params['point']) ? $params['point'] : null,
                'wsh_code' => isset($params['wsh_code']) ? $params['wsh_code'] : null,
            ]
        ];
        $this->getResult('wx-user-create',$apiParams);
    }

    /**
     * 授权登陆
     * @return mixed
     */
    public function authorize($params)
    {
        $apiParams = [
            'wxUser' => [
                'open_id' => isset($params['open_id']) ? $params['open_id'] : null,
            ],
            'userInfo' => [
                'mobile' => isset($params['mobile']) ? $params['mobile'] : null,
                'province' => isset($params['province']) ? $params['province'] : null,
                'nickname' => isset($params['nickname']) ? $params['nickname'] : null,
                'sex' => isset($params['sex']) ? $params['sex'] : null,
                'city' => isset($params['city']) ? $params['city'] : null,
                'country' => isset($params['country']) ? $params['country'] : null,
                'headimgurl' => isset($params['headimgurl']) ? $params['headimgurl'] : null,
                'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
                'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
                'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
                'group_id' => isset($params['group_id']) ? $params['group_id'] : null,
                'password' => isset($params['password']) ? $params['password'] : null,
                'type' => isset($params['type']) ? $params['type'] : null,
                'status' => isset($params['status']) ? $params['status'] : null,
                'scene_id' => isset($params['scene_id']) ? $params['scene_id'] : null,
                'mpath' => isset($params['mpath']) ? $params['mpath'] : null,
                'mid' => isset($params['mid']) ? $params['mid'] : null,
                'is_subscribe' => isset($params['is_subscribe']) ? $params['is_subscribe'] : null,
                'level_id' => isset($params['level_id']) ? $params['level_id'] : null,
                'point' => isset($params['point']) ? $params['point'] : null,
                'wsh_code' => isset($params['wsh_code']) ? $params['wsh_code'] : null,
            ]
        ];
        $this->getResult('wx-user-authorize',$apiParams);
    }

    /**
     * 会员列表
     * @return mixed
     */
    public function find($params,$is_search = false)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'user_platform' => isset($params['user_platform']) ? $params['user_platform'] : null,
            'group_id' => isset($params['group_id']) ? $params['group_id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'nickname' => isset($params['nickname']) ? $params['nickname'] : null,
            'ids' => isset($params['ids']) ? $params['ids'] : null,
            'belong_to_staff_id' => isset($params['belong_to_staff_id']) ? $params['belong_to_staff_id'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
            'group_ids' => isset($params['group_ids']) ? $params['group_ids'] : null,
            'belongFilter' => isset($params['belongFilter']) ? $params['belongFilter'] : null
        ];
        $this->getResult('wx-user-list',$apiParams);
    }

    /**
     * 修改会员分组
     * @return mixed
     */
    public function update($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'group_id' => isset($params['group_id']) ? $params['group_id'] : null,
            'user_id' => isset($params['user_id']) ? $params['user_id'] : null,
        ];
        $this->getResult('wx-user-update',$apiParams);
    }

    /**
     * 用户登录
     * @return mixed
     */
    public function login($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'user_id' => isset($params['user_id']) ? $params['user_id'] : null,
            'lastlogintime' => isset($params['lastlogintime']) ? $params['lastlogintime'] : null,
            'lastloginip' => isset($params['lastloginip']) ? $params['lastloginip'] : null,
        ];
        $this->getResult('wx-user-login',$apiParams);
    }

    /**
     * 修改会员归属
     * @return mixed
     */
    public function updateMid($params)
    {
        //拿接口数据Mid
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
            'user_id' => isset($params['user_id']) ? $params['user_id'] : null
        ];
        $this->getResult('wx-user-update-mid',$apiParams);
    }

    /**
     * 获取用户信息
     * @return mixed
     */
    public function get($params)
    {
        //没有强制刷新参数才能缓存数据
        if( ! isset($params['isReflash'])){
            $data = $this->memberCache->getGet($params);
            if($data !== false){
                $this->setResult($data);
                return true;
            }
        }
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'user_id' => isset($params['user_id']) ? $params['user_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'belong_to_staff_id' => isset($params['belong_to_staff_id']) ? $params['belong_to_staff_id'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
        ];
        //pr($apiParams);
        $this->getResult('wx-user-get',$apiParams);
        //再从新设置缓存
        if ( ! is_null($this->_data)){
            $this->memberCache->setGet($params, $this->_data);
        }
    }

    /**
     * 根据open_id获取用户信息
     * @return mixed
     */
    public function getByOpenid($params)
    {
        $data = $this->memberCache->getGetByOpenid($params);
        if($data !== false){
            $this->setResult($data);
            return true;
        }
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'open_id' => isset($params['open_id']) ? $params['open_id'] : null,
        ];
        $this->getResult('wx-user-get-by-openid',$apiParams);
        //再从新设置缓存
        if ( ! is_null($this->_data)){
            $userData = $this->_data;
            $userInfo = $userData['userInfo'] ;
            unset($userData['userInfo']);
            $wxUsers['wxUsers'] =  $userData;
            $userData = array_merge($wxUsers,$userInfo);
            $this->setResult($userData);
            $this->memberCache->setGetByOpenid($params, $userData);
        }
    }

    /**
     * 用户关注公众号
     * @return mixed
     */
    public function attention($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'open_id' => isset($params['open_id']) ? $params['open_id'] : null,
            'mobile' => isset($params['mobile']) ? $params['mobile'] : null,
            'province' => isset($params['province']) ? $params['province'] : null,
            'nickname' => isset($params['nickname']) ? $params['nickname'] : null,
            'sex' => isset($params['sex']) ? $params['sex'] : null,
            'city' => isset($params['city']) ? $params['city'] : null,
            'country' => isset($params['country']) ? $params['country'] : null,
            'headimgurl' => isset($params['headimgurl']) ? $params['headimgurl'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'group_id' => isset($params['group_id']) ? $params['group_id'] : 1,
            'password' => isset($params['password']) ? $params['password'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'scene_id' => isset($params['scene_id']) ? $params['scene_id'] : null,
            'mpath' => isset($params['mpath']) ? $params['mpath'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
            'is_subscribe' => isset($params['is_subscribe']) ? $params['is_subscribe'] : 1,
            'level_id' => isset($params['level_id']) ? $params['level_id'] : null,
            'point' => isset($params['point']) ? $params['point'] : null,
            'wsh_code' => isset($params['wsh_code']) ? $params['wsh_code'] : null,
        ];
        $this->getResult('wx-user-attention',$apiParams);
    }

    /**
     * 同步用户关注公众号(无返回值)
     * @return mixed
     */
    public function attentionBackgroundSync($params)
    {
        if(isset($params['shop_id'])){
            $params['shop_id'] = explode(',', $params['shop_id']);
        }
        $this->getResult('wx-user-attention-sync',$params);
    }

    /**
     * 用户关注公众号(无返回值)
     * @return mixed
     */
    public function attentionBackground($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'open_id' => isset($params['open_id']) ? $params['open_id'] : null,
            'mobile' => isset($params['mobile']) ? $params['mobile'] : null,
            'province' => isset($params['province']) ? $params['province'] : null,
            'nickname' => isset($params['nickname']) ? $params['nickname'] : null,
            'sex' => isset($params['sex']) ? $params['sex'] : null,
            'city' => isset($params['city']) ? $params['city'] : null,
            'country' => isset($params['country']) ? $params['country'] : null,
            'headimgurl' => isset($params['headimgurl']) ? $params['headimgurl'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'group_id' => isset($params['group_id']) ? $params['group_id'] : 1,
            'password' => isset($params['password']) ? $params['password'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'scene_id' => isset($params['scene_id']) ? $params['scene_id'] : null,
            'mpath' => isset($params['mpath']) ? $params['mpath'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
            'is_subscribe' => isset($params['is_subscribe']) ? $params['is_subscribe'] : 1,
            'level_id' => isset($params['level_id']) ? $params['level_id'] : null,
            'point' => isset($params['point']) ? $params['point'] : null,
            'wsh_code' => isset($params['wsh_code']) ? $params['wsh_code'] : null,
        ];
        $this->postDataOnly('wx-user-attention',$apiParams);
    }
    /**
     * 用户取消关注公众号
     * @return mixed
     */
    public function unattention($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'open_id' => isset($params['open_id']) ? $params['open_id'] : null,
        ];
        $this->getResult('wx-user-unattention',$apiParams);
    }

    /**
     * 创建用户分组
     * @return mixed
     */
    public function createGroup($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'group_name' => isset($params['group_name']) ? $params['group_name'] : null,
            'sort' => isset($params['sort']) ? $params['sort'] : null,
            'group_id' => isset($params['group_id']) ? $params['group_id'] : null,
        ];
        $this->getResult('wx-user-group-create',$apiParams);
    }

    /**
     * 获取用户分类列表
     * @return mixed
     */
    public function findGroup($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('wx-user-group-list',$apiParams);
    }

    /**
     * 获取用户分类信息
     * @return mixed
     */
    public function getGroup($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'group_id' => isset($params['group_id']) ? $params['group_id'] : null,
        ];
        $this->getResult('wx-user-group-get',$apiParams);
    }

    /**
     * 修改用户分类信息
     * @return mixed
     */
    public function updateGroup($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'group_id' => isset($params['group_id']) ? $params['group_id'] : null,
            'group_name' => isset($params['group_name']) ? $params['group_name'] : null,
            'sort' => isset($params['sort']) ? $params['sort'] : null,
        ];
        $this->getResult('wx-user-group-update',$apiParams);
    }

    /**
     * 创建用户等级
     * @return mixed
     */
    public function createLevel($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'level_exp' => isset($params['level_exp']) ? $params['level_exp'] : null,
            'level_img_id' => isset($params['level_img_id']) ? $params['level_img_id'] : null,
            'user_level_policy_ids' => isset($params['user_level_policy_ids']) ? $params['user_level_policy_ids'] : null,
        ];
        $this->getResult('wx-user-get',$apiParams);
    }

    /**
     * 获取用户等级列表
     * @return mixed
     */
    public function findLevel($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('wx-user-get',$apiParams);
    }

    /**
     * 获取用户等级信息
     * @return mixed
     */
    public function getLevel($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'level_id' => isset($params['level_id']) ? $params['level_id'] : null,
        ];
        $this->getResult('wx-user-get',$apiParams);
    }

    /**
     * 修改用户等级信息
     * @return mixed
     */
    public function updateLevel($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'level_id' => isset($params['level_id']) ? $params['level_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'level_exp' => isset($params['level_exp']) ? $params['level_exp'] : null,
            'level_img_id' => isset($params['level_img_id']) ? $params['level_img_id'] : null,
            'user_level_policy_ids' => isset($params['user_level_policy_ids']) ? $params['user_level_policy_ids'] : null,
        ];
        $this->getResult('wx-user-get',$apiParams);
    }

    /**
     * 获取用户红包
     * @return mixed
     */
    public function getRedpack($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'user_id' => isset($params['user_id']) ? $params['user_id'] : null,
        ];
        $this->getResult('wx-user-get',$apiParams);
    }

    /**
     * 获取用户红包列表
     * @return mixed
     */
    public function findRedpack($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'user_id' => isset($params['user_id']) ? $params['user_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('wx-user-get',$apiParams);
    }

    /**
     * 用户归属
     * @param $params
     */
    public function processAttribution($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
            'user_id' => isset($params['user_id']) ? $params['user_id'] : null
        ];
        $this->getResult('wx-user-process-attribution',$apiParams);
    }

    /**
     * 修改归属信息
     * @param $params
     */
    public function updateBelongInfos($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'agent_path' => isset($params['agent_path']) ? $params['agent_path'] : null,
            'belong_to_staff_id' => isset($params['belong_to_staff_id']) ? $params['belong_to_staff_id'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
            'user_id' => isset($params['user_id']) ? $params['user_id'] : null,
            'ids' => isset($params['ids']) ? $params['ids'] : null,
        ];
        $this->getResult('wx-user-update-belong',$apiParams);
    }

    /**
     * 会员列表会员数统计
     * @return mixed
     */
    public function countWxUser($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'group_ids' => isset($params['group_ids']) ? $params['group_ids'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'belong_to_staff_id' => isset($params['belong_to_staff_id']) ? $params['belong_to_staff_id'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null,
        ];
        $this->getResult('wx-user-count',$apiParams);
    }
    
    /**
     * 会员新增趋势 日增量统计
     * @return mixed
     */
    public function WxMemberIncrement($params)
    {
    	//拿接口数据
    	$apiParams = [
    	'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
    	'start_date' => isset($params['start_date']) ? $params['start_date'] : null,
    	'end_date' => isset($params['end_date']) ? $params['end_date'] : null,
    	'unit' => isset($params['unit']) ? $params['unit'] : null,
    	];
    	$this->getResult('wx-user-increment',$apiParams);
    }
}
