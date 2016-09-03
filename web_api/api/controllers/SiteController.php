<?php  
namespace api\controllers;  
use yii\rest\ActiveController;  
use yii\rest\Controller;  
use Yii;
use common\exception\BusinessException;
class SiteController extends Controller
{  

    private $ipColony = array('127.0.0.1');
    private $illegal  = false;
    private $md5Key  = "e4e723f614711651d80b44af9ef68f9b";
    private $fixedKey  = "e4e723f614711651d80b44af9ef68f9b";

    public function beforeAction($action){
        if (!parent::beforeAction($action)) {
            return false;
        }
        $isPost = Yii::$app->request->isPost;
        //判断是否是post的方式
        if($isPost){
            $postData = Yii::$app->request->post();
            $postData = file_get_contents('php://input');

            //效验数据的有效性
            if($this->formValue($postData)){
                $postData = json_decode($postData,true);
                $keyData['authorType'] = $postData['AuthorType'];
                $keyData['appSign'] = $postData['AppSign'];
                unset($postData['AuthorType']);
                unset($postData['AppSign']);
                //提前拼接完顺序
                array_multisort($postData);
                $keyData['sequence'] = implode('',$postData);
                $signType = $this->getAppSign($keyData);
                if($signType === false){
                    throw new BusinessException(Yii::t('exception', '10002'), 10002);die;
                }else{
                    $this->illegal = true;
                }
            }else{
                throw new BusinessException(Yii::t('exception', '10006'), 10006);die;
            }
        }

        if($this->illegal === false){
            throw new BusinessException(Yii::t('exception', '10001'), 10001);die;
        }
        return true;
    }

    public function actionIndex($action){
        echo 123;die();
    }

    /**
     * [formValue 效验数据的有效性]
     * @param  json  $data [description]
     * @return [type]       [description]
     */
    public function formValue($data = ''){
        $formType = false;
        if(!empty($data)){
            if(json_decode(is_string($data)) != null){
                $newData = json_decode($data,true);
                if((isset($newData['AuthorType']) && isset($newData['AppSign'])) && (!empty($newData['AuthorType']) && !empty($newData['AppSign']))){
                    $formType = true;
                }
            }
        }

        return $formType;
    }

    /**
     * [getAppSign 判断秘钥的准确性]
     * @param  array $data['authorType']-秘钥类型;$data['appSign']-传过来的秘钥值;$data['sequence']-数组升序之后串起来的字符串 ;
     * @return [bool] [fale为验证失败，true为验证成功]
     */
    public function getAppSign($data = array()){
        $signType = false;
        if(!empty($data)){
            if($data['authorType'] == 1){
                $appSign = MD5($data['sequence'].strtotime(date("YmdHi")).$this->md5Key);
                if($data['appSign'] === $appSign){
                    $signType = true;
                }
            }else if($data['authorType'] == 2){
                if($this->fixedKey === $data['appSign']){
                    $signType = true;
                }
            }else if($data['authorType'] == 3){
                $visitIp = $this->getIp();
                $ipColony = $this->ipColony;
                //验证所获得的ip是否在白名单里
                if(in_array($visitIp,$ipColony)){
                    $signType = true;
                }
            }      
        }
        return $signType;
    }

    /**
     * [getIP 获取调用接口的ip地址]
     * @return [string] [获取到的接口]
     */
    function getIp(){
        static $realip;
        if (isset($_SERVER)){
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $realip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $realip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")){
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            } else {
                $realip = getenv("REMOTE_ADDR");
            } 
        }
        return $realip;
    }
}
