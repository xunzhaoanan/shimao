<?php
/**
 * Author: night
 * Date: 2016/3/15
 * Time: 18:20
 */
namespace common\vendor\log;


use common\helpers\CommonFunctionHelper;
use common\helpers\CommonLib;

class AsyncVisitor
{

    protected $shop_id;
    protected $user_id;
    protected $user_type;
    protected $obj_type;
    protected $ip;
    protected $useragent;
    protected $url;
    protected $referer;
    protected $params_in;
    protected $access_time;

    public function __construct($options)
    {
        $this->shop_id = isset($options['shop_id'])?$options['shop_id']:0;
        $this->user_id = isset($options['user_id'])?$options['user_id']:'';
        $this->user_type = isset($options['user_type'])?$options['user_type']:'wx';
        $this->obj_type = isset($options['obj_type'])?$options['obj_type']:'';
        $this->ip = isset($options['ip']) ? $options['ip'] : CommonFunctionHelper::getIp();
        $this->useragent = isset($options['useragent'])?$options['useragent']: CommonFunctionHelper::getUserAgent();
        $this->url = isset($options['url'])?$options['url']:CommonFunctionHelper::getUrl();
        $this->referer = isset($options['referer'])?$options['referer']:CommonFunctionHelper::getRefererUrl();
        $this->params_in = isset($options['params_in'])?$options['params_in']:'';
        $this->access_time = time();
    }

    public function addAccess()
    {
        $data[] = ['shop_id' => $this->shop_id, 'user_id' => $this->user_id, 'user_type' => $this->user_type, 'obj_type' => $this->obj_type,'ip' => $this->ip,
            'useragent' => $this->useragent,'url' => $this->url,'referer' => $this->referer,'params_in' => $this->params_in,'access_time' =>  $this->access_time ];
        //有数据就异步发送到swoole服务处理
        if ($data) {
            $ajaxData = [
                'collection' => \Yii::$app->params['AsyncVisoter.collection'],
                'type' => 'AsyncLog',
                'datas' => $data,
            ];
            CommonLib::swooleUdpSend(\Yii::$app->params['AsyncVisoter.url'], \Yii::$app->params['AsyncVisoter.port'], json_encode($ajaxData));
        }
    }
}