<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

use common\models\Payments;
use common\models\Withdrawals;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
  //  $menuItems = [
 //       ['label' => 'Main', 'url' => ['/site/index']],
 //   ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
    } else {
        if (Yii::$app->user->can('viewAdminPage')){
     		//$menuItems[] = ['label' => 'Добавить логин', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Пользователи', 'url' => ['/user/index']];
            $menuItems[] = ['label' => 'Платежи', 'url' => ['/payments/index']];
            $menuItems[] = ['label' => 'Заявки на вывод', 'url' => ['/withdrawals/index?status=0']];
            $menuItems[] = ['label' => 'Начисления', 'url' => ['/earnings/index']];
            
		}
		$menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выход (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
<div class="tools">
    <b>Текущий курс USD:</b> <?=Payments::getKztusdrate()?> тенге / <b>Фонд вторых выплат (по $50):</b> $<?=Withdrawals::fond_all_second_payments()?> / <b> Фонд компании:</b> $<?=Withdrawals::company_fond()?> / <b> Накопительный фонд:</b> $<?=Withdrawals::intellect_fond()?>
</div>

    <div class="">
        <?= Breadcrumbs::widget([
			'homeLink' => ['label' => 'Главаная', 'url' => '/'],
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
