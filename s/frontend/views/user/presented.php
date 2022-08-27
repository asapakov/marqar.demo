<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Payments;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Подарочные аккаунты';
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
        'columns' => [
            'id',
            [
                'header' => 'ФИО',
                'value' => function ($model) { return $model->last_name.' '.$model->first_name.' '.$model->patr_name; },
                'format' => 'raw',

            ],
            //'phone',
            
            'email:email',
            //'status',
            ['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y']],
        ],
    ]); ?>
    


</div>
