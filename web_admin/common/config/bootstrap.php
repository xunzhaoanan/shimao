<?php

Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('weixin', dirname(dirname(__DIR__)) . '/weixin');
Yii::setAlias('admin', dirname(dirname(__DIR__)) . '/admin');
Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');


/**********************************************以前的函数开始*****************************************/

/**
 * 得到某个参数值
 * $type参数含义：
 *  all、默认 （表示获取 post请求方式 或 get请求方式 或 来源链接 的参数值
 *  'get' 、（表示获取 get方式 的参数值
 *  'post' 、（表示获取 post方式 的参数值
 *  'referer' 、（表示获取 来源链接 的参数值
 */
function getParams($params,$type = 'all'){
    switch($type){
        case 'get' :
            if(getGetParams($params)){
                return getGetParams($params);
            }
            break;
        case 'post' :
            if(getPostParams($params)){
                return getPostParams($params);
            }
            break;
        case 'referer' :
            if(getReferer($params)){
                return getReferer($params);
            }
            break;
        default :
            if(getGetParams($params)){
                return getGetParams($params);
            }
            if(getPostParams($params)){
                return getPostParams($params);
            }
            if(getReferer($params)){
                return getReferer($params);
            }
            break;
    }
    return null;
}

/**
 * 得到get请求方式的某个参数值
 */
function getGetParams($params){
    if(\Yii::$app->request->get($params)){
        return \Yii::$app->request->get($params);
    }
    return null;
}

/**
 * 得到post请求方式的某个参数值
 */
function getPostParams($params){
    if(Yii::$app->request->post($params)){
        return Yii::$app->request->post($params);
    }
    return null;
}

/**
 * 得到来源链接
 * 如果传参数，则返回url的参数值
 */
function getReferer($params = null)
{
    if (!isset($_SERVER['HTTP_REFERER'])) {
        return null;
    }
    $referer = $_SERVER['HTTP_REFERER'];
    if(is_null($params)){
        return $referer;
    }
    $strposKey = $params.'=';
    $strposBegin = strpos($referer, $strposKey);
    if ($strposBegin === false) {
        return null;
    }
    $strposBegin += strlen($strposKey);
    $value = substr($referer, $strposBegin);
    $strposKey = '&';
    $strposBegin = strpos($value, $strposKey);
    if ($strposBegin === false) {
        return $value;
    }
    $value = substr($value,0, $strposBegin);
    return $value;
}


function getMobileSite(){
    $removeChat = '~!@#$%^&*()_+-=';
    $removeIds = [813];
    $issetIds = [265,738];
    $wxinfo = \common\cache\Session::get(\common\cache\Session::SESSION_KEY_WXINFO);
    if(is_array($wxinfo) && isset($wxinfo['account'])){
        if(CODE_RUNTIME == CODE_RUNTIME_ONLINE){
            if(in_array($wxinfo['id'],$issetIds)){
                return 'http://'.strtolower(preg_replace("/[^a-zA-Z0-9 ]/", '', $wxinfo['account'])).'.'.MOBILE_HOST.'/'.$wxinfo['account'];
            }
            if(! in_array($wxinfo['id'],$removeIds)){
                if($wxinfo['id'] > 800 ){
                    return 'http://'.strtolower(preg_replace("/[^a-zA-Z0-9 ]/", '', $wxinfo['account'])).'.'.MOBILE_HOST.'/'.$wxinfo['account'];
                }
            }
        }
        if(CODE_RUNTIME == CODE_RUNTIME_RC){
            return 'http://'.MOBILE_HOST.'/'.$wxinfo['account'];
        }
        return 'http://'.strtolower(trim($wxinfo['account'],$removeChat)).'.'.MOBILE_HOST.'/'.$wxinfo['account'];
    }
    $account = '';
    $requestUri = \Yii::$app->request->getUrl();
    $strposBegin = strpos($requestUri, '/');
    if ($strposBegin === false) {
        echo 'No access rights .';
        exit;
    } else {
        $account = substr($requestUri, $strposBegin + 1);
    }
    $strposEnd = strpos($account, '/');
    if ($strposEnd !== false) {
        $account = substr($account, 0, $strposEnd);
    }
    if(! $account){
        echo 'No access rights .';
        exit;
    }
    $wx = new \common\newservices\NewShopBindWx();
    $wxinfo = $wx->getByShopAccount([ 'account' => $account,'platform_type' => 1]);
    if(CODE_RUNTIME == CODE_RUNTIME_ONLINE){
        if(in_array($wxinfo['id'],$issetIds)){
            return 'http://'.strtolower(preg_replace("/[^a-zA-Z0-9 ]/", '', $wxinfo['account'])).'.'.MOBILE_HOST.'/'.$wxinfo['account'];
        }
        if(! in_array($wxinfo['id'],$removeIds)){
            if($wxinfo['id'] > 800 ){
                return 'http://'.strtolower(preg_replace("/[^a-zA-Z0-9 ]/", '', $wxinfo['account'])).'.'.MOBILE_HOST.'/'.$wxinfo['account'];
            }
        }
    }
    if(CODE_RUNTIME == CODE_RUNTIME_RC){
        return 'http://'.MOBILE_HOST.'/'.$account;
    }
    return 'http://'.strtolower(trim($account,$removeChat)).'.'.MOBILE_HOST.'/'.$account;
}

/**
 * 无权限的处理
 */
function noAccess($errCode = '-505'){
    if (Yii::$app->request->isGet) {
        Header('Location: /errors/no-access');
        exit;
    }
    exit('{"errcode":"'.$errCode.'","errmsg":' . json_encode('没有操作权限') . '}');
}

/**
 * 返回去掉指定KEY的数组
 * @param $list //数组结构数据
 * @param $key //需获取的键值
 * @return array
 */
function getDataArray($list, $key)
{
    $array = array();
    for ($i = 0; $i < count($list); $i++) {
        @$b = $list[$i][$key];
        $array[$i] = $b;
    }
    return $array;
}

/**
 * 去除空白数组【可多维数组使用】
 * 例子：[[3],2,'',['',23],0]
 * @param $arr
 * @param bool $trim
 */
function array_remove_empty(&$arr, $trim = true)
{
    foreach ($arr as $key => $value) {
        if (is_array($value)) {
            array_remove_empty($arr[$key]);
        } else {
            $value = is_string($value) ? trim($value) : $value;
            if ($value == '') {
                unset($arr[$key]);
            } elseif ($trim) {
                $arr[$key] = $value;
            }
        }
    }
}


/**********************************************以前的函数结束*****************************************/

/**
 * 设置session过期时间
 */
function setSessionTime($expire = 3600)
{
    if ($expire == 0) {
        $expire = ini_get('session.gc_maxlifetime');
    } else {
        ini_set('session.gc_maxlifetime', $expire);
    }
    if (empty($_COOKIE['PHPSESSID'])) {
        session_set_cookie_params($expire);
    }else {
        setcookie('PHPSESSID', $_COOKIE['PHPSESSID'], time() + $expire,'/');
    }
}
setSessionTime(18640);


/**
 * 打印字符串/数组
 */
function pr( $var = 9) {
    $template = php_sapi_name() !== 'cli' ? '<pre>%s</pre>' : "\n%s\n" ;
    printf( $template, print_r( $var, true ) ) ;
    exit();
}

/**
 * 转义
 */
function addslashe($str){
    return addslashes($str);
}

/**
 * 查找键值对
 * @author liuping
 * @param array $arr
 * @param $key
 * @param $val
 * @param $type  查找的值类型
 * @return array
 */
function seekArr($arr = array(), $key, $val, $type = 1)
{
    $res = array();
    $str = json_encode($arr);
    switch($type){
        case 1: //字符串
            preg_match_all("/\{[^\{]*\"" . $key . "\"\:\"" . $val . "\"[^\}]*\}/", $str, $m);
            break;
        case 2: //integer型
            preg_match_all("/\{[^\{]*\"" . $key . "\"\:" . $val . "[^\}]*\}/", $str, $m);
            break;
        case 3: //字符串和integer型
            preg_match_all("/\{[^\{]*\"" . $key . "\"\:(\")?" . $val . "(\")?[^\}]*\}/", $str, $m);
            break;
    }

    if ($m && $m[0]) {
        foreach ($m[0] as $val) $res[] = json_decode($val, true);
    }
    return $res;
}

