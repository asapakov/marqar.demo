<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use borales\extensions\phoneInput\PhoneInput;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
<?
//var_dump($model);
//exit;
?>
    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-8">
        <?= $form->field($model, 'username')->textInput([ 'disabled' => true])->label('Пользователь (email)') ?>
    </div>
    <div class="col-md-4 text-center">
        <p><br>Дата регистрации:<br>   <?= date("d.m.Y",  $model->created_at)?></p>
    </div>

    <div style="clear:both"><hr /></div>
<div class="data_block">
    <div class="col-md-4">
	    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-4">
	    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-4">
	    <?= $form->field($model, 'patr_name')->textInput(['maxlength' => true]) ?>
    </div>
</div>

    <div style="clear:both"><hr /></div>
<div class="data_block">
    <div class="col-md-4">
        <?= $form->field($model, 'iin')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-4">
        <?= $form->field($model, 'date_birth')->input('date') ?>
    </div>

    <div class="col-md-4">
        <?=$form->field($model, 'phone')->widget(PhoneInput::className(), [
                        'jsOptions' => [
                            'onlyCountries' => ['kz', 'ru', 'ua', 'md'],
                        ]
                    ])?>
    </div>
</div>

<div style="clear:both"><hr /></div>
<div class="data_block">
    <div class="col-md-4">
	    <?= $form->field($model, 'id_num')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-4">
	    <?= $form->field($model, 'id_givenby')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-4">
	    <?= $form->field($model, 'id_validdate')->input('date') ?>
    </div>
</div>

<div style="clear:both"><hr /></div>
<div class="data_block col-md-5">
    <div class="col-md-12">
	    <?= $form->field($model, 'card_num')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-12">
        Срок годности:
	    <?= $form->field($model, 'card_validdate_month')->textInput(['maxlength' => true]) ?>
    
	    <?= $form->field($model, 'card_validdate_year')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-12">
	    <?= $form->field($model, 'card_name')->textInput(['maxlength' => true]) ?>
    </div>
</div>


<div class="data_block col-md-6">
    <div class="col-md-12">
	    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-12">
	    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
	    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
	    <?= $form->field($model, 'house')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
	    <?= $form->field($model, 'apartment')->textInput(['maxlength' => true]) ?>
    </div>
</div>
<hr />





    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
