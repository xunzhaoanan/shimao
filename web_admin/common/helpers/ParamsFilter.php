<?php
/**
 * 参数简单验证的类
 * @author FoxxxZhu
 */
namespace common\helpers;

class ParamsFilter
{
    //不验证
    const T_RAW = 0x0;
    
    const T_STRING = 0x1;

    const T_INT = 0x2;

    const T_FLOAT = 0x4;
    
    //bool时返回0或1
    const T_BOOL = 0x8;
    
    //循环验证
    const T_MAP = 0x10;
    
    //是否为必选
    const T_REQUIRED = 0x20;
    
    
    const V_BOOL_FALSE = '[T_BOOL_TRUE.0x0000]';
    
    /**
     * 获取验证后的参数
     * @param array $definition 验证规则
     * @param array $source 待验证的参数
     * @throws \Exception
     * @return multitype:Ambigous <boolean, multitype:, unknown, mixed, NULL, number>
     */
    public static function parameters($definition, $source = [])
    {
        $parameters = array();
        foreach ($definition as $key => $filter) {
            if(!is_array($filter))
            {
                $filter = [$filter];
            }
            $result = self::filter($source, $filter, $key);
            if($result === false)
            {
                throw new \Exception("Parameter '{$key}' is invalid",10006);
            }            
            if (is_null($result)) {
                continue;
            }
            if($result == self::V_BOOL_FALSE)
            {
                $result = false;
            }
            $parameters[$key] = $result;
        }
        
        return $parameters;
    }
    
    /**
     * 验证,修复和过滤参数
     * @param array $source 要验证的数据
     * @param array $filter 验证规则
     * @param string|int $key 要验证的key
     * @throws \Exception
     * @return mix NULL if $source[$key] not set ,false if not in $filter
     */
    protected static function filter($source, $filter, $key)
    {
        $type = array_shift($filter);
        $call = array_shift($filter);
        
        if(($type & self::T_REQUIRED) && !isset($source[$key]))
        {
            throw new \Exception("Parameter '{$key}' is required!",10006);
        }
        
        if(!isset($source[$key]))
        {
            return NULL;
        } 
        
        $value = $source[$key];
        
        return self::filterType($value, $type,$call);    
    }
    
    /**
     * 获取规则下的数据
     * @param mix $var 原始数据
     */
    protected static function filterType($var,$type,$call = null)
    {
        if(is_callable($call))
        {
            $var = call_user_func_array($call,[$var]);
        }
        
        if ($type === self::T_RAW) {
            return $var;
        }
        
        //map
        if ($type & self::T_MAP) {
            if (is_array($var) ) {
                $tmp_type = $type ^ self::T_MAP;
                if ($tmp_type) {
                    //filter to every item
                    foreach ($var as $tmp_key => $tmp_value) {
                        $var[$tmp_key] = self::filterType($tmp_value, $tmp_type,$call);
                    }
                }
                return $var;
            }
        
            if (!empty($var)) {
                return false;
            }
            return array();
        }
        
        //int
        if ($type & self::T_INT) {
            return self::getAsInt($var);
        }
        
        //float
        if ($type & self::T_FLOAT) {
            return self::getAsFloat($var);
        }
        
        //boolean
        if ($type & self::T_BOOL) {
            return self::getAsBool($var);
        }
        
        //string above
        if ($type & self::T_STRING) {
            return self::getAsString($var);
        }
        
        return $var;
    }
    
    public static function getAsInt($value)
    {
        if (!is_numeric($value)) {
            return false;
        }        
        return intval($value);
    }
    
    public static function getAsFloat($value)
    {
        if (!is_numeric($value)) {
            return false;
        }
        return doubleval($value);
    }
    
    public static function getAsBool($value)
    {
        if(is_bool($value))
        {
            if($value)
            {
                return true;
            }
            else 
            {
                return self::V_BOOL_FALSE;
            }
        }
        return false;
    }
    
    public static function getAsString($value)
    {
        return is_string($value)? $value : false;
    }
    
}
