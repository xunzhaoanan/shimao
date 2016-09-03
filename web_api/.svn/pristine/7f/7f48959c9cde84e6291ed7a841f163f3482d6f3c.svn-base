<?php
/**
 * 用户自定义异常业务异常
 * User: night
 * Date: 2015/3/28
 * Time: 10:03
 */

namespace common\exception;
use yii\base\UserException;

class BusinessException extends UserException
{
    protected $message = "业务异常";
    protected $code = 20000;
    protected $data = null;


    public function  __construct($message, $code, $data = null)
    {
        $this->data = $data;
        $this->message = $message;
        $this->code = $code;
        parent::__construct($message, $code, null);
    }

    public function getName()
    {
        return "BusinessException";
    }

    public function getData()
    {
        return $this->data;
    }

    public function sendErrorMsg(){
        exit('{"errorno":'.$this->code.',"errormsg":"'.$this->message.'"}');
    }

} 