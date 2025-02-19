<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DishSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Блюда';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dish-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить блюдо', ['create'], ['class' => 'btn 
        btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'format' => 'raw',
                'label' => 'Ингредиенты',
                'value' => function($model)
                {
                    return $model->consist;
                },
            ],
            [
                'header' => 'Скрыт?',
                'attribute' => 'active',
                'value' => function ($model) {
                    return $model->active ? 'Не скрыто' : 'Скрыто';
                },
                'filter' => [
                    0 => 'Скрыт',
                    1 => 'Не скрыт'
                ],
                'format'=>'raw'
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
