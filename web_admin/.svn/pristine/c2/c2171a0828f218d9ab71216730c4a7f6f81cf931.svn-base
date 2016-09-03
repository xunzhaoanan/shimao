<?php
/**
 * Author: night
 * Date: 2016/3/15
 * Time: 18:20
 */
namespace common\vendor\log;


use common\helpers\CommonLib;
use yii\helpers\VarDumper;
use yii\log\Target;

class AsyncTarget extends Target
{
    public function init()
    {
        parent::init();
    }

    public function export()
    {
        $data = [];
        foreach ($this->messages as $message) {
            list($text, $level, $category, $timestamp) = $message;
            if (!is_string($text)) {
                // exceptions may not be serializable if in the call stack somewhere is a Closure
                if ($text instanceof \Exception) {
                    $text = (string)$text;
                } else {
                    $text = VarDumper::export($text);
                }
            }
            $data[] = ['level' => $level, 'category' => $category, 'log_time' => $timestamp, 'prefix' => $this->getMessagePrefix($message), 'message' => $text];
        }
        //有数据就异步发送到swoole服务处理
        if ($data) {
            $ajaxData = [
                'collection' => \Yii::$app->params['AsyncLog.collection'],
                'type' => 'AsyncLog',
                'datas' => $data,
            ];
            CommonLib::swooleUdpSend(\Yii::$app->params['AsyncLog.url'], \Yii::$app->params['AsyncLog.port'], json_encode($ajaxData));
        }
    }
}