<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Earnings;
use common\models\Withdrawals;
use common\models\User;
use common\models\Contacts;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            [
                'attribute' => 'id',
                'contentOptions'=>['style'=>'min-width: 100px;'],
            ],
            //'email:email',
            'username',
            //kbb 01.02.22 5:24
            'fullName',
//            [
//                'header' => 'ФИО',
//                'value' => function ($model) { return $model->last_name.' '.$model->first_name.' '.$model->patr_name; },
//                'format' => 'raw',
//
//            ],
            'ref_id',
            [
                // 'header' => 'Струк-ра',//kbb 07.05.22
                'header' => 'Архитектура',
                'value' => function ($model) { return Html::a('Показать', ['show_structure', 'id' => $model->id]); },
                'format' => 'raw',

            ],
            [
                // 'header' => 'Приглашенные',//kbb 07.05.22
                'header' => 'Мои продажи',
                'value' => function ($model) { return User::get_invited_users($model->id); },
                'format' => 'raw',

            ],
            [
                // 'header' => 'Ст-ые<br> условия',//kbb 07.05.22
                'header' => 'Курсы',
                'value' => function ($model) { return $model->can_left ? 'Да' : 'Нет'; },
                'format' => 'raw',

            ],
            [
                // 'header' => 'Все<br> условия',
                'header' => 'Оплачено',
                'value' => function ($model) { return $model->can_right ? 'Да' : 'Нет'; },
                'format' => 'raw',

            ],
            [
                // 'header' => 'Все<br> условия',
                'header' => 'Вторая оплата',
                'value' => function ($model) { return Withdrawals::get_second_payments($model->id);},
                'format' => 'raw',

            ],
            [
                //'header' => 'Контакты',
                'header' => 'Мои АВ',
                // 'value' => function ($model) { return Contacts::getUser_contacts_num($model->id); },
                'value' => function ($model) { return Withdrawals::get_agent_commissions($model->id); },
                'format' => 'raw',

            ],

//			[
//                // 'header' => 'Заработал',
//                'header' => '<i style="color: #0a53be">NEW начисления</i>',
//                'value' => function ($model) { return User::calculateMyEarn($model->id); },
//                'format' => 'raw',
//
//             ],
            [
                // 'header' => 'Заработал',
                'header' => 'Мои начисления',
                // 'value' => function ($model) { return Earnings::find()->where(['user_id'=>$model->id])->andWhere(['status'=>1])->sum('amount'); },
                'value' => function ($model) { return Earnings::get_user_earnings($model->id); },
                'format' => 'raw',

            ],
			[
                // 'header' => 'Вывел',
                'header' => 'Гранты',
                // 'value' => function ($model) { return Withdrawals::find()->where(['user_id'=>$model->id])->andWhere(['status'=>1])->sum('amount'); },
                'value' => function ($model) { return Earnings::get_user_earnings($model->id) * 0.01; },
                'format' => 'raw',

             ],
             [
                'header' => 'i-Market',
                'value' => function ($model) { return Earnings::get_user_earnings($model->id) * 0.05; },
                'format' => 'raw',

            ],
            [
                'header' => 'Мои доходы',
                'value' => function ($model) { return Withdrawals::get_user_withdrawals($model->id); },
                'format' => 'raw',

            ],
            [
                'header' => 'Премии',
                'value' => function ($model) { return Withdrawals::get_user_big_bonus($model->id); },
                'format' => 'raw',

            ],
            [
                // 'header' => 'Слева',
                'header' => 'Продажи пассив',
                'value' => function ($model) { return $model->left_points; },
                'format' => 'raw',

             ],
             [
                // 'header' => 'Справа',
                'header' => 'Продажи актив',
                'value' => function ($model) { return $model->right_points; },
                'format' => 'raw',

             ],
            
            'phone',
            //'status',
            ['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y H:i:s']],
            //kbb 08.05.22 1:28
            [
                'header' => 'Дата активации',
                'attribute' => 'activated_at', 'format' => ['date', 'php:d.m.Y H:i:s']
            ],
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn',
			 	'template' => '{update}',
				'headerOptions' => ['width' => '60'],
				'header' => ' ',
			 ],
            // kbb 14.01.22 3:17
            [
                'header' => ' ',
                'value' => function ($model) { return Html::a('Удалить', ['show_structure', 'id' => $model->id]); },
                'format' => 'raw',

            ],
        ],
    ]); ?>

</div>
