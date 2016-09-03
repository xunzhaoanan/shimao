<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\newservices;

class NewWxMessage extends BaseService
{

    //是否为回复类型的消息
    const REPLY_YES = 1;
    const REPLY_NO = 2;

    //是否为收藏消息
    const FAVORITES_YES = 1;
    const FAVORITES_NO = 2;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 查找微信用户消息
     */
    public function find($params)
    {
        return $this->getResult('wx-user-message-list',$params);
    }



}