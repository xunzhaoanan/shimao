<?php
/**
 * User: night
 * Date: 2015/3/26
 * Time: 9:16
 */

namespace common\helpers;

use Yii;
use app\common\exception\BusinessException;

/**
 * Class CommonLib
 * @package app\common\helpers
 */
class CommonLib
{
    /**
     * 密码加密方法
     * @param $pwd
     * @return string
     * @throws BusinessException
     */
    public static function createPwd($pwd)
    {
        $pwd = trim($pwd);
        if (strlen($pwd) < 6) {
            throw new BusinessException(Yii::t('exception', '20002'), 20002);
        }
        return md5($pwd);
    }

    /**
     * 创建订单号
     * @param $seller_id
     * @return string
     */
    public static function createOrderNo($seller_id)
    {
        $orderNo = date("YmdHis", time()) . $seller_id . rand(1000, 9999);
        return $orderNo;
    }


    /**
     * 表单校验去除NULL值
     * @param $form
     */
    public static function filterFormNullValue($form)
    {
        $val = $form->toArray();
        self::filterNullValue($val);
        return $val;
    }

    /**
     * 生成会员wx_code
     * 订单号生成规则
     * 平台表示1位
     * 年、月、日、时、分、秒  14位
     * 随机数 5位 共计 20位
     */
    public static function createMemberWxCode()
    {
        $platId = 1;
        $time = date('YmdHms');
        $timeStamp = time();
        $cacheKey = Yii::$app->cache->get('create_member_wxcode_' . $timeStamp);
        if ($cacheKey) {
            $key = $cacheKey + 1;
        } else {
            $key = 1;
        }
        Yii::$app->cache->set('create_member_wxcode_' . $timeStamp, $key, 2);
        $key = self::getNum(strlen($key), 5, $key);
        return $platId . $time . $key;
    }

    /**
     * 获取定长数字串
     * @param $first
     * @param $second
     * @param $third
     * @return string
     */
    public static function getNum($first, $second, $third)
    {
        for ($x = $first; $x < $second; $x++) {
            $third = '0' . $third;
        }
        return $third;
    }

    /**
     * 数组去除NULL值
     * @param $arr
     */
    public static function filterNullValue(&$arr)
    {
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                self::filterNullValue($arr[$key]);
            } elseif (is_null($val)) {
                unset($arr[$key]);
            }
        }
    }

    /**
     * 把activeRecord转成数组。
     * @param $activeRecord
     * @return array
     */
    public static function recordToArray($activeRecord)
    {
        $dataArr = [];
        if ($activeRecord instanceof \yii\db\ActiveRecord) {
            $dataArr = $activeRecord->getAttributes();
            if ($activeRecord->getRelatedRecords()) {
                foreach ($activeRecord->getRelatedRecords() as $key => $val) {
                    if ($val instanceof \yii\db\ActiveRecord) {
                        $dataArr[$key] = $val->toArray();
                    } else if (count($val) > 0) {
                        $dataArr[$key] = self::recordListToArray($val);
                    } else {
                        $dataArr[$key] = [];
                    }
                }
            }
        }
        return $dataArr;
    }

    /**
     * 列表转换
     * @param $activeRecordList
     */
    public static function recordListToArray($activeRecordList)
    {
        foreach ($activeRecordList as $key => $val) {
            if ($val instanceof \yii\db\ActiveRecord) {
                $activeRecordList[$key] = self::recordToArray($val);
            } else {
                $activeRecordList[$key] = self::recordListToArray($val);
            }
        }
        return $activeRecordList;
    }

    /**
     * 生成pincode
     * @param $manufacturerId  厂商id
     * @param $batchNo  批次号
     * @param $type 机器类型
     * @param $no
     * @return string
     */
    public static function createPinCode($manufacturerId, $batchNo, $type, $no)
    {
        //厂商编码（4位）+ 出厂年月（8位）+ 批次号（3位）
        //机器类别编码（2位是否包含打印纸，是否可刷银行卡，座机还是手持机）
        //5位自增序列，5位随机数
        //md5(md5(厂商编码+类别码)+随机码）取后5位大写
        $manufacturer = str_pad($manufacturerId, 4, '0', STR_PAD_LEFT);
        $date = date("Ymd");
        $no = str_pad($no, 5, '0', STR_PAD_LEFT);
        $ranStr = mt_rand(10000, 99999);
        $strToSing = md5($manufacturer . $type) . $ranStr;
        $md5Str = self::md5Sub($strToSing, 5);
        return $manufacturer . $date . $batchNo . $type . $no . $ranStr . self::encodePinCode($md5Str);
    }

    /**
     * pinCode加密
     * @param $md5str
     * @return string
     */
    public static function encodePinCode($md5str)
    {
        $ret = '';
        for ($i = 0; $i < strlen($md5str); $i++) {
            $ascii = ord($md5str[$i]);
            if ($ascii >= ord('A') && $ascii <= ord('Z')) {
                $ret .= $ascii % 9;
            } else {
                $ret .= $md5str[$i];
            }
        }
        return $ret;
    }

    public static function checkPinCode($pinCode)
    {
        if (strlen($pinCode) != 32) {
            return false;
        }
        $manufacturer = substr($pinCode, 0, 4);
        $type = substr($pinCode, 13, 2);
        $ranStr = substr($pinCode, 22, 5);
        $sing = substr($pinCode, -5);
        return self::encodePinCode(self::md5Sub(md5($manufacturer . $type) . $ranStr, 5)) == $sing;
    }

    /**
     * md5后转大写后按方向截取制定长度
     * @param string $string 需加密的串
     * @param int $length 需返回的长度
     * @param int $type 1.从右边，2.从左边
     * @return string
     */
    public static function md5Sub($string, $length, $type = 1)
    {
        if ($type == 1) {
            return substr(strtoupper(md5($string)), -$length);
        } else {
            return substr(strtoupper(md5($string)), $length);
        }
    }

    /**
     * 纯真IP查询
     * @param $ip
     * @return mixed|string
     */
    public static function convertip($ip)
    {
        //IP数据文件路径
        $dat_path = __DIR__ . '/../../files/qqwry.Dat';

        //检查IP地址
        if (!preg_match('/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/', $ip)) {
            return 'IP Address Error';
        }
        //打开IP数据文件
        if (!$fd = @fopen($dat_path, 'rb')) {
            return 'IP date file not exists or access denied';
        }

        //分解IP进行运算，得出整形数
        $ip = explode('.', $ip);
        $ipNum = $ip[0] * 16777216 + $ip[1] * 65536 + $ip[2] * 256 + $ip[3];

        //获取IP数据索引开始和结束位置
        $DataBegin = fread($fd, 4);
        $DataEnd = fread($fd, 4);
        $ipbegin = implode('', unpack('L', $DataBegin));
        if ($ipbegin < 0) $ipbegin += pow(2, 32);
        $ipend = implode('', unpack('L', $DataEnd));
        if ($ipend < 0) $ipend += pow(2, 32);
        $ipAllNum = ($ipend - $ipbegin) / 7 + 1;

        $BeginNum = 0;
        $EndNum = $ipAllNum;

        //使用二分查找法从索引记录中搜索匹配的IP记录
        $ip1num = $ip2num = 0;
        while ($ip1num > $ipNum || $ip2num < $ipNum) {
            $Middle = intval(($EndNum + $BeginNum) / 2);

            //偏移指针到索引位置读取4个字节
            fseek($fd, $ipbegin + 7 * $Middle);
            $ipData1 = fread($fd, 4);
            if (strlen($ipData1) < 4) {
                fclose($fd);
                return 'System Error';
            }
            //提取出来的数据转换成长整形，如果数据是负数则加上2的32次幂
            $ip1num = implode('', unpack('L', $ipData1));
            if ($ip1num < 0) $ip1num += pow(2, 32);

            //提取的长整型数大于我们IP地址则修改结束位置进行下一次循环
            if ($ip1num > $ipNum) {
                $EndNum = $Middle;
                continue;
            }

            //取完上一个索引后取下一个索引
            $DataSeek = fread($fd, 3);
            if (strlen($DataSeek) < 3) {
                fclose($fd);
                return 'System Error';
            }
            $DataSeek = implode('', unpack('L', $DataSeek . chr(0)));
            fseek($fd, $DataSeek);
            $ipData2 = fread($fd, 4);
            if (strlen($ipData2) < 4) {
                fclose($fd);
                return 'System Error';
            }
            $ip2num = implode('', unpack('L', $ipData2));
            if ($ip2num < 0) $ip2num += pow(2, 32);

            //没找到提示未知
            if ($ip2num < $ipNum) {
                if ($Middle == $BeginNum) {
                    fclose($fd);
                    return 'Unknown';
                }
                $BeginNum = $Middle;
            }
        }

        //下面的代码读晕了，没读明白，有兴趣的慢慢读
        $ipAddr1 = $ipAddr2 = '';
        $ipFlag = fread($fd, 1);
        if ($ipFlag == chr(1)) {
            $ipSeek = fread($fd, 3);
            if (strlen($ipSeek) < 3) {
                fclose($fd);
                return 'System Error';
            }
            $ipSeek = implode('', unpack('L', $ipSeek . chr(0)));
            fseek($fd, $ipSeek);
            $ipFlag = fread($fd, 1);
        }

        if ($ipFlag == chr(2)) {
            $AddrSeek = fread($fd, 3);
            if (strlen($AddrSeek) < 3) {
                fclose($fd);
                return 'System Error';
            }
            $ipFlag = fread($fd, 1);
            if ($ipFlag == chr(2)) {
                $AddrSeek2 = fread($fd, 3);
                if (strlen($AddrSeek2) < 3) {
                    fclose($fd);
                    return 'System Error';
                }
                $AddrSeek2 = implode('', unpack('L', $AddrSeek2 . chr(0)));
                fseek($fd, $AddrSeek2);
            } else {
                fseek($fd, -1, SEEK_CUR);
            }

            while (($char = fread($fd, 1)) != chr(0))
                $ipAddr2 .= $char;

            $AddrSeek = implode('', unpack('L', $AddrSeek . chr(0)));
            fseek($fd, $AddrSeek);

            while (($char = fread($fd, 1)) != chr(0))
                $ipAddr1 .= $char;
        } else {
            fseek($fd, -1, SEEK_CUR);
            while (($char = fread($fd, 1)) != chr(0))
                $ipAddr1 .= $char;

            $ipFlag = fread($fd, 1);
            if ($ipFlag == chr(2)) {
                $AddrSeek2 = fread($fd, 3);
                if (strlen($AddrSeek2) < 3) {
                    fclose($fd);
                    return 'System Error';
                }
                $AddrSeek2 = implode('', unpack('L', $AddrSeek2 . chr(0)));
                fseek($fd, $AddrSeek2);
            } else {
                fseek($fd, -1, SEEK_CUR);
            }
            while (($char = fread($fd, 1)) != chr(0)) {
                $ipAddr2 .= $char;
            }
        }
        fclose($fd);

        //最后做相应的替换操作后返回结果
        if (preg_match('/http/i', $ipAddr2)) {
            $ipAddr2 = '';
        }
        $ipaddr = "$ipAddr1 $ipAddr2";
        $ipaddr = preg_replace('/CZ88.Net/is', '', $ipaddr);
        $ipaddr = preg_replace('/^s*/is', '', $ipaddr);
        $ipaddr = preg_replace('/s*$/is', '', $ipaddr);
        if (preg_match('/http/i', $ipaddr) || $ipaddr == '') {
            $ipaddr = 'Unknown';
        }
        return $ipaddr;
    }

    /**
     * 可以统计中文字符串长度的函数
     * @param $str 要计算长度的字符串,一个中文算一个字符
     * @return int
     */
    public static function absLength($str)
    {
        if (empty($str)) {
            return 0;
        }
        if (function_exists('mb_strlen')) {
            return mb_strlen($str, 'utf-8');
        } else {
            preg_match_all("/./u", $str, $ar);
            return count($ar[0]);
        }
    }

    /**
     * utf-8编码下截取中文字符串,参数可以参照substr函数
     * @param $str 要进行截取的字符串
     * @param int $start 要进行截取的开始位置，负数为反向截取
     * @param $end 要进行截取的长度
     * @return bool|string
     */
    public static function utf8Substr($str, $start = 0, $end)
    {
        if (empty($str)) {
            return false;
        }
        if (function_exists('mb_substr')) {
            if (func_num_args() >= 3) {
                $end = func_get_arg(2);
                return mb_substr($str, $start, $end, 'utf-8');
            } else {
                mb_internal_encoding("UTF-8");
                return mb_substr($str, $start);
            }

        } else {
            $null = "";
            preg_match_all("/./u", $str, $ar);
            if (func_num_args() >= 3) {
                $end = func_get_arg(2);
                return join($null, array_slice($ar[0], $start, $end));
            } else {
                return join($null, array_slice($ar[0], $start));
            }
        }
    }

    /**
     * 生成guid
     * @return string
     */
    public static function createGuid()
    {
        $charid = strtoupper(md5(uniqid(mt_rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = ''
            . substr($charid, 0, 8) . $hyphen
            . substr($charid, 8, 4) . $hyphen
            . substr($charid, 12, 4) . $hyphen
            . substr($charid, 16, 4) . $hyphen
            . substr($charid, 20, 12);
        return strtolower($uuid);
    }

    /**
     * swooleudp客户端发消息
     * @param $ip
     * @param $port
     * @param $str
     * @throws Exception
     */
    public static function swooleUdpSend($ip, $port, $str)
    {
        //swoole 客户端发送消息
        $client = new \swoole_client(SWOOLE_SOCK_UDP);
        if (!$client->connect($ip, $port, -1)) {
            throw new Exception("connect failed. Error: {$client->errCode}\n");
        }
        $len = strlen($str);
        $sendStr = '';
        for ($i = 0; $i < $len; $i++) {
            $sendStr .= $str[$i];
            if (($i + 1) % 8192 == 0) {
                $client->send($sendStr);
                $sendStr = '';
            }
        }
        if (strlen($sendStr) > 8188) {
            $client->send($sendStr);
            $client->send("\r\n\r\n");
        } else {
            $client->send($sendStr . "\r\n\r\n");
        }
        $client->close();
    }

    /**
     * 替换文件夹不允许出现的字符
     * @param $folderName
     * @return mixed
     */
    public static function replaceFolderName($folderName)
    {
        return str_replace(['\\', '/', '*', '?', '"', '<', '>', '|'], '-', $folderName);
    }

    /**
     * 截取中文字符加省略号
     * @param $string
     * @param $start
     * @param null $length
     * @param string $suffix
     * @return bool|string
     */
    public static function mbSubString($string, $start, $length = null, $suffix = '...')
    {
        if ($length !== null) {
            $substr = self::utf8Substr($string, $start, $length);
            $str_length = self::absLength($string);
            if ($str_length > $length) {
                $substr .= $suffix;
            }
        } else {
            $substr = self::utf8Substr($string, $start);
        }
        return $substr;
    }

    /**
     * 过滤特殊字符
     * @param $text
     * @return mixed
     */
    public static function filterSpecialChars($text)
    {
        //过滤emoji表情
        $a = json_encode($text);
        $b = preg_replace("/\\\ud([8-9a-f][0-9a-z]{2})/i", "", $a);
        $text = json_decode($b);

        //过滤特殊字符
        $pattern = "/[\x{3400}-\x{4DB5}\x{4E00}-\x{9FA5}\x{9FA6}-\x{9FBB}\x{F900}-\x{FA2D}\x{FA30}-\x{FA6A}\x{FA70}-\x{FAD9}\x{FF00}-\x{FFEF}\x{2E80}-\x{2EFF}\x{3000}-\x{303F}\x{31C0}-\x{31EF}\x{2F00}-\x{2FDF}\x{2FF0}-\x{2FFF}\x{3100}-\x{312F}\x{31A0}-\x{31BF}\x{3040}-\x{309F}\x{30A0}-\x{30FF}\x{31F0}-\x{31FF}\x{AC00}-\x{D7AF}\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{4DC0}-\x{4DFF}\x{A000}-\x{A48F}\x{A490}-\x{A4CF}\x{2800}-\x{28FF}\x{3200}-\x{32FF}\x{3300}-\x{33FF}\x{2700}-\x{27BF}\x{2600}-\x{26FF}\x{FE10}-\x{FE1F}\x{FE30}-\x{FE4F}0-9a-zA-Z—\x{21}-\x{7e}\x{00}-\x{ff}]/ui";
        $filterStr = preg_replace($pattern, '', $text);
        $filterPattern = addslashe("/" . $filterStr . "/ui");
        return preg_replace($filterPattern, '', $text);
    }

    /**
     * 数组对应key替换值
     * @param $form
     */
    public static function replaceParams(&$form, $replaceParams)
    {
        if (is_array($replaceParams) && count($replaceParams)) {
            $newFormData = array();
            foreach ($form as $key => $val) {
                if (array_key_exists($key, $replaceParams)) {
                    $newFormData[$replaceParams[$key]] = $val;
                } else {
                    $newFormData[$key] = $val;
                }
            }
            $form = $newFormData;
        }
    }

    /**
     * curl 抓取图片
     * @param $url
     * @return mixed
     */
    public static function downLoadImage($url)
    {
        $header = array('Expect:');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $img = curl_exec($ch);
        curl_close ($ch);

        //$return_code = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );
        return $img;
    }
}