<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Payments */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="payments-form">

    <?php $form = ActiveForm::begin(); ?>

	<?php 
		$items = [
				  0 => 'PerfectMoney',
				  1 => 'Payeer',
				 // 2 => 'AdvCash',
				 // 3 => 'Bitcoin',
		];

		echo $form->field($model, 'type')->dropDownList($items); 
	?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    
    <div class="form-group">
        <?= Html::submitButton( 'Submit', ['class' => 'btn btn-success', 'id' => 'finishbutton']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
