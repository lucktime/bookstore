##支付宝微信一码多付
PaymentqrController.php
主要插件：
```
https://github.com/helei112g/payment
composer require "riverslei/payment:~3.1"
如果PHP版本<=5.5 
composer require "riverslei/payment":"dev-master" --ignore-platform-reqs                              
```
step1：创建一个支付宝微信二维码

step2：实现支付宝H5支付

step3：实现微信公众号支付


##微信扫码登录实现

WxqrloginController.php

!!注意，在微信公众号开发设置授权redirect_url。
!!注意，在web目录下创建access_token.json文件，并赋予写入的权限。

##国际化，多语言的实现
Tran18Controller.php
step1:config/web.php设置国际化
```
    // ... andere Einstellungen
        'i18n' => [
            'translations' => [
            'app*' => [
                'class' => 'yii\i18n\GettextMessageSource',
                'basePath' => '@app/messages', // @app zeigt auf Yii2-Base
                // 'sourceLanguage' => 'zh-CN', // Standardsprache der Strings im Projekt
                // 'catalog' => 'zh_CN',//与@app/language/zh-CN/message.po文件名一致
                'useMoFile' => false,
            ],
            ],
        ],
```
step2:web.php 设置每次请求之前，先判断语言是什么语言。
```
$config = [
    ······
    'on beforeRequest' => function ($event) {
        $l_saved = null;
        if (true){
            # use cookie to store language
            $l_saved = Yii::$app->request->cookies->get('locale');
        }else{
            # use session to store language
            $l_saved = Yii::$app->session['locale'];
        }
        $l = ($l_saved)?$l_saved:'en';
        Yii::$app->sourceLanguage = (string)$l;
        Yii::$app->language = $l;
        return; 
    }, 
    ······

```
step3:创建messages文件夹，及文件下下面的内容。本次使用的是po国家化。
/en 
/zh-CN
```
https://poedit.net/
poedit编辑器进行翻译编译。
```
step4：
方法实现：
```
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
//NOTE:注意web.php on beforeRequest的函数修改。
```


###根据不同ip，对个别主页展示不同内容。
IppageController.php
step1:
```
安装插件：判断ip地理来源
composer  require "lysenkobv/yii2-geoip"
```

step2：
```
代码实现，具体看IppageController.php
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
```

