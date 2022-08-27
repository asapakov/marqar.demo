<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\User;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model backend\models\Variants */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="variants-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $items = ArrayHelper::map(User::find()->all(),'id','username');
		$params = [
        	'prompt' => 'Select User'
    	];
	?>

    <?= $form->field($model, 'user_id')->dropDownList($items,$params); ?>
    
    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>   
    <?= $form->field($model, 'description')->textarea(['rows' => 5, 'cols' => 5]); ?>
    
    <?php 
		$items = [
				  0 => 'AdvCash',
				  1 => 'Bitcoin',
				  2 => 'Payeer',
				  3 => 'PerfectMoney',
		];

		echo $form->field($model, 'type')->dropDownList($items); 
	?>

    <div class="form-group">
    
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
