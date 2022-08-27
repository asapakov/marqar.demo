<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */

/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Заявки на вывод');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surveys-index">

    <h1 class="text-center "><?= Html::encode($this->title) ?></h1>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>
        <?= Html::a('Withdraw', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'user_id',
            'amount',
            'description',
            //'updated_at',
            [
				'attribute' => 'status',
                'value' => function($data)
                            {
                                switch ($data->status) {
									case 0:
										$status = 'На рассмотрении';
										break;
									case 1:
										$status = 'Выплачено';
										break;
									case 10:
										$status = 'Отмена';
										break;

								}
								
								return $status;
                            },
            ],
            ['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y H:i:s']],
        ],
    ]); ?>
    
</div>
