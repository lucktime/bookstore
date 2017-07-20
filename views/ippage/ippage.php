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

");

$this->title = 'Alipay | www.dailong.com';
$this->params['wechatpay'][] = $this->title;
?>
    <div class="container-fluid white border-bottom-1 bottom-10 p-bottom-10">
      <div class="row">      

        <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
          <p style="background-color:#1396e2; padding:10px; color:#fff;">显示<?= isset($city)?$city:"layout" ?>专栏</p>
        </div>
      </div>
    </div>

<script type="text/javascript">
</script>