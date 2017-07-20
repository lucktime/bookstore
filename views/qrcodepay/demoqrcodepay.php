<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;


use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\bootstrap\js\dropdown;

$this->registerCss("
	.or-divider {
		text-align:center;
		margin-top:15px;
		margin-bottom:15px;
	}
	.Absolute-Center {
	margin: auto;
	position: absolute;
	top: 0; left: 0; bottom: 0; right: 0;
	}

");

$this->title = '付款 | dailongnet.com';
$this->params['wechatpay'][] = $this->title;
?>

<div class="center heading-bar white p-top-10 p-bottom-10">
    <h1 class="blue"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4bVxezgSV3vJUF_Ay291jcrxORXoPl68nMzLZyL7mx2pdm7yS" width="100px" class="right-10" alt="">扫码支付</h1>
</div>
<div class="center heading-bar white p-top-10 p-bottom-10">
    <img align="middle" src="http://qr.liantu.com/api.php?text=<?php echo $host?>/paymentqr/payqrcode"/>
</div>