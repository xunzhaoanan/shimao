<?php
namespace common\components;

class ActiveController extends \yii\rest\ActiveController
{
    public $globals;
    public $resultModel;
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function init()
    {
        $this->resultModel = new ResultModel();
        $this->globals = \Yii::$container->get(Globals::className());
        parent::init();
    }

    public function actions()
    {
        $actions = parent::actions();
        // 注销系统自带的实现方法
        unset($actions['index'], $actions['update'], $actions['create'], $actions['delete'], $actions['view']);
        return $actions;
    }
}