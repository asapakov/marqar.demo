<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;


$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
	<hr />

<?php if( Yii::$app->session->hasFlash('success') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success'); ?>
    </div>
<?php endif;?>
<!--    kbb 02.02.22 22:22-->
    <div>
        <div class="data_block">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true], ['autofocus' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'first_name')->textInput() ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'patr_name')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div style="clear:both"></div>
            <div class="row">
                <div class="col-md-4">
                	<?= $form->field($model, 'email') ?>
                </div>
                <div class="col-md-4">
                    <?=$form->field($model, 'phone')->widget(PhoneInput::className(), [
                         'jsOptions' => [
                              'preferredCountries' => ['kz', 'ru', 'ua', 'md'],
                         ]
                        // 'jsOptions' => [
                        //     // 'onlyCountries' => ['kz', 'ru', 'ua', 'md'],
                        // ]
                    ])?>
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
<!--                	--><?//= $form->field($model, 'password')->textInput(['minlength' => true]) ?>
                	<?= $form->field($model, 'password')->passwordInput(['minlength' => true]) ?>
                    <?= Html::checkbox('reveal-password', false, ['id' => 'reveal-password']) ?> <?= Html::label('Посмотреть пароль', 'reveal-password') ?>
                </div>
                <div class="col-md-4">
                    <?php
                    if( !empty( $_SESSION['rid'] ) )
                        echo $form->field($model, 'rid')->textInput(['value'=> $_SESSION['rid']]);
                    else
                        echo $form->field($model, 'rid').'<i>(По-умолчанию: 1)</i>';
                    ?>
                </div>
<!--                <div class="col-lg-5">-->
<!--                	--><?//= $form->field($model, 'repeat_password')->textInput(['compare' => true]) ?>
<!--                	--><?//= $form->field($model, 'repeat_password')->passwordInput(['compare' => true]) ?>
<!--                    --><?//= Html::checkbox('reveal-password', false, ['id' => 'reveal-password']) ?><!-- --><?//= Html::label('Show password', 'reveal-password') ?>
<!--                </div>-->
            </div>

                <div style="clear:both"><br><Br></div>

                <div style="clear:both"> </div>


                <div class="col-lg-3"><div style="margin: 10px 0px;"><?= Html::a('Условия участия', '/dokumenty/usloviya-marketingovoj-programmy/') ?> и <?= Html::a('Оферта', '/dokumenty/dogovor-o-vozmezdnom-okazanii-servisnyh-uslug/') ?></div></div>
                <div class="col-lg-6"><?= $form->field($model,'agreement')->checkBox()->label('Согласен (-на) с условиями. Подтверждаю, что мне больше 21-го года.') ?></div>

				<div class="col-lg-3">



                <div class="form-group">

                    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>

                </div></div>
        </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php
    $this->registerJs("jQuery('#reveal-password').change(function(){jQuery('#signupform-password').attr('type',this.checked?'text':'password');})");
?>

