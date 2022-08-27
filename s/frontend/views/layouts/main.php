<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\models\User;
use yii\bootstrap\ActiveForm;
use common\models\Payments;
use common\models\Contacts;

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
    <?php $this->head();?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-P5BCJXM');</script>
    <!-- End Google Tag Manager -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P5BCJXM"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<?php $this->beginBody() ?>

<div class="wrap">

    <?php
    NavBar::begin(/* [
       'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]*/);
	echo '<div class="logo"></div>';
    if (Yii::$app->user->isGuest) {
		$menuItems = [
        ['label' => 'Главная  ', 'url' => '/'],
    //    ['label' => 'О проекте', 'url' => '/about'],
	//	['label' => 'Маркетинг план', 'url' => '/plan'],
	//	['label' => 'Полезная информация', 'url' => '/info'],
	//	['label' => 'Контакты', 'url' => '/contacts'],
		['label' => 'Регистрация', 'url' => ['/site/signup']],
		['label' => 'Вход', 'url' => ['/site/login']]
    ];
    
        //$menuItems[] = ;
    } else {
		$menuItems = [
            ['label' => 'Главная  ', 'url' => '/'],
    //        ['label' => 'О проекте', 'url' => '/about'],
    //        ['label' => 'Маркетинг план', 'url' => '/plan'],
    //        ['label' => 'Полезная информация', 'url' => '/info'],
    //        ['label' => 'Контакты', 'url' => '/contacts'],
		];
		//$menuItems[] = ['label' => 'Stats', 'url' => ['/user/index'], 'class' => 'home'];
		//$menuItems[] = ['label' => 'Payments', 'url' => ['/payments/index'], 'class' => 'payments'];
		//$menuItems[] = ['label' => 'Earnings', 'url' => ['/earnings/index'], 'class' => 'earnings'];
		//$menuItems[] = ['label' => 'Withdrawals', 'url' => ['/withdrawals/index'], 'class' => 'withdrawals'];
		//$menuItems[] = ['label' => 'Profile', 'url' => ['/user/update'], 'class' => 'profile'];
		//$menuItems[] = '<li class = "payments"><a href="/payments/index">Payments</a></li>';
		$menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выход (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout text-white']
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

    <div class="container">
    	
        <?php
		if (Yii::$app->user->isGuest) {
			?>
                <?= Breadcrumbs::widget([
                    'homeLink' => ['label' => 'Главная', 'url' => '/'],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                
                <?= Alert::widget() ?>
                <?= $content ?>
			<?php
		} else {	?>
        	<div class="row">
                <div class="col-lg-3 side_menu">
                	<h3 class="text-center"><?=Yii::$app->user->identity->last_name ?> <?=Yii::$app->user->identity->first_name ?></h3>
                    <hr>
					<?php
                        $leftmenuItems[] = ['label' => 'Стартовая', 'url' => ['/user/index'], 'class' => 'payments'];
						$leftmenuItems[] = ['label' => 'История платежей', 'url' => ['/payments/index'], 'class' => 'payments'];
                    //kbb 17.01.22 13:36
//                        $leftmenuItems[] = ['label' => 'Заявки на вывод', 'url' => ['/withdrawals/index'], 'class' => 'withdrawals'];
//						$leftmenuItems[] = ['label' => 'Вознаграждения', 'url' => ['/earnings/index'], 'class' => 'earnings'];
						//kbb 16.01.22 1:22
						$leftmenuItems[] = ['label' => 'Мои продажи', 'url' => ['/user/invited'], 'class' => 'invited'];
//                        if(Yii::$app->user->identity->can_left)
//                            $leftmenuItems[] = ['label' => 'Мои знакомые', 'url' => ['/contacts/index?type=1'], 'class' => 'profile'];
//                        if(Yii::$app->user->identity->can_right)
//                            $leftmenuItems[] = ['label' => 'Дополнительные контакты', 'url' => ['/contacts/index_add?type=2'], 'class' => 'profile'];
//                        $leftmenuItems[] = ['label' => 'Подарочные аккаунты', 'url' => ['/user/presented'], 'class' => 'presented'];
                        $leftmenuItems[] = ['label' => 'Ваши данные', 'url' => ['/user/update'], 'class' => 'profile'];
						echo Nav::widget([
							'options' => ['class' => 'left-navbar-nav'],
							'items' => $leftmenuItems,
						]);
						
					?><hr>
<!--                        kbb 16.01.22 1:29-->
                        <div class="tools">
                            <div style="clear:both"><hr></div>
                            <div> 
                                <b>Ваш АН: <?= Yii::$app->user->identity->id ?></b><br>
                                Агентская ссылка:<br>
                                <a href="https://marqar.kz/s/ref/?rid=<?= Yii::$app->user->identity->id ?>">https://marqar.kz/s/ref/?rid=<?= Yii::$app->user->identity->id ?></a> 
                            </div>

                            <div style="clear:both"><hr></div>
                            <div>Выполнено продаж: <?=User::get_invited_users(Yii::$app->user->identity->id)?></div>

<!--                            <div style="clear:both"><hr></div>-->
<!--                            <div>Приглашенные пользователи: --><?//=User::get_invited_users(Yii::$app->user->identity->id)?><!--</div>-->
<!---->
<!--                            <div style="clear:both"><hr></div>-->
<!--                            <div> Стандартные условия: <br>--><?//= Yii::$app->user->identity->can_right ? 'Выполнены' : 'Не выполнены'?><!--<br></div>-->
<!--                            -->
<!--                            <div style="clear:both"><hr></div>-->
<!--                            -->
<!--                            <div class="col-md-6">Баллы слева: --><?//=Yii::$app->user->identity->left_points?><!--</div>-->
<!--                            <div class="col-md-6">Баллы справа: --><?//=Yii::$app->user->identity->right_points?><!--</div>-->
<!--                            -->
<!--                            <div style="clear:both"><hr><br></div>-->
<!--                           -->
<!--                            <div>Добавлено друзей: --><?//=Contacts::getUser_contacts_num(Yii::$app->user->identity->id)?><!--</div>-->
<!---->
<!--                            <div style="clear:both"><hr></div>-->
<!--                           -->
<!--                            <div>Дополнительные пользователи: --><?//=User::get_add_users(Yii::$app->user->identity->id)?><!--</div>-->
<!---->
                            <div style="clear:both"><hr></div>
                           
                            <div>Текущий курс USD: <?=Payments::getKztusdrate()?> тенге</div>
                            <div style="clear:both"><hr></div>
                        </div>
                    
                </div>
                
                
                
                <div class="col-lg-9 content">
                    <?= Breadcrumbs::widget([
                        'homeLink' => ['label' => 'Главная', 'url' => '/'],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
            </div>
        <?php
		}
		?>
        <div class="row">
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Markhar  <?= date('Y') ?></p>
    </div>
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
