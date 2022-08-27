<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Payments;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//kbb 15.02.22 19:16
//$this->title = 'Приглашенные участники';
$this->title = 'Мои продажи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
             	
    <div style="clear:both"></div>                	
                        
    <hr>
    <h2 style="text-align:center"><?= Html::encode($this->title) ?></h2>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'layout' => '{items}{pager}',
        //'filterModel' => $searchModel,
        // kbb 16.01.22 1:39
        'columns' => [
            //'id',
            [
                'header' => 'ФИО',
//                'value' => function ($model) { return $model->last_name.' '.$model->first_name.' '.$model->patr_name; },
                'value' => function ($model) { return $model->last_name.' '.$model->first_name.' '.$model->patr_name.' / АН ('.$model->id.')'; },
                'format' => 'raw',

            ],
            'phone',
            [
                'header' => 'Активен?',
                'value' => function ($model) { return $model->can_left ? 'Да' : 'Нет'; },
                'format' => 'raw',

            ],
            //'email:email',
            //'status',
            ['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y']],
        ],
    ]); ?>
    


</div>
