<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 10:50
 */

namespace admin\controllers;

use common\cache\BaseCache;
use common\forms\shop\StatementReceiveSettingAjaxForm;
use common\forms\terminal\ResetPwdAjaxForm;
use common\forms\terminal\AddAjaxForm;
use common\forms\terminal\EditAjaxForm;
use common\forms\terminal\StaffAddAjaxForm;
use common\forms\terminal\StaffCloseAjaxForm;
use common\forms\terminal\StaffEditAjaxForm;
use common\forms\terminal\StaffEditForm;
use common\forms\terminal\StaffEditPwdAjaxForm;
use common\forms\terminal\StaffOpenAjaxForm;
use common\forms\terminal\ListAjaxForm;
use common\forms\writeoff\CancelRecordListAjaxForm;
use common\forms\writeoff\ShopsubCancelListAjaxForm;
use common\models\Cancel;
use common\models\Data;
use common\models\Staff;
use common\models\Statement;
use common\models\Terminal;
use common\models\WxQrcode;
use common\services\CommonService;
use common\services\weixin\WxQrcodeService;
use common\vendor\zip\Zip;
use Yii;
use common\forms\GeneralForm;
use common\forms\export\WaitingAjaxForm;

class TerminalController extends BaseController
{

    protected $terminalModel;
    protected $cancelModel;
    protected $staffModel;
    protected $qrcodeService;

    function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->terminalModel = new Terminal();
        $this->cancelModel = new Cancel();
        $this->staffModel = new Staff();
    }

    /**
     * 直营店付款码列表
     */
    public function actionScanPay()
    {
        return $this->render('scan-pay',['qrcode'=>'/qrcode/image?url='.getMobileSite().'/scan-pay/terminal']);
    }

    /**
    * 终端店付款码
    */
    public function actionScanPayDetail()
    {
        $limit = '0';
        if(isset($this->_shop['shopSetting']['scan_limit_amount'])){
            $limit = $this->_shop['shopSetting']['scan_limit_amount'];
        }
        return $this->render('scan-pay-detail',['qrcode'=>'/qrcode/image?url='.getMobileSite().'/scan-pay/terminal','downUrl'=>'/qrcode/down?url='.getMobileSite().'/scan-pay/terminal?id='.Yii::$app->request->get('terminal_id'),'limit'=>$limit]);
    }

    /**
    * 加盟店付款码列表
    */
    public function actionScanPayAgent()
    {
        return $this->render('scan-pay-agent',['qrcode'=>'/qrcode/image?url='.getMobileSite().'/scan-pay/terminal']);
    }

    /**
     * 开启终端付款码
     */
    public function actionScanPayOpenAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form,['id'=>'shop_sub_id']);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'is_scan_pay' => Terminal::STATUS_ENABLE
        ];
        $this->terminalModel->updateSetting($serviceParams);
        if (!is_null($this->terminalModel->getError())) {
            return $this->setError($this->terminalModel->getError());
        }
        $this->setResult($this->terminalModel->_data);
    }

    /**
     * 关闭终端付款码
     */
    public function actionScanPayCloseAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form,['id'=>'shop_sub_id']);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'is_scan_pay' => Terminal::STATUS_DISABLE
        ];
        $this->terminalModel->updateSetting($serviceParams);
        if (!is_null($this->terminalModel->getError())) {
            return $this->setError($this->terminalModel->getError());
        }
        $this->setResult($this->terminalModel->_data);
    }

    /**
     * 生成付款码需要导出的文件
     */
    public function actionBulidQrcodeAjax()
    {
        //set_time_limit(0);
        // form处理
        $post = Yii::$app->request->get();
        $form = new ListAjaxForm();
        $this->checkForm(["ListAjaxForm"=>$post],$form);
        $serviceParams = $this->handleForm($form);

        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        if($this->getShopSubId()){
            $serviceParams += ['ids'=>[$this->getShopSubId()]];
        }
        if($serviceParams['province_id'] ==-1){
            $serviceParams['province_id']= null;
        }
        if($serviceParams['city_id'] ==-1){
            $serviceParams['city_id']= null;
        }
        if($serviceParams['district_id'] ==-1){
            $serviceParams['district_id']= null;
        }
        if( ! isset($serviceParams['agent_id']) &&  ! isset($serviceParams['shop_sub_id'])){
            $serviceParams += ['shop_type' => Terminal::SHOP_TYPE_STORE];
        }
        if(isset($serviceParams['shop_type']) &&  isset($serviceParams['is_all']) && $serviceParams['is_all']){
            unset($serviceParams['shop_type']);
        }

        if(isset($post['agent_id']))
        {
            $serviceParams['agent_id'] = $post['agent_id'];
        }
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'shop_name' => $this->_shop['name'],
            'page' => 0,
            'count' => 1000
        ];
        if( ! isset($serviceParams['ids']) && ! isset($serviceParams['shop_type']) && ! isset($serviceParams['agent_id'])){
            $this->setError('您提交的数据有误');
        }
        if(isset($serviceParams['ids']) && $serviceParams['ids']){
            $serviceParams['ids'] = explode(',',$serviceParams['ids']);
        }
        
        $data = [
        'service' => '\common\models\Terminal',
        'params' => $serviceParams,
        'rowFunc' => 'GetTerminalQrcordInfo',
        'downloadFileName'=> $this->_shop['name'].'_终端店付款码.zip',
        ];
        $sign = '_export'.md5(time()).rand(0,10000);
        BaseCache::set($sign,$data,1200);
        $this->redirect('/export/waiting?sign='.$sign.'&backUrl=/terminal/scan-pay&back=终端店收款码&waitingAjaxUrl=/export/waiting-qrcode-ajax&downloadAllUrl=download-qrcode-zip');
        
//         $this->terminalModel->find($serviceParams);
//         if (!is_null($this->terminalModel->getError())) {
//             return $this->setError($this->terminalModel->getError());
//         }       
        
//         $data = $this->terminalModel->_data['data'];
//         if(count($data) < 1){
//             $this->setError('没有相关数据');
//         }
//         $zip = new Zip();
//         $fileDir = 'qrcode_'.date('YmdHis').rand(1000,9999);
//         $path = $zip->baseDir.$fileDir;
//         mkdir(iconv('utf-8', 'gbk',$path));
//         foreach($data as $val){
//             $dir = $path.DIRECTORY_SEPARATOR.$val['shopInfo']['name'].'_付款码';
//             mkdir(iconv('utf-8', 'gbk',$dir));
//             $qrcode = file_get_contents(getMobileSite().'/qrcode/image?url='.getMobileSite().'/scan-pay/terminal?id='.$val['shopInfo']['shop_sub_id']);
//             file_put_contents(iconv('utf-8', 'gbk',$dir.DIRECTORY_SEPARATOR.$val['shopInfo']['name'].'_付款码.png'),$qrcode);
//         }
//         $dir = $zip->baseDir.$fileDir;
//         if( ! file_exists(iconv('utf-8','gbk',$dir))){
//             $this->setError();
//         }
//         $zip->Zip($dir, $dir.'.zip');
//         $zip->down($dir.'.zip',$this->_shop['name'].'_终端店付款码.zip');
    }

    /**
     * 终端列表
     */
    public function actionList()
    {
        return $this->render('list', ['wxAccount' => $this->_wxInfo['account']]);
    }

    /**
    * 终端详情
    */
    public function actionDetailAjax()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'shop_sub_id'=>$this->getShopSubId()
        ];

        $this->terminalModel->get($serviceParams);
        if (!is_null($this->terminalModel->getError())) {
            return $this->setError($this->terminalModel->getError());
        }
        $data =  $this->terminalModel->_data;
        $this->setResult($data);

    }

    /**
     * 终端详情
     */
    public function actionDetail()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'shop_sub_id'=>$this->getShopSubId()
        ];

        $this->terminalModel->get($serviceParams);
        if (!is_null($this->terminalModel->getError())) {
            return $this->setError($this->terminalModel->getError());
        }
        $data =  $this->terminalModel->_data;

        $this->_commonService->getAreaName([
            $data['shopInfo']['province_id'], $data['shopInfo']['city_id'], $data['shopInfo']['district_id'], $data['shopInfo']['circle_id']
        ]);
        if (!is_null($this->_commonService->getError())) {
            return $this->setError();
        }
        $data['shopInfo']['circle'] = implode('，', $this->_commonService->_data);
        $data['shopInfo']['wx_categories'] = json_decode($data['shopInfo']['wx_categories'], true);
        //pr( $data['shopInfo']['wx_categories']);
        $data['shopInfo']['wxshop'] = [];
        if (is_array($data['shopInfo']['wx_categories']) && count($data['shopInfo']['wx_categories'])) {
            foreach ($data['shopInfo']['wx_categories'] as $val) {
                if(isset($val['name'])) {
                    $data['shopInfo']['wxshop'][] = $val['name'];
                }
            }
        }
        $data['shopInfo']['wxshop'] = implode('，', $data['shopInfo']['wxshop']);
        $data['shop'] = $this->_shop;
        return $this->render('detail', [
            'data' => $data, 'wx_account' => $this->_wxInfo['account']
        ]);

    }

    //    获取加盟店信息
    public function actionGetAgentFranchiseeAjax() {

        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $post = Yii::$app->request->post();
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => $post], $form);
        $serviceParams = $this->handleForm($form, ['id' => 'shop_sub_id']);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];

        $this->terminalModel->get($serviceParams);
        if (!is_null($this->terminalModel->getError())) {
            return $this->setError($this->terminalModel->getError());
        }
        $data = $this->terminalModel->_data;
        //员工数
        $staffModel = new Staff();
        $params = [
            'shop_id' => $this->_shop['id'],
            'shop_sub_id' =>$this->getShopSubId(),
            'count' => 1,
            'page' => 0
        ];

        $staffModel->find($params);
        if (!is_null($staffModel->getError())) {
            return $this->setError();
        }
        $data['shopInfo']['staff_total_count']=$staffModel->_data['page']['total_count'];

        $agentData = null;
//        if($this->_shopAgent['id']){
//            $fxModel = new Agent();
//            $params = [
//                'shop_id' => $this->_shop['id'],
//                'agent_id' => $this->_shopAgent['id'],
//                'shop_sub_id' => $this->getShopSubId()
//            ];
//            $fxModel->get($params);
//            if (!is_null($fxModel->getError())) {
//                return $this->setError();
//            }
//            $agentData = $fxModel->_data;
//        }
        $data['shopInfo']['agent_name']=$agentData['agent_name'];


        $fxparams = [
            'shop_id' => $this->_shop['id'],
            'kind' => Data::DATA_FX_KIND_SHOP,
            'shop_count_type' =>1,
            'shop_sub_id' => $this->getShopSubId()
        ];
        $this->terminalModel->fxMemberCount($fxparams);
        if (!is_null($this->terminalModel->getError())) {
            return $this->setError();
        }
        $memberData = $this->terminalModel->_data;
        $data['shopInfo']['fx_member_count']=$memberData[0];

        $this->setResult($data);

    }

    /**
     * 直营店列表分页
     */
    public function actionListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }

        // form处理
        $post = Yii::$app->request->post();
        $form = new ListAjaxForm();
        $this->checkForm(["ListAjaxForm"=>$post],$form);
        $serviceParams = $this->handleForm($form);

        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];

        if($this->getShopSubId()){
            $serviceParams['ids'] = [$this->getShopSubId()];
        }
        if($serviceParams['province_id'] ==-1){
            $serviceParams['province_id']= null;
        }
        if($serviceParams['city_id'] ==-1){
            $serviceParams['city_id']= null;
        }
        if($serviceParams['district_id'] ==-1){
            $serviceParams['district_id']= null;
        }
        $this->getPageInfo($serviceParams);
        if( ! isset($serviceParams['agent_id']) &&  ! isset($serviceParams['shop_sub_id'])){
            $serviceParams += ['shop_type' => Terminal::SHOP_TYPE_STORE];
        }
        if(isset($serviceParams['shop_type']) &&  isset($serviceParams['is_all']) && $serviceParams['is_all']){
            unset($serviceParams['shop_type']);
        }
        if(isset($post['agent_id']))
        {
            $serviceParams['agent_id'] = $post['agent_id'];
        }
        if( !isset($serviceParams['agent_id']) &&  !isset($serviceParams['shop_type']) &&  !isset($serviceParams['shop_sub_id'])){
            $serviceParams['shop_type'] = 1;
        }
        $this->terminalModel->find($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->terminalModel->getError())) {
            return $this->setError($this->terminalModel->getError());
        }
        $this->setResult($this->terminalModel->_data);
    }

    /**
     * 直营店归属关系列表
     */
    public function actionBelongListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }

        $serviceParams = Yii::$app->request->post();

        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];

        if( ! isset($serviceParams['agent_id']) &&  ! isset($serviceParams['shop_sub_id'])){
            $serviceParams += ['shop_type' => Terminal::SHOP_TYPE_STORE];
        }
        if(isset($serviceParams['shop_type']) &&  isset($serviceParams['is_all']) && $serviceParams['is_all']){
            unset($serviceParams['shop_type']);
        }
        $this->terminalModel->findBelong($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->terminalModel->getError())) {
            return $this->setError($this->terminalModel->getError());
        }
        $this->setResult($this->terminalModel->_data);
    }


    /**
     * 添加直营店
     */
    public function actionAdd()
    {
        if(\Yii::$app->request->get('agent_id')){
            $shopTypeList = [
                ['name' => '加盟店', 'shop_type' => Terminal::SHOP_TYPE_STORE_ITS_FRANCHISEES]
            ];
        }else{
            $shopTypeList = [
                ['name' => '直营店', 'shop_type' => Terminal::SHOP_TYPE_STORE]
            ];
        }

        return $this->render('add', [
            'wxAccount' => $this->_wxInfo['account'], 'shoptypeList' => $shopTypeList
        ]);
    }

    /**
     * 添加直营店
     */
    public function actionAddAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new AddAjaxForm();
        $post = Yii::$app->getRequest()->getBodyParams();
        $this->checkForm(["AddAjaxForm" => $post], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'agent_id' => $this->getAgentId(),
            'sync_setting' => 1
        ];
        $serviceParams['shopSub'] = $serviceParams;
        unset($serviceParams['shopSub']['shopInfo']);
        unset($serviceParams['shopSub']['shopStaff']);
        $serviceParams['shopInfo']['wx_categories'] = json_encode($serviceParams['shopInfo']['wx_categories']);
        $this->terminalModel->create($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->terminalModel->getError())) {
            return $this->setError($this->terminalModel->getError());
        }
        //生成店铺二维码
        $Params = [
            'shop_id' => $this->terminalModel->_data['shopInfo']['shop_id'],
            'shop_sub_id' => $this->terminalModel->_data['shopInfo']['shop_sub_id'],
            'model' => WxQrcode::MODEL_TERMINAL,
            'model_id' => $this->terminalModel->_data['shopInfo']['shop_sub_id'],
            'auto_build' => true,
        ];
        $this->qrcodeService = new WxQrcodeService($this->_wxInfo);
        $this->qrcodeService->getQrcode($Params);
        // 接收逻辑层处理结果
        if (!is_null($this->qrcodeService->getError())) {
            //如果生成二维码失败，就要删掉这条终端店数据
            $this->terminalModel->del([
                'shop_id' => $this->terminalModel->_data['shopInfo']['shop_id'],
                'shop_sub_id' => $this->terminalModel->_data['shopInfo']['shop_sub_id']
            ]);
            return $this->setError($this->qrcodeService->getError());
        }
        $this->setResult();
    }

    /**
     * 手动生成店铺二维码
     */
    public function actionCreateTerminalQrcode()
    {
        $post = Yii::$app->request->post();
        //生成店铺二维码
        $Params = [
            'shop_id' => $this->_shop['id'],
            'shop_sub_id' => $post['shop_sub_id'],
            'model' => WxQrcode::MODEL_TERMINAL,
            'model_id' => $post['shop_sub_id'],
            'auto_build' => true,
        ];
        $this->qrcodeService = new WxQrcodeService($this->_wxInfo);
        $this->qrcodeService->getQrcode($Params);
        // 接收逻辑层处理结果
        if (!is_null($this->qrcodeService->getError())) {
            return $this->setError($this->qrcodeService->getError());
        }
        $this->setResult();
    }

    /**
     * 编辑直营店
     */
    public function actionEdit()
    {
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->get()], $form);
        $params = $this->handleForm($form,['id'=>'shop_sub_id']);
        $params += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->terminalModel->get($params);
        // 接收逻辑层处理结果
        if (!is_null($this->terminalModel->getError())) {
            return $this->setError();
        }
        $data = $this->terminalModel->_data;
        $data['shopInfo']['wx_categories'] = json_decode($data['shopInfo']['wx_categories'], true);
        $commonService = new CommonService();
        $commonService->findProvince();
        $provinceList = $commonService->_data;
        if($this->getShopSubType($params['shop_sub_id']) !== 2) {
            $shopTypeList = [
                ['name' => '直营店', 'shop_type' => Terminal::SHOP_TYPE_STORE]
            ];
        }else{
            $shopTypeList = [
                ['name' => '加盟店', 'shop_type' => Terminal::SHOP_TYPE_STORE_ITS_FRANCHISEES]
            ];
        }
        return $this->render('edit', [
            'model' => $data, 'provinceList' => $provinceList, 'wxAccount' => $this->_wxInfo['account'], 'shoptypeList' => $shopTypeList
        ]);
    }

    /**
     * 编辑直营店
     */
    public function actionEditAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new EditAjaxForm();
        $this->checkForm(["EditAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        // 參數合併
        $this->mergeParams($serviceParams, 'shopSub');
        // 调用逻辑层
        $this->terminalModel->update($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->terminalModel->getError())) {
            return $this->setError($this->terminalModel->getError());
        }
        $this->setResult();
    }

    /**
     * 删除直营店
     */
    public function actionDelAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form,['id'=>'shop_sub_id']);
        $serviceParams += ['shop_id'=>$this->_wxInfo['shop_id']];
        // 调用逻辑层
        $this->terminalModel->del($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->terminalModel->getError())) {
            return $this->setError($this->terminalModel->getError());
        }
        $this->setResult();
    }

    /**
     * 核销管理-绑定核销员
     */
    public function actionWriteOff()
    {
        return $this->render('write-off');
    }

    /**
     * 核销管理-网页核销
     */
    public function actionWriteOffWeb()
    {
        return $this->render('write-off-web');
    }
    /**
     * 核销管理-网页核销确认
     */
    public function actionCardConfirm()
    {
        return $this->render('card-confirm');
    }

    /**
     * 核销管理-核销记录
     */
    public function actionWriteOffRecords()
    {
        return $this->render('write-off-records');
    }

    /**
     * 核销管理-核销门店排行榜
     */
    public function actionWriteOffShop()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
          'count' => 500
        ];
        //终端店列表
        $terminalModel = new Terminal();
        $terminalModel->find($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($terminalModel->getError())) {
            return $this->setError($terminalModel->getError());
        }
        return $this->render('write-off-shop',[ 'shopList' =>$terminalModel->_data['data']]);
    }

    /**
     * 核销管理-核销员排行榜
     */
    public function actionWriteOffStaff()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'is_cancel' => 1,
          'count' => 500
        ];
        $this->cancelModel->findCancelMember($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cancelModel->getError())) {
            return $this->setError($this->cancelModel->getError());
        }
        return $this->render('write-off-staff',[ 'cancelMember' =>$this->cancelModel->_data['data']]);
    }

    /**
     * 查看核销员列表
     */
    public function actionCancelMemberList()
    {
        return $this->render('write-off');
    }

    /**
     * 核销员分页数据
     */
    public function actionCancelMemberListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'is_cancel' => 1
        ];
        $this->getPageInfo($serviceParams);
        $this->cancelModel->findCancelMember($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cancelModel->getError())) {
            return $this->setError($this->cancelModel->getError());
        }
        $this->setResult($this->cancelModel->_data);
    }


    /**
     * 授权
     */
    public function actionOauthAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        //pr(Yii::$app->request);exit;
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);

        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->getPageInfo($serviceParams);
        $this->cancelModel->disableCancelMember($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cancelModel->getError())) {
            return $this->setError($this->cancelModel->getError());
        }
        $this->setResult($this->cancelModel->_data);
    }

    /*
     * 取消授权
     */
    public function actionCancelOauthAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        //pr(Yii::$app->request);exit;
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);

        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->getPageInfo($serviceParams);
        $this->cancelModel->disableCancelMember($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cancelModel->getError())) {
            return $this->setError($this->cancelModel->getError());
        }
        $this->setResult($this->cancelModel->_data);
    }


    /*
     * 核销员分页数据
     */
    public function actionCancelRecordListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }

        $form = new CancelRecordListAjaxForm();
        $this->checkForm(["CancelRecordListAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);

        $serviceParams += [
            'shop_id' => $this->_shop['id'],

        ];
        $this->getPageInfo($serviceParams);
        $this->cancelModel->findCancelRecords($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cancelModel->getError())) {
            return $this->setError($this->cancelModel->getError());
        }
        $this->setResult($this->cancelModel->_data);
    }

    /*
     * 添加核销员
     */
    public function actionCreateCancelMemberAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        //pr(Yii::$app->request->post());exit;
        $data = Yii::$app->request->post();
        foreach ($data['data'][0] as $k => $v) {
            $serviceParams = [
                'id' => $v['id'],
                'shop_id' => $this->_shop['id'],

            ];
            $this->cancelModel->createCancelMember($serviceParams);
        }

        // 接收逻辑层处理结果
        if (!is_null($this->cancelModel->getError())) {
            return $this->setError($this->cancelModel->getError());
        }
        $this->setResult($this->cancelModel->_data);
    }

    /*
     * 核销门店排行榜
     */
    public function actionShopsubCancelListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $post = Yii::$app->request->post();
        $form = new ShopsubCancelListAjaxForm();
        $this->checkForm(["ShopsubCancelListAjaxForm" => $post], $form);
        $serviceParams = $this->handleForm($form);

        // 把商家店铺都拿出来
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'shop_type' => $this->_shopSub['shop_type']
        ];
        $this->getPageInfo($serviceParams);
        //不传sortStr参数，则按核销次数降序排
        unset($serviceParams['sortStr']);
        if(isset($post['shop_sub_id']))
        {
            $serviceParams['shop_sub_id'] = $post['shop_sub_id'];
        }
        $this->cancelModel->findShopsubList($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cancelModel->getError())) {
            pr('ok');
            return $this->setError($this->cancelModel->getError());
        }
        $i = $this->cancelModel->_data['page']['current_page'] * $this->cancelModel->_data['page']['per_page'] + 1;
        foreach($this->cancelModel->_data['data'] as $key=>$val){
            $this->cancelModel->_data['data'][$key]['top'] = $i;
            $i++;
        }
        $this->setResult($this->cancelModel->_data);
    }

    /*
     * 核销员核销排行榜
     */
    public function actionStaffCancelListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // 把商家店铺都拿出来
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'shop_type' => $this->_shopSub['shop_type']
        ];
        $this->getPageInfo($serviceParams);
        $this->cancelModel->findStaffList($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cancelModel->getError())) {
            return $this->setError($this->cancelModel->getError());
        }
        $i = $this->cancelModel->_data['page']['current_page'] * $this->cancelModel->_data['page']['per_page'] + 1;
        foreach($this->cancelModel->_data['data'] as $key=>$val){
            $this->cancelModel->_data['data'][$key]['top'] = $i;
            $i++;
        }
        $this->setResult($this->cancelModel->_data);
    }

    /**
     * 查看员工列表
     */
    public function actionStaffList()
    {
        return $this->render('staff-list', ['wxAccount' => $this->_wxInfo['account']]);
    }

    /*
     * 添加员工
     */
    public function actionStaffAdd()
    {
        $wxAccount = $this->_wxInfo['account'];
        return $this->render('staff-add', ['wxAccount' => $wxAccount]);
    }

    /*
     * 修改员工
     */
    public function actionStaffEdit()
    {
        // form处理
        $form = new StaffEditForm();
        $this->checkForm(["StaffEditForm" => Yii::$app->request->get()], $form);
        $replaceParams = ['id' => 'staff_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->staffModel->get($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->staffModel->getError())) {
            return $this->setError();
        }
        $model = $this->staffModel->_data;
        $wxAccount = $this->_wxInfo['account'];
        return $this->render('staff-edit', [
            'model' => $model,
            'wxAccount' => $wxAccount
        ]);
    }

    /*
     * 修改登陆密码
     */
    public function actionStaffEditPwdAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new StaffEditPwdAjaxForm();
        $this->checkForm(["StaffEditPwdAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

        ];
        $this->staffModel->pwdUpdate($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->staffModel->getError())) {
            return $this->setError();
        }
        $model = $this->staffModel->_data;
        return $this->render('staff-edit', [
            'model' => $model
        ]);
    }

    /*
     * 员工分页数据
     */
    public function actionStaffListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'shop_type' => $this->_shopSub['shop_type']
        ];
        $this->getPageInfo($serviceParams);
        $this->staffModel->find($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->staffModel->getError())) {
            return $this->setError($this->staffModel->getError());
        }
        $this->setResult($this->staffModel->_data);
    }

    /*
     * 新增核销员员工列表
     */
    public function actionCancelStaffListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $data = Yii::$app->request->post();
        $serviceParams = [
            'is_cancel' => $data['is_cancel'],
            'shop_id' => $this->_shop['id'],
        ];
        $this->getPageInfo($serviceParams);
        $this->staffModel->find($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->staffModel->getError())) {
            return $this->setError($this->staffModel->getError());
        }
        $this->setResult($this->staffModel->_data);
    }

    /*
     * 添加员工
     */
    public function actionStaffAddAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new StaffAddAjaxForm();
        $this->checkForm(["StaffAddAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->staffModel->create($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->staffModel->getError())) {
            return $this->setError($this->staffModel->getError());
        }
        $this->setResult();
    }

    /*
     * 修改员工信息
     */
    public function actionStaffEditAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new StaffEditAjaxForm();
        $this->checkForm(["StaffEditAjaxForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'staff_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

        ];
        $this->staffModel->update($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->staffModel->getError())) {
            return $this->setError($this->staffModel->getError());
        }
        $this->setResult();
    }



    /*
     * 启用员工
     */
    public function actionStaffOpenAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new StaffOpenAjaxForm();
        $this->checkForm(["StaffOpenAjaxForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'staff_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

        ];
        $this->staffModel->staffOpen($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->staffModel->getError())) {
            return $this->setError($this->staffModel->getError());
        }
        $this->setResult();
    }

    /*
     * 禁用员工
     */
    public function actionStaffCloseAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new StaffCloseAjaxForm();
        $this->checkForm(["StaffCloseAjaxForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'staff_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

        ];
        $this->staffModel->staffClose($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->staffModel->getError())) {
            return $this->setError($this->staffModel->getError());
        }
        $this->setResult();
    }

    /*
     * 删除员工
     */
    public function actionStaffDelAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new StaffCloseAjaxForm();
        $this->checkForm(["StaffCloseAjaxForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'staff_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

        ];
        $this->staffModel->del($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->staffModel->getError())) {
            return $this->setError($this->staffModel->getError());
        }
        $this->setResult();
    }

    /*
     * 解绑员工
     */
    public function actionDisableStaffAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new StaffCloseAjaxForm();
        $this->checkForm(["StaffCloseAjaxForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'staff_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->staffModel->cancelBind($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->staffModel->getError())) {
            return $this->setError($this->staffModel->getError());
        }
        $this->setResult();
    }


    /*
     * 添加员工 角色
     */
    public function actionRoleAdd()
    {
        return $this->render('role-add');
    }

    /*
     * 修改员工 角色信息
     */
    public function actionRoleEdit()
    {
        return $this->render('role-edit');
    }

    /*
     * 修改员工权限
     */
    public function actionStaffRoleEdit()
    {
        return $this->render('staff-role-edit');
    }


    /**
     * 修改密码
     */
    public function actionTerminalPassword()
    {
        //终端店修改密码
        $staffModel = new Staff();
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'shop_sub_id'=>$this->getShopSubId(),
            'is_default'=>1,
            'shop_type' =>$this->getShopSubType()
        ];
        $staffModel->find($serviceParams);
        // 接收逻辑层处理结果

        if (!is_null($staffModel->getError())) {
            return $this->setError($staffModel->getError());
        }
        if(isset($staffModel->_data['data'][0]))
        {
            $model = $staffModel->_data['data'][0];
        }else{
            $model=null;
        }
        return $this->render('terminal-password', [  'model' =>$model,'wxInfo' => $this->_wxInfo]);
    }

    /**
     * 终端店 修改密码
     */
    public function actionTerminalEditPwdAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $post = Yii::$app->request->post();
        // form处理
        $form = new ResetPwdAjaxForm();
        $this->checkForm(["ResetPwdAjaxForm" => $post], $form);

        $replaceParams = ['id' => 'staff_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'shop_sub_id'=>$this->getShopSubId(),
        ];
        $staffModel = new Staff();
        $staffModel->pwdManagerUpdate($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($staffModel->getError())) {
            return $this->setError($staffModel->getError());
        }
        $this->setResult();
    }

    /**
     * 收款账号详情页面
     * @return string
     */
    public function actionStatement()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'shop_sub_id'=>$this->getShopSubId()
        ];

        $this->terminalModel->get($serviceParams);
        if (!is_null($this->terminalModel->getError())) {
            return $this->setError($this->terminalModel->getError());
        }
        $data =  $this->terminalModel->_data;
        return $this->render('statement', ['model' => $this->getStatementReceiveSetting(), 'data' => $data]);
    }

    /**
     * 收款账号设置页面
     * @return string
     */
    public function actionStatementReceiveSetting()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'shop_sub_id'=>$this->getShopSubId()
        ];

        $this->terminalModel->get($serviceParams);
        if (!is_null($this->terminalModel->getError())) {
            return $this->setError($this->terminalModel->getError());
        }
        $data =  $this->terminalModel->_data;
        return $this->render('statement-receive-setting', ['model' => $this->getStatementReceiveSetting(), 'data' => $data]);
    }

    /**
     * 获取账号设置信息
     * @return null|void
     */
    protected function getStatementReceiveSetting(){
        $statementModel = new Statement();
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'shop_sub_id'=>$this->getShopSubId(),
        ];
        $statementModel->getStatementReceiveSetting($serviceParams);
        if (!is_null($statementModel->getError())) {
            return $this->setError($statementModel->getError());
        }
        $model = $statementModel->_data?$statementModel->_data:null;
        return $model;
    }

    /**
     * 收款账户保存设置
     */
    public function actionStatementReceiveSettingAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
//        $post = Yii::$app->request->post();
//        // form处理
//        $form = new StatementReceiveSettingAjaxForm();
//        $this->checkForm(["StatementReceiveSettingAjaxForm" => $post], $form);
//        $serviceParams = $this->handleForm($form);

        $serviceParams = Yii::$app->request->post();
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $statement = new Statement();
        $statement->statementReceiveSetting($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($statement->getError())) {
            return $this->setError($statement->getError());
        }
        $this->setResult();
    }
}