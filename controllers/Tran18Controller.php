<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
// use yii\web\Cookie;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class Tran18Controller extends Controller
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
      return $this->render('/tran/tran', []);
    }

    /**
    *国际化，demo展示
    */
    public function actionTrandemo(){
      // TODO: encrype AES
      return $this->render('/tran/tran', []);
    }
    /**
    * 设定语言： 1) 设置cookie，2) 跳转回原来的页面
    * 访问网址 - http://.../tran/language?locale=zh-CN
    * @return [type] [description]
    */
    public function actionLanguage(){
        $locale = Yii::$app->request->get('locale');
        if ($locale){
            #use cookie to store language
            $l_cookie = new \yii\web\Cookie(['name' => 'locale', 'value' => $locale, 'expire' => 3600*24*30,]);
            $l_cookie->expire = time() + 3600*24*30;
            Yii::$app->response->cookies->add($l_cookie);
        }
        $this->goBack(Yii::$app->request->headers['Referer']);
    }

}
