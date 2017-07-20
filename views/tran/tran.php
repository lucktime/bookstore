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
        <button style="background-color:#1396e2; padding:10px; color:#fff;" onclick="Tran_slateChina();" >中文</button>
        <button style="background-color:#1396e2; padding:10px; color:#fff;" onclick="Tran_slateEnglish();" >English</button>
        <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
          <h1 class="blue center"><?= Yii::t('app', 'translate Demo');?></h1>
          <p class="grey center"><?= Yii::t('app', 'I want to know the immigration conditions and application process in Australia');?></p>
          <p style="background-color:#1396e2; padding:10px; color:#fff;"><?= Yii::t('app', 'Any solution to the problem will depend on whether you find the right person');?></p>
        </div>
      </div>
    </div>
   

<script type="text/javascript">

function Tran_slateEnglish(){

    window.location.href= "/tran18/language?locale=en";

}

function Tran_slateChina(){

    window.location.href= "/tran18/language?locale=zh-CN";

}
</script>