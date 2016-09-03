<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */

namespace common\models;

use Yii;

/**
 * shop model
 */
class ShopBak extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_f', 'category_s', 'company_sid', 'pickup_status', 'platform_info_id', 'self_platform', 'created', 'modified', 'deleted', 'group_id', 'review_status', 'auto_refund', 'version', 'after_sale_time_status', 'after_sale_handle_time'], 'integer'],
            [['contract_start', 'contract_end'], 'safe'],
            [['name', 'contract_no','return_consignee'], 'string', 'max' => 50],
            [['tel','return_phone'], 'string', 'max' => 16],
            [['website'], 'string', 'max' => 200],
            [['bg_img', 'logo'], 'string', 'max' => 250],
            [['addr','return_address'], 'string', 'max' => 300],
            [['desc'], 'string'],
            [['qq'], 'string', 'max' => 30]
        ];
    }

    /**
     * 获取店铺主体信息
     */
    public function get($params, $with = array())
    {
        $query = self::find();
        if ($with) {
            $query->with($with);
        }
        $query->andFilterWhere([
            self::tableName() . '.id' => isset($params['id']) ? $params['id'] : null,
            self::tableName() . '.name' => isset($params['name']) ? $params['name'] : null,
            self::tableName() . '.qq' => isset($params['qq']) ? $params['qq'] : null,
            self::tableName() . '.company_sid' => isset($params['company_sid']) ? $params['company_sid'] : null,
            self::tableName() . '.pickup_status' => isset($params['pickup_status']) ? $params['pickup_status'] : null,
            self::tableName() . '.platform_info_id' => isset($params['platform_info_id']) ? $params['platform_info_id'] : null,
            self::tableName() . '.contract_no' => isset($params['contract_no']) ? $params['contract_no'] : null,
            self::tableName() . '.contract_start' => isset($params['contract_start']) ? $params['contract_start'] : null,
            self::tableName() . '.contract_end' => isset($params['contract_end']) ? $params['contract_end'] : null,
        ]);
        if (!$query->where) {
            $query->where('0=1');
        } else {
            if (isset($params['doFilter'])) {
                foreach ($params['doFilter'] as $key => $value) {
                    $query->andFilterWhere(['!=', Shop::tableName() . '.' . $key, $value]);
                }
            }
            $query->andFilterWhere(['<>', Shop::tableName() . '.deleted', Shop::STATUS_DELETE]);
        }
        return $query->one();
    }

}
