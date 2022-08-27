<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $model frontend\models\Payments */

$this->title = 'PerfectMoney payment';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-create">

    <h1 style="text-align:center"><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

		<hr />
		 <h4 class="col-lg-6" style="text-align:center"><?= 'Plan: '.$model->description ?></h4>
         
         <h4 class="col-lg-6" style="text-align:center"><?= 'Amount (USD): '.$model->amount ?></h4>
        
			
        
		<div style="clear:both"></div>
		<hr />

		<?= Html::a('Confirm', 'https://perfectmoney.is/api/step1.asp', [
			'data'=>[
				'method' => 'post',
				'confirm' => 'Are you sure?',
				'params'=>['PAYEE_ACCOUNT'=>'U17138927', 
						   'PAYEE_NAME'=>'markhar.com',
						   'PAYMENT_AMOUNT'=>$model->amount, 
						   'PAYMENT_UNITS'=>'USD', 
						   'STATUS_URL'=>'https://markhar.com/frontend/web/payments/perfectmoneycheck',
						   'PAYMENT_URL'=>'https://markhar.com/frontend/web/payments/perfectmoneyok', 
						   'NOPAYMENT_URL'=>'https://markhar.com/frontend/web/payments/perfectmoneyerror', 
						   'PAYMENT_ID'=>$model->id],
			
			],
			'class' => 'btn btn-success btn-block',
		]) ?>

		<br /><br />




    <?php ActiveForm::end(); ?>

</div>
