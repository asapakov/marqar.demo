<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
use common\models\User;

$this->title =  'Дивиденды';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surveys-index">
    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php Pjax::begin(); ?>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
			[
				'attribute' => 'user_id',
                'value' => function($data)
                            {
                                return User::findOne($data->user_id)->username;
                            },
            ],
            [
				'attribute' => 'type',
                'value' => function($data)
                            {

								
								return '-';
                            },
            ],
            'amount',

            'description',
            'created_at:datetime',
           // 'status',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
	
	?>
    <?php Pjax::end(); ?>

</div>

