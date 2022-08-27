<?php

use yii\helpers\Html;

use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\User;
use common\models\Payments;

use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SurveySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =  'История платежей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="">

    <h1 class="text-center "><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
		

		
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
				'attribute' => 'type',
                'value' => function($data)
                            {
                               return $data->gettype($data->type);
                            },
            ],
			
            //'description',
            'amount',
            ['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y H:i:s']],
            //'updated_at',
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
									//return '<a href="'.Payments::create_robokassa_link($data->id).'">Оплатить</a>';//Html::a('Оплатить', [ 'payments/pay', 'payment_id' => $data->id ]);
                                    return "<a href='#' onclick='$(\"#kaspi_qr\").modal(\"show\");'>Kaspi QR</a><br>
                                    <a href='#' onclick='$(\"#rekvizity\").modal(\"show\");'>По реквизитам</a>";
								else
									return '-';
                            },
				'format' => 'raw',
            ],


				
			
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<?php

// $amount = ceil( 60 * Payments::getKztusdrate() );
$amount = ceil( 68 * Payments::getKztusdrate() );//kbb 04.05.22
Modal::begin([
    'id' =>'kaspi_qr',
    'header' => '<h2 align="center">Оплатите '.number_format($amount, 0, '', ' ').' тенге</h2>',
]);


echo '
    <img  align="center" style="margin: 0 auto; display: block;" src="../images/kaspi_qr.jpg">
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