<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $model frontend\models\Payments */

$this->title = 'Payeer payment';
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
		
        <?php
		
			$m_shop = '605676476';
			$m_orderid = $model->id;
			$m_amount = number_format($model->amount, 2, '.', '');
			$m_curr = 'USD';
			$m_desc = base64_encode($model->description);
			$m_key = '79Fs123PcKfjIAH4D04';
			
			$arHash = array(
				$m_shop,
				$m_orderid,
				$m_amount,
				$m_curr,
				$m_desc
			);
			
			$arHash[] = $m_key;
			
			$sign = strtoupper(hash('sha256', implode(":", $arHash)));
		

		
		
		?>
        
		<?= Html::a('Confirm', 'https://payeer.com/merchant/', [
			'data'=>[
				'method' => 'post',
				'confirm' => 'Are you sure?',
				'params'=>['m_shop'=>$m_shop,
						   'm_orderid'=>$m_orderid,
						   'm_amount'=>$m_amount, 
						   'm_curr'=>$m_curr, 
						   'm_desc'=>$m_desc,
						   'm_sign'=>$sign,
						   ],
			],
			'class' => 'btn btn-success btn-block',
		]) ?>

		<br /><br />




    <?php ActiveForm::end(); ?>

</div>
