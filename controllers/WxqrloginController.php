<?php

/**
*微信二维码扫码登录的实现
*/
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Wechat;

class WxqrloginController extends Controller
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
   // 已经登录的话，跳转页面
// 没有登录。跳转到登录页面
    public function actionLogin(){

    $weixin = new Wechat(); 
    $renderPage = '/qrcodelogin/qrcodelogin';
    if (!isset($_GET["code"])){ 
        // $redirect_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
        $redirect_url = "http://mp2.dailongnet.com/site/login";// 这个需要微信公众号设置授权地址，redirect_url。
        $jumpurl = $weixin->qrconnect($redirect_url, "snsapi_login", "STATE"); 
        Header("Location: $jumpurl"); 
        exit;
    }else{ 
        $oauth2_info = $weixin->oauth2_access_token($_GET["code"]); 
        $userinfo = $weixin->oauth2_get_user_info($oauth2_info['access_token'], $oauth2_info['openid']); 
        // 使用时添加->判断数据是否已经存在 //::NOTE 数据库判断数据是否存在，测试部分可以直接注释。
        $rel = false;
        if($rel){
            $renderPage = '/site/index';
        }
        else{
            print_r("data====");
            // print_r($userinfo);
            $jsonStr=json_encode($userinfo);  //（这个是你输出的字符串）
            $myArr=json_decode($jsonStr, true);
            ##以下数据存在问题
            $openid = $myArr['openid'];
            $nickname = $myArr['nickname'];
            $sex = $myArr['sex'];
            $language = $myArr['language'];
            $city = $myArr['city'];
            $province = $myArr['province'];
            $country = $myArr['country'];
            $headimgurl = $myArr['headimgurl'];
            $unionid = $myArr['unionid'];
            // 使用时添加->数据写入数据库。
            var_dump("注册成功。"); 
            return json_encode($myArr);
        }
        
    } 
     
     return $this->redirect($renderPage);
    }
 
}          
