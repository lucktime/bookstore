<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php 
       $geoip = new \lysenkobv\GeoIP\GeoIP();
        $ip = $geoip->ip("202.101.164.228");
        // $ip = $geoip->ip(); // current user ip
        $city = $ip->city; // "San Francisco"
        $country = $ip->country; // "United States"
        $lng = $ip->location->lng; // 37.7898
        $lat = $ip->location->lat; // -122.3942
        $isoCode = $ip->isoCode; // "US"
        $cityarray=array("Shanghai","Hangzhou");
        if ($isoCode == "CN" && in_array($city,$cityarray) ) {
            // echo "<h1>显示 $city 专栏</h1>";
            // print_r($ip);
            // print_r("city:{$city},country:{$country},lng:{$lng},lat:{$lat},org:{$org},isoCode:{$isoCode}");
        } else {
            //  echo "<h1>显示非上海专栏</h1>";
        }
?>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => "$city", 'url' => ['/site/index']],
            ['label' => "lng:$lng", 'url' => ['/site/about']],
            ['label' => "lat:$lat", 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
         <!--ipaddr 根据ip地址，显示不同的layout-->
    <?php
      if ($isoCode == "CN" && in_array($city,$cityarray) ) {
            echo "<p>显示 $city 专栏</p>";
        } else {
             echo "<p>显示非上海专栏</p>";
        }
    ?>
    </div>
   
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
