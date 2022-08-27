<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Survey */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="survey-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <?php $items = ArrayHelper::map(User::find()->all(),'id','username');
		$params = [
        	'prompt' => 'Укажите пользователя'
    	];
	?>

	

    <?= $form->field($model, 'user_id')->dropDownList($items,$params); ?>
    
        
    <?= $form->field($model, 'description')->textarea(['rows' => 5, 'cols' => 5]); ?>
    
     <?= $form->field($model, 'sound_on')->textInput(['maxlength' => true]); ?>
      <?= $form->field($model, 'sound_off')->textInput(['maxlength' => true]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
