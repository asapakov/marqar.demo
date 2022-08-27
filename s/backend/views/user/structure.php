<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Earnings;
use common\models\Withdrawals;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Структура для Пользователя '.$top-> last_name.' '.$top-> first_name.' ('.$top->id.')';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="structure">
    <div style="clear:both"><br></div>
        <div class="col-md-12 btn strcture_top">
            
            <?= Html::a($top->last_name.' '.$top->first_name.' ('.$top->id.')', ['show_structure', 'id' => $top->parent_user_id]) ?>
        </div>
        <div style="clear:both"><br></div>
        <div class="col-md-6 btn strcture_left">
            <?php
                if($left) {
                    echo Html::a($left->last_name.' '.$left->first_name.' ('.$left->id.')', ['show_structure', 'id' => $left->id]);
                } else {
                    echo '-';
                }
            ?>
            
        </div>
        <div class="col-md-5 btn strcture_right">
        <?php
                if($right) {
                    echo Html::a($right->last_name.' '.$right->first_name.' ('.$right->id.')', ['show_structure', 'id' => $right->id]);
                } else {
                    echo '-';
                }
            ?>
            
        </div>
    </div>

    
</div>
