<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\collect;


use common\forms\activity\ImageTxtAddForm;
use common\forms\activity\ImageTxtEditForm;
use common\forms\activity\ShareMessageAddForm;
use common\forms\BaseForm;
use common\forms\product\ShareMessageEditForm;
use common\models\Collect;

/**
 * @package common\forms
 */
class EditAjaxForm extends BaseForm
{
    public $collect;
    public $shareMessage;
    public $news;//图文

    public function beforeValidate()
    {
        //检查分享设置
        if (is_array($this->shareMessage) && count($this->shareMessage)) {
            $form = new ShareMessageEditForm();
            $params = ['ShareMessageEditForm' => $this->shareMessage];
            $this->checkForm($params, $form);
        }
        //检查图文
        if (is_array($this->news) && count($this->news)) {
            $form = new ImageTxtEditForm();
            $params = ['ImageTxtEditForm' => $this->news];
            $this->checkForm($params, $form);
        }
        //检查众筹活动设置
        if (is_array($this->collect) && count($this->collect)) {
            $form = new EditCollectRulesForm();
            $params = ['EditCollectRulesForm' => $this->collect];
            $this->checkForm($params, $form);
        } else {
            return false;
        }
        return true;
    }

    public function rules()
    {
        return [
            [['collect'], 'required'],
            [['shareMessage', 'news'], 'safe']
        ];
    }

}
