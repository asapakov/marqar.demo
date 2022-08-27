<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Surveys */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surveys-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $items = ArrayHelper::map(User::find()->all(),'id','username');
		$params = [
        	'prompt' => 'Select User'
    	];
	?>
    <?= $form->field($model, 'user_id')->dropDownList($items,$params); ?>

    <?php 
		$items = [
				  0 => 'Ref',
				  1 => 'Plan',
		];

		echo $form->field($model, 'type')->dropDownList($items); 
	?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
