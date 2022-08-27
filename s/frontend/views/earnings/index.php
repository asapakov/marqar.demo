<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SurveysitemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Вознаграждения');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="earnings-index">

    <h1 class="text-center "><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<!--
    <p>
        <?= Html::a('Withdraw Earnings', ['withdraw'], ['class' => 'btn btn-success']) ?>
    </p>
-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
           // 'user_id',
            'amount',
			// [
			// 	'attribute' => 'type',
            //     'value' => function($data)
            //                 {
            //                     switch ($data->type) {
			// 						case 1:
			// 							$type = 'Бинарный бонус';
			// 							break;


			// 					}
								
			// 					return $type;
            //                 },
            // ],
            'description',
            ['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y H:i:s']],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
