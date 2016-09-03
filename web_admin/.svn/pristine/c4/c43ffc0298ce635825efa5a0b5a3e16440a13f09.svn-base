<?php
/**
 * Author: Chenmh
 * Date: 2015/9/10
 * Time: 11:05
 */

namespace common\models;

use Yii;

/**
 * printer model
 */
class PrinterList extends BaseModel
{

    /**
     * 进入打印队列状态
     */
    const STATUS_WELCOME = 'welcome_word';

    /**
     * 当前等待上传图片状态
     */
    const STATUS_INPUTIMG = 'input_img';

    /**
     * 询问是否需要裁剪状态
     */
    const STATUS_INPUTCUT = 'input_cut';

    /**
     * 当前等待输入文字状态
     */
    const STATUS_INPUTWRITE = 'input_write';

    /**
     * 当前等待输入验证码状态
     */
    const STATUS_INPUTCODE = 'input_code';

    /**
     * 验证码错误提示状态
     */
    const STATUS_INPUTCODE_FAIL = 'input_error';
    /**
     * 打印完成状态
     */
    const STATUS_FINISH = 'finish';
    /**
     * 打印队列失败状态
     */
    const STATUS_FAILT1 = 'list_fail1';

    /**
     * 更改状态失败
     */
    const STATUS_FAILT2 = 'list_fail2';

    /**
     * 等待打印状态
     */
    const STATUS_PRINTING = 'printing';


    /**
     * 保存图片失败状态
     */
    const STATUS_SAVEIMGFAILT = 'save_img_fail';


    /**
     * 保存状态失败状态
     */
    const STATUS_SAVESTATEFAILT = 'save_state_fail';

    /**
     * 输入完验证码进行图片合成等待状态
     */
    const STATUS_INPUTCODERUNNING = 'input_code_running';

    /**
     * 保存文字信息失败
     */
    const STATUS_SAVWWORDFAIL = 'save_word_fail';

    /**
     * 达到设备打印限制
     */
    const STATUS_LIMITDEVICE = 'device_limit_msg';

    /**
     * 达到用户打印限制
     */
    const STATUS_LIMITUSER = 'user_limit_msg';

    /**
     * 退出打印
     */
    const OUT_MSG = 'out_msg';

    /**
     * 等待状态的提示语
     */
    const MSGTIP_WAITTING = '正在为您处理，请耐心等待';

    /**
     * 等待输入文字的提示语
     */
    const MSGTIP_INPUTWRITE = '请输入需要打印的文字（最多20个字符）';

    /**
     * 图片合成失败的提示语
     */
    const MSGTIP_MERGEIMGFAIL = '非常抱歉，图片处理失败[1001]，请重新发送图片';


    /**
     * 队列过期时间，单位秒
     */
    const PRINTER_LIST_TIMEOUT = 1800;

    /**
     * 不裁剪对应的值
     */
    const NO_CUT_CODE = "#";

    /**
     * 图片已经合成
     */
    const HASMERGEIMG = 'finish';

    /**
     * 免费打印类型
     */
    const TYPE_FREE =1;

    /**
     * 获取队列详情信息以及设备信息
     * @return mixed
     */
    public function getPrinterList($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => $params['shop_id'],
            'open_id' => isset($params['open_id']) ? $params['open_id'] : null,
            'printer_client_id' => isset($params['printer_client_id']) ? $params['printer_client_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'withClient' => isset($params['withClient']) ? $params['withClient'] : null,
            'ext' => isset($params['ext']) ? $params['ext'] : null,
        ];
        $this->getResult('printer-list-get', $apiParams);
        if (!is_null($this->_data)) {
            return $this->_data;
        }
        return null;
    }

    /**
     * 创建打印队列
     * @param $params
     * @return null
     */
    public function createPrinterList($params)
    {
        //拿接口数据
        $apiParams = [
            'type' => $params['type'],
            'shop_id' => $params['shop_id'],
            'printer_client_id' => $params['printer_client_id'],
            'open_id' => $params['open_id'],
            'status' => $params['status'],
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('printer-list-create', $apiParams);
        if (!is_null($this->_data)) {
            return true;
        }
        return false;
    }

    /**
     * 修改打印队列信息
     * @param $params
     * @return null
     */
    public function updatePrinterList($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => $params['id'],
            'shop_id' => $params['shop_id'],
            'pic' => isset($params['pic']) ? $params['pic'] : null,
            'print_pic' => isset($params['print_pic']) ? $params['print_pic'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'ext' => isset($params['ext']) ? $params['ext'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
        ];
        $this->getResult('printer-list-update', $apiParams);
        if (!is_null($this->_data)) {
            return true;
        }
        return false;
    }


}