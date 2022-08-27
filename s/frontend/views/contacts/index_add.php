<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\Contacts;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Дополнительные контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p style="float:left">
        <?= Html::a('Добавить контакт', ['create?type='.Contacts::getUser_current_contacts_type(Yii::$app->user->identity->id)], ['class' => 'btn btn-success']) ?>
        
    </p>
    <p style="float:right">
        
        <?= Html::a('1 - 20', ['index_add', 'type' => 2], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('21 - 30', ['index_add', 'type' => 3], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('31 - 40', ['index_add', 'type' => 4], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('41 - 50', ['index_add', 'type' => 5], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'phone',
            'fullname',
            //'type',
            ['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y H:i:s']],

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
