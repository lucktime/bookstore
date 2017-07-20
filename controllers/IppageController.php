<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
// use yii\web\Cookie;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class IppageController extends Controller
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
      return $this->render('/ippage/ippage.php', []);
    }

    //根据ip，显示不同的页面。

    public function actionIppagedemo(){
        //展示demo.也可以直接在layout设置，以达到自己想要的效果。
        $geoip = new \lysenkobv\GeoIP\GeoIP();
        $ip = $geoip->ip("202.101.164.228");
        // $ip = $geoip->ip(); // current user ip
        $city = $ip->city; // "San Francisco"
        $country = $ip->country; // "United States"
        $lng = $ip->location->lng; // 37.7898
        $lat = $ip->location->lat; // -122.3942
        $isoCode = $ip->isoCode; // "US"
        $cityarray=array("Shanghai","Hangzhou");
        if ($isoCode == 'CN' && in_array($city,$cityarray) ) {
            // echo "<h1>显示 $city 专栏</h1>";
            // print_r("city:{$city},country:{$country},lng:{$lng},lat:{$lat},org:{$org},isoCode:{$isoCode}");
        } else {
                // echo "<h1>显示非上海专栏</h1>";
        }
        $renderPage = "/ippage/ippage.php";
        return $this->render($renderPage,[
            'city'=>$city
        ]);
    }
    /**
    *根据不同地理ip，展示不同的layout内容效果。
    */
    public function actionIplayoutdemo(){
        $this->layout = "iplayout";
        //展示demo.也可以直接在layout设置，以达到自己想要的效果。
        $renderPage = "/ippage/ippage.php";
        return $this->render($renderPage,[
        ]);
    }

}
