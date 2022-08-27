<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\User;
use common\models\Payments;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SurveySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =  'Платежи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="survey-index">
    <div id="overlay"></div>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>
<!--
	<p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'user_id',
            [
                'attribute' => 'user_id',
                'contentOptions'=>['style'=>'min-width: 100px;'],
            ],
            'fullName',
//kbb 11.02.22 1:16
//            [
//				'attribute' => 'user_id',
//                'value' => function($data)
//                            {
//                                return User::findOne($data->user_id)->username;
//                            },
//            ],
			'amount',

            'description',
			// [
			// 		'header' => 'Earnings',
            //         'value' => function ($model) { return Html::a('Earnings', [ 'earnings/index', 'payment_id' => $model->id ]); },
            //         'format' => 'raw',

            //  ],
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
									return Html::a('Оплатить', [ 'payments/pay', 'payment_id' => $data->id ], ['id' => 'pay-link-'.$data->id, 'onclick' => 'pay('.$data->id .');']); //'<a href="'.Payments::create_robokassa_link($data->id).'">Оплатить</a>';//
								else
									return '-';
                            },
				'format' => 'raw',
            ],

        ]
    ]); ?>

    
</div>

<div class="loader">
    <div class="loader-inner">
        <div class="loading one"></div>
    </div>
    <div class="loader-inner">
        <div class="loading two"></div>
    </div>
    <div class="loader-inner">
        <div class="loading three"></div>
    </div>
    <div class="loader-inner">
        <div class="loading four"></div>
    </div>
</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">

        function pay(id) {;
            document.getElementById("overlay").style.display = "block";
            $(".loader").show();
            $("tbody").find("[data-key='" + id + "']").addClass( "selected-row" );
        };

</script>
<style>
    .selected-row{
        background-color: #99ee99 !important;
    }
    #overlay {
        position: fixed;
        display: none;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 2;
    }
    .loader{
        width: 150px;
        height: 150px;
        display: none;
        margin: 40px auto;
        transform: rotate(-45deg);
        font-size: 0;
        line-height: 0;
        animation: rotate-loader 5s infinite;
        padding: 25px;
        left: 50%;
        position: absolute;
        top: 50%;

    }
    .loader .loader-inner{
        position: relative;
        display: inline-block;
        width: 50%;
        height: 50%;
    }
    .loader .loading{
        position: absolute;
        background: #f0e682;
    }
    .loader .one{
        width: 100%;
        bottom: 0;
        height: 0;
        animation: loading-one 1s infinite;
    }
    .loader .two{
        width: 0;
        height: 100%;
        left: 0;
        animation: loading-two 1s infinite;
        animation-delay: 0.25s;
    }
    .loader .three{
        width: 0;
        height: 100%;
        right: 0;
        animation: loading-two 1s infinite;
        animation-delay: 0.75s;
    }
    .loader .four{
        width: 100%;
        top: 0;
        height: 0;
        animation: loading-one 1s infinite;
        animation-delay: 0.5s;
    }
    @keyframes loading-one {
        0% {
            height: 0;
            opacity: 1;
        }
        12.5% {
            height: 100%;
            opacity: 1;
        }
        50% {
            opacity: 1;
        }
        100% {
            height: 100%;
            opacity: 0;
        }
    }
    @keyframes loading-two {
        0% {
            width: 0;
            opacity: 1;
        }
        12.5% {
            width: 100%;
            opacity: 1;
        }
        50% {
            opacity: 1;
        }
        100% {
            width: 100%;
            opacity: 0;
        }
    }
    @keyframes rotate-loader {
        0% {
            transform: rotate(-45deg);
        }
        20% {
            transform: rotate(-45deg);
        }
        25% {
            transform: rotate(-135deg);
        }
        45% {
            transform: rotate(-135deg);
        }
        50% {
            transform: rotate(-225deg);
        }
        70% {
            transform: rotate(-225deg);
        }
        75% {
            transform: rotate(-315deg);
        }
        95% {
            transform: rotate(-315deg);
        }
        100% {
            transform: rotate(-405deg);
        }
    }
</style>