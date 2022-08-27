<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use common\models\User;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\VariantsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки на выплаты';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="withdrawals-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        
        <?= Html::a('Отправленные', ['index', 'status' => 1], ['class' => 'btn btn-status']) ?>
        <?= Html::a('На рассмотрении', ['index', 'status' => 0], ['class' => 'btn btn-status']) ?>
        <?= Html::a('Все', ['index'], ['class' => 'btn btn-status']) ?>
        <br>
    </p>

	<?php 
    	$searchModel->attributes = Yii::$app->request->get('question_id');
		$dataProvider = $searchModel->search(Yii::$app->request->get('question_id')); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'user_id',
            [
                'attribute' => 'user_id',
                'contentOptions'=>['style'=>'min-width: 100px;'],
            ],

			[
				'attribute' => 'fullname',
                'value' => function($data)
                            {
                                return User::findOne($data->user_id)->getFullName();
                            },
            ],
            'amount',
            'description',
            ['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y H:i:s']],
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

            ['class' => 'yii\grid\ActionColumn',
					'template' => '{confirm}&nbsp;&nbsp;&nbsp;{decline}',
					'buttons' => [
						'confirm' => function($url, $model, $key) {     // render your custom button
							return Html::a('<span class="glyphicon glyphicon-ok"></span>', ['confirm', 'withdrawal' => $model->id ],['onClick' => 'return confirm("Подтведить вывод?")']);
						},
						'decline' => function($url, $model, $key) {     // render your custom button
							return Html::a('<span class="glyphicon glyphicon-remove"></span>', ['decline', 'withdrawal' => $model->id ],['onClick' => 'return confirm("Отклонить вывод?")']);
						}
					]
				]
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
