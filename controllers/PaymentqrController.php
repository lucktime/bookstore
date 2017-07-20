<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use Payment\Common\PayException;
use Payment\Client\Charge;
use Payment\Config;
use Payment\ChargeContext;
use app\models\payment\WxpayProducts;

class PaymentqrController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
    *NOTE 需要补充，二维码徐亚携带商家id，才能实现类似收钱吧效果。
    *展示一码多付的商家二维码demo,二维码需要携带商家的id。
    */
    public function actionDemopayqrcode(){
        //展示 两个demo。
        $host = Yii::$app->params['host'];
        $renderPage = "/qrcodepay/demoqrcodepay";
        return $this->render($renderPage,[
            'host'=>$host
        ]);
    }

    /**
    * 判断是微信支付还是支付宝支付，如果是微信支付，跳转到微信浏览器，如果支付宝支付。跳转到支付宝浏览器
    *--ok
    */
    public function actionPayqrcode(){
          //判断是不是微信 
        if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {  
             //展示 两个demo。 
            $renderPage = "/paymentqr/wxpay";
            return $this->redirect($renderPage);  
        }    
        //判断是不是支付宝
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'AlipayClient') !== false) {
            $renderPage = "/paymentqr/alipay";
            return $this->redirect($renderPage);
        }
        //哪个都不是
        return "请使用支付宝或者微信浏览器进行支付";
    }

    /**
    *支付宝H5支付的实现 --ok
    */
    public function actionAlipay(){
        date_default_timezone_set('Asia/Shanghai');
        $aliConfig = require_once __DIR__ . '/../models/payment/aliconfig.php';

        // 订单信息cd
        $orderNo = time() . rand(1000, 9999);
        $payData = [
            'body'    => 'ali wap pay',
            'subject'    => '测试支付宝手机网站支付',
            'order_no'    => $orderNo,
            'timeout_express' => time() + 600,// 表示必须 600s 内付款
            'amount'    => '0.01',// 单位为元 ,最小为0.01
            'return_param' => 'tata',// 一定不要传入汉字，只能是 字母 数字组合
            'client_ip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1',// 客户地址
            'goods_type' => '1',
            'store_id' => '',
        ];

        
        try {
            $url = Charge::run(Config::ALI_CHANNEL_WAP, $aliConfig, $payData);
        } catch (PayException $e) {
            echo $e->errorMessage();
            exit;
        }
        // return $url; 
        header('Location:'.$url);
        exit;
    }
    /**
    *微信H5支付的实现
    */
    public function actionWxpay(){

        //①、获取用户openid
        /***
        上线取消这部分的注释。
        */
        // $tools = new WxpayProducts();
        // $openId = $tools->GetOpenid();

        $openId = 'o-e_mwTXTaxEhBM8xDoj1ui1f950';
        date_default_timezone_set('Asia/Shanghai');
        $wxConfig = require_once __DIR__ . '/../models/payment/wxconfig.php';

        $orderNo = time() . rand(1000, 9999);
        // 订单信息
        $payData = [
            'body'    => 'test body',
            'subject'    => 'test subject',
            'order_no'    => $orderNo,
            'timeout_express' => time() + 600,// 表示必须 600s 内付款
            'amount'    => '3.01',// 微信沙箱模式，需要金额固定为3.01
            'return_param' => '123',
            'client_ip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1',// 客户地址
            'openid' => $openId,
            'product_id' => '123'
        ];

        try {
            $ret = Charge::run(Config::WX_CHANNEL_PUB, $wxConfig, $payData);
        } catch (PayException $e) {
            echo $e->errorMessage();
            exit;
        }
        $renderPage = "/qrcodepay/wxh5pay.php";
        // return $ret;
        // var_dump(json_decode($ret));
        
        return $this->render($renderPage,[
            'data'=>$ret,
        ]);
        echo $ret;
    }

 
}          
