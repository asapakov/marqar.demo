<?php

use yii\helpers\Html;

use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\User;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SurveySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Анкетирования');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="survey-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Создать'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
		

		
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'category_id',
			'title',
            /*'title' => [
					'attribute' => 'title',
                    'value' => function ($model) { return Html::a($model->title, [ 'surveys/index', 'id' => $model->id ]); },
                    'format' => 'raw',

                ],*/
            //'description',
            //'time:datetime',
            //'user_id',
			[
				'attribute' => 'user_id',
                'value' => function($data)
                            {
                                return User::findOne($data->user_id)->username;
                            },
            ],
			[
					'header' => 'Вопросы',
                    'value' => function ($model) { return Html::a('Смотреть', [ 'questions/index', 'survey_id' => $model->id ]); },
                    'format' => 'raw',

                ],
			'sound_on',
            'sound_off',
			[
					'header' => 'Скачать SPS',
                    'value' => function ($model) { return Html::a('SPS файл', [ 'survey/download', 'survey_id' => $model->id ]); },
                    'format' => 'raw',
             ],
			[
					'header' => 'Скачать данные',
                    'value' => function ($model) { return Html::a('DAT файл', [ 'survey/datdownload', 'survey_id' => $model->id ]); },
                    'format' => 'raw',
             ],
            //'created_at',
            //'updated_at',
            //'status',

            ['class' => 'yii\grid\ActionColumn',
			 	'template' => '{update}&nbsp;&nbsp;&nbsp;{delete}'
			 ],
				
			
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
