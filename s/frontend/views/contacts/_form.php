<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use borales\extensions\phoneInput\PhoneInput;

/* @var $this yii\web\View */
/* @var $model common\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'phone')->widget(PhoneInput::className(), [
                        'jsOptions' => [
                            'onlyCountries' => ['kz', 'ru', 'ua', 'md'],
                        ]
                    ])?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
