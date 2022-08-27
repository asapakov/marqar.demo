<?php

use common\models\UserSearch;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Payments;
use common\models\Withdrawals;
use common\models\Earnings;

use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//kbb 15.01.2022 23:22
$this->title = 'ЛИЧНЫЙ КАБИНЕТ';
//$this->title = 'ВЕБ-ОФИС';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    
                    	
    <div style="clear:both"></div>                	
                        
    <hr>
    <h2 style="text-align:center"><?= Html::encode($this->title) ?></h2>

 <h3>Оплата (последние три)</h3>
    <?= GridView::widget([
        'dataProvider' => $paymentsProvider,
		'layout' => '{items}{pager}',
        //'filterModel' => $searchModel,
        'columns' => [
            'id',
            // [
			// 	'attribute' => 'type',
            //     'value' => function($data)
            //                 {
            //                    return $data->gettype($data->type);
            //                 },
            // ],

            [
				'attribute' => 'description',
                'value' => function($data)
                            {
                               return mb_substr($data->description, 0, 50).'...';
                            },
            ],
            'amount',
			['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y']],
			[
				'attribute' => 'status',
                'value' => function($data)
                            {
                               return $data->getstatus($data->status);
                            },
            ],
			[
				'header' => ' ',
                'value' => function($data)
                            {
                            	if($data->status == 0)
									//return '<a href="'.Payments::create_robokassa_link($data->id).'">Оплатить</a>';   //Html::a('Оплатить', [ 'payments/pay', 'payment_id' => $data->id ]);
                                    return "<a href='#' onclick='$(\"#kaspi_qr\").modal(\"show\");'>Kaspi QR</a><br>
                                            <a href='#' onclick='$(\"#rekvizity\").modal(\"show\");'>По реквизитам</a>";
								else
									return '-';
                            },
				'format' => 'raw',
            ],
        ],
    ]); ?>

<!--kbb 15.01.2022 23:22-->
<!--<h3>Вознаграждения (последние три)</h3>-->
<!---->
<!--    --><?//= GridView::widget([
//        'dataProvider' => $earningsProvider,
//		'layout' => '{items}{pager}',
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
//           // 'user_id',
//            'amount',
//			[
//				'attribute' => 'type',
//                'value' => function($data)
//                            {
//                                switch ($data->type) {
//									case 1:
//										$type = 'Бонус Участника';
//										break;
//
//
//								}
//
//								return $type;
//                            },
//            ],
//            'description',
//            ['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y H:i:s']],
//
//            //['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); ?>

<!--kbb 17.01.2022 15:46-->
<!--<h3>Заявки на вывод (последние три)</h3>-->
<!---->
<?//= GridView::widget([
//        'dataProvider' => $withdrawalsProvider,
//		'layout' => '{items}{pager}',
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
//            //'user_id',
//            'amount',
//            'description',
//            //'updated_at',
//            [
//				'attribute' => 'status',
//                'value' => function($data)
//                            {
//                                switch ($data->status) {
//									case 0:
//										$status = 'На рассмотрении';
//										break;
//									case 1:
//										$status = 'Выплачено';
//										break;
//									case 10:
//										$status = 'Отмена';
//										break;
//
//								}
//
//								return $status;
//                            },
//            ],
//            ['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y H:i:s']],
//            //['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); ?>

<hr>
<div style="text-align:center">
    <!-- kbb 03.02.22 1:31 -->
    <?php
        $earnings = Earnings::get_user_earnings(Yii::$app->user->identity->id);
        $withdrawals = Withdrawals::get_user_withdrawals(Yii::$app->user->identity->id);

//        $balans = $earnings - $withdrawals;

        $ibank = $earnings * 0.05;
        $grants = $earnings * 0.01;
        $balans = $earnings - $ibank - $grants - $withdrawals;
        $pending = Withdrawals::get_pending_user_withdrawals(Yii::$app->user->identity->id);
        $max_w = $balans - $pending;

        // kbb 23.02.22 23:14
//        $rewards = UserSearch::get_user_rewards(Yii::$app->user->identity->id);
        //kbb 02.03.22 1:22
        $eac = Earnings::get_agent_commissions(Yii::$app->user->identity->id);
        $wac = Withdrawals::get_agent_commissions(Yii::$app->user->identity->id);
        $bac = $eac - $wac;
        $pac = Withdrawals::get_pending_agent_commissions(Yii::$app->user->identity->id);
        $max_ac = $bac - $pac;

        //kbb 10.05.22 21:44
        $big_bonus = Withdrawals::get_user_big_bonus(Yii::$app->user->identity->id);
    ?>

    <div class="row text-left h4">
        <div class="col-md-6">МОИ НАЧИСЛЕНИЯ</div>
        <div class="col-md-6"><?=number_format($earnings, 2, '.', ' ')?></div>
    </div>
    <div class="row text-left h4">
        <div class="col-md-6">МОИ ПРЕМИИ</div>
        <div class="col-md-6"><?=number_format($big_bonus, 2, '.', ' ')?></div>
    </div>
    <div class="row text-left h4">
        <div class="col-md-6">ГРАНТЫ</div>
        <div class="col-md-6"><?=number_format($grants, 2, '.', ' ')?></div>
    </div>
    <div class="row text-left h4">
        <div class="col-md-6">i-MARKET</div>
        <div class="col-md-6"><?=number_format($ibank, 2, '.', ' ')?></div>
    </div>
    <div class="row text-left h4">
        <div class="col-md-6">МОИ ДОХОДЫ</div>
        <div class="col-md-6"><?=number_format($withdrawals, 2, '.', ' ')?></div>
    </div>
    <div class="row text-left h4">
        <div class="col-md-6 text-success">БАЛАНС</div>
        <div class="col-md-6 text-success"><?=number_format($balans, 2, '.', ' ')?></div>
    </div>
<!-- kbb 02.03.22 3:31-->
    <div class="row text-left h4">
        <div class="col-md-6 text-danger">СУММА НА РАССМОТРЕНИИ</div>
        <div class="col-md-6 text-danger"><?=number_format($pending, 2, '.', ' ')?></div>
    </div>
    <div class="row text-left h4">
        <div class="col-md-6">ВЫВОД ПВ</div>
        <div class="col-md-6">

            <?php
            if($max_w > 50) {
                echo Html::beginForm(['withdrawals/create'], 'post', ['enctype' => 'multipart/form-data']);
                echo Html::hiddenInput('max_amount', $max_w);
                echo Html::hiddenInput('user_id', Yii::$app->user->identity->id, ['style' => 'width:50px;']);
                //kbb 02.03.22 2:07
                echo Html::hiddenInput('type', 1, ['style' => 'width:50px;']);
                ?>

                <?= Html::textInput('amount', '', ['id' => 'amount', 'type' => 'number', 'max' => floor($max_w),'style' => 'width:150px;'])?>
                <?= Html::submitButton('Вывести',
                    ['data' => ['confirm' => 'Вы уверены?'],
                        'style' => 'background-color: #09F;  padding: 4px 10px; font-size: 12px;',
                        'name' => 'submitbutton',
                        'class' => 'btn',
                    ]
                )?>
                <?php
                echo Html::endForm();
            }
            ?>
        </div>
    </div>
    <hr>

    <!-- kbb 23.02.22 23:14   -->
    <div class="row text-left h4">
        <div class="col-md-6">МОИ АВ</div>
        <div class="col-md-6"><?=number_format($wac, 2, '.', ' ')?></div>
    </div>
    <div class="row text-left h4">
        <div class="col-md-6 text-success">БАЛАНС АВ</div>
        <div class="col-md-6 text-success"><?=number_format($bac, 2, '.', ' ')?></div>
    </div>
<!--    kbb 02.03.22 1:48-->
    <div class="row text-left h4">
        <div class="col-md-6 text-danger">СУММА АВ НА РАССМОТРЕНИИ</div>
        <div class="col-md-6 text-danger"><?=number_format($pac, 2, '.', ' ')?></div>
    </div>
    <div class="row text-left h4">
        <div class="col-md-6">ВЫВОД АВ</div>
        <div class="col-md-6">

            <?php
            if($max_ac > 0) {
                echo Html::beginForm(['withdrawals/create'], 'post', ['enctype' => 'multipart/form-data']);
                echo Html::hiddenInput('max_amount', $max_ac);
                echo Html::hiddenInput('user_id', Yii::$app->user->identity->id, ['style' => 'width:50px;']);
                echo Html::hiddenInput('type', 30, ['style' => 'width:50px;']);
                ?>

                <?= Html::textInput('amount', '', ['id' => 'amountAC', 'type' => 'number', 'max' => floor($max_ac),'style' => 'width:150px;'])?>
                <?= Html::submitButton('Вывести АВ',
                    ['data' => ['confirm' => 'Вы уверены?'],
                        'style' => 'background-color: #09F;  padding: 4px 10px; font-size: 12px;',
                        'name' => 'submitbutton',
                        'class' => 'btn',
                    ]
                )?>
                <?php
                echo Html::endForm();
            }
            ?>
        </div>
    </div>


<!--    <div style="text-align:left">-->
<!--        <h3>МОИ НАЧИСЛЕНИЯ: --><?//=$earnings?><!--</h3>-->
<!--        <h3><b>i-BANK: --><?//=$ibank?><!--</b></h3>-->
    <!--    <h3><b>Гранты: --><?//=$earnings * 0.03?><!--</b></h3>-->
<!--        <h3><b>БАЛАНС: --><?//=$balans?><!--</b></h3>-->
<!--        <h3><b>МОИ ДОХОДЫ: --><?//=$income?><!--</b></h3>-->
<!--    </div>-->


<!--    <h3>-->
<!--        --><?php
//        $earnings = Earnings::get_user_earnings(Yii::$app->user->identity->id);
//        $withdrawals = Withdrawals::get_user_withdrawals(Yii::$app->user->identity->id);
//
//        $balans = $earnings - $withdrawals;
//        ?>
<!--        <b>Баланс: --><?//=$balans?><!--</b>-->
<!--        (Вознаграждения: --><?//=$earnings?><!-- / Комиссия всего: --><?//=$withdrawals?><!--)-->
<!--    </h3>-->

    <div style="clear:both">
        <br><br>
    </div>

<!--    <div>-->
<!--        --><?php
//            if($balans > 50) {
//                echo Html::beginForm(['withdrawals/create'], 'post', ['enctype' => 'multipart/form-data']);
//                    echo Html::hiddenInput('max_amount', $balans);
//                    echo Html::hiddenInput('user_id', Yii::$app->user->identity->id, ['style' => 'width:50px;']);
//        ?><!-- -->
<!--                -->
<!--                <div class="col-md-4">-->
<!--                    Введите сумму для вывода:  -->
<!--                </div> -->
<!--                <div class="col-md-4">-->
<!--                    --><?//= Html::textInput('amount', '', ['type' => 'number', 'max' => floor($balans),'style' => 'width:150px;'])?>
<!--                </div>  -->
<!--                <div class="col-md-4"> -->
<!--                    --><?//= Html::submitButton('Вывести',
//                                            ['data' => ['confirm' => 'Вы уверены?'],
//                                            'style' => 'background-color: #09F;  padding: 4px 10px; font-size: 12px;',
//                                            'name' => 'submitbutton',
//                                            'class' => 'btn',
//                                            ]
//                                        )?><!--	-->
<!--                </div> -->
<!--        --><?php
//                echo Html::endForm();
//            }
//        ?>
<!--    </div>-->
    
    <div style="clear:both">
        <br><br>
    </div> 
    

</div>

</div>

<?php

// $amount = ceil( 60 * Payments::getKztusdrate() );
$amount = ceil( 68 * Payments::getKztusdrate() );//kbb 04.05.22
Modal::begin([
    'id' =>'kaspi_qr',
    'header' => '<h2 align="center">Оплатите '.number_format($amount, 0, '', ' ').' тенге</h2>',
]);


echo '
    <img  align="center" style="margin: 0 auto; display: block;" src="../images/kaspi_qr.jpeg">
    <h2 align="center"><a href="https://pay.kaspi.kz/pay/5yi314fd"><u>Ссылка на оплату</u></a></h2>
';

Modal::end();

Modal::begin([
    'id' =>'rekvizity',
    'header' => '<h2 align="center">Оплата по реквизитам</h2>',
]);


echo '
    <h3>РЕКВИЗИТЫ счета ТОО "MARKHAR" (МАРХАР)</h3>
    <p><b>Банк получатель:</b> АО «Kaspi Bank»<br>
    <b>БИК:</b> CASPKZKA<br>
    <b>БИН/ИИН:</b> 171040022016<br>
    <b>Номер счета USD:</b> KZ56722S000009215095<br>
    <b>Адрес:</b> Алматы, Микрорайон 1, дом 68, кв/офис 22<br>
    <b>КБе:</b> 17<br>
    </p>
';

Modal::end();

?>

<?php
$max_w = floor($max_w);
$max_ac = floor($max_ac);
$js = <<< JS
// $('input[type="number"]').on('input', function() {
//kbb 02.03.22 3:07
$('#amount').on('input', function() {
        var obj = $(this),
        max = $max_w,
        min = 0;

        if (obj.val() >= max)
            obj.val(max);
        else if (obj.val() <= min)
            obj.val(min);

    });
$('#amountAC').on('input', function() {
        var obj = $(this),
        max = $max_ac,
        min = 0;

        if (obj.val() >= max)
            obj.val(max);
        else if (obj.val() <= min)
            obj.val(min);

    });
JS;

$this->registerJs( $js, $position = yii\web\View::POS_READY, $key = null );
?>
