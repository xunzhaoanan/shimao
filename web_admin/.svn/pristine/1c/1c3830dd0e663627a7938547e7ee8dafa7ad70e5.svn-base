<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 10:55
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Mall model
 */
class Logistics extends BaseModel
{

    //这个配置列表只能追加，不能随便修改
    private static $logisticsList = [
        [
            'apicode' => 'ems',
            'text' => '中国邮政EMS',
            'key' => 1
        ],
        [
            'apicode' => 'shentong',
            'text' => '申通快递',
            'key' => 2
        ],
        [
            'apicode' => 'tiantian',
            'text' => '天天快递',
            'key' => 3
        ],
        [
            'apicode' => 'yuantong',
            'text' => '圆通速递',
            'key' => 4
        ],
        [
            'apicode' => 'shunfeng',
            'text' => '顺丰速运',
            'key' => 5
        ],
        [
            'apicode' => 'yunda',
            'text' => '韵达快递',
            'key' => 6
        ],
        [
            'apicode' => 'zhongtong',
            'text' => '中通速递',
            'key' => 7
        ],
        [
            'apicode' => 'longbanwuliu',
            'text' => '龙邦物流',
            'key' => 8
        ],
        [
            'apicode' => 'zhaijisong',
            'text' => '宅急送',
            'key' => 9
        ],
        [
            'apicode' => 'quanyikuaidi',
            'text' => '全一快递',
            'key' => 10
        ],
        [
            'apicode' => 'huitongkuaidi',
            'text' => '汇通速递',
            'key' => 11
        ],
        [
            'apicode' => 'minghangkuaidi',
            'text' => '民航快递',
            'key' => 12
        ],
        [
            'apicode' => 'yafengsudi',
            'text' => '亚风速递',
            'key' => 13
        ],
        [
            'apicode' => 'kuaijiesudi',
            'text' => '快捷速递',
            'key' => 14
        ],
        [
            'apicode' => 'gongsuda',
            'text' => '共速达',
            'key' => 15
        ],
        [
            'apicode' => 'tiandihuayu',
            'text' => '华宇物流',
            'key' => 16
        ],
        [
            'apicode' => 'zhongtiekuaiyun',
            'text' => '中铁快运',
            'key' => 17
        ],
        [
            'apicode' => 'lianb',
            'text' => '联邦快递',
            'key' => 18
        ],
        [
            'apicode' => 'ups',
            'text' => 'UPS',
            'key' => 19
        ],
        [
            'apicode' => 'dhl',
            'text' => 'DHL',
            'key' => 20
        ],
        [
            'apicode' => 'lianb',
            'text' => '德邦物流',
            'key' => 21
        ],
        [
            'apicode' => 'jjwl',
            'text' => '佳吉物流',
            'key' => 22
        ],
        [
            'apicode' => 'xinbangwuliu',
            'text' => '新邦物流',
            'key' => 23
        ],
        [
            'apicode' => 'menduimen',
            'text' => '门对门',
            'key' => 24
        ],
        [
            'apicode' => 'quanfengkuaidi',
            'text' => '全峰快递',
            'key' => 25
        ],
        [
            'apicode' => 'zhongtiekuaiyun',
            'text' => '中铁快运',
            'key' => 26
        ],
        [
            'apicode' => 'ganzhongnengda',
            'text' => '港中能达',
            'key' => 27
        ],
        [
            'apicode' => 'youshuwuliu',
            'text' => '优速快递',
            'key' => 28
        ],
        [
            'apicode' => 'quanritongkuaidi',
            'text' => '全日通快递',
            'key' => 29
        ],
        [
            'apicode' => 'guotongkuaidi',
            'text' => '国通快递',
            'key' => 30
        ],
        [
            'apicode' => 'otherexpress',
            'text' => '其他快递',
            'key' => 31
        ],
        [
            'apicode' => 'selfexpress',
            'text' => '商家自行配送',
            'key' => 32
        ],
    ];


    /**
     * 物流公司列表
     * @return mixed
     */
    public static function find(){
        return self::$logisticsList;
    }

    /**
     * 获取物流公司信息
     * @return mixed
     */
    public static function get($key){
        if(isset(self::$logisticsList[$key-1])){
            return self::$logisticsList[$key-1];
        };
        return [
            'apicode' => '',
            'text' => '',
            'key' => ''
        ];
    }

    /*
     * 根据物流公司名称获取物流key
     *
     */
    public static function getKeyByName($name){
        $name = str_replace(' ','',trim($name));
        foreach(self::$logisticsList as $v){
            if($v['text'] == $name){
                return $v['key'];
            }
        }
        return null;
    }

}
