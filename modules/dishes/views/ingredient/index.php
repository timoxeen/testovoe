<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IngredientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ingredients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ingredient', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'header' => 'Active',
                'attribute' => 'active',
                'value' => function ($model, $key, $index, $widget) {
                    return $model->active ? 'Не скрыт' : 'Скрыт';
                },
                'filter' => [
                    0 => 'Скрыт',
                    1 => 'Не скрыт'
                ],
                'format'=>'raw'
            ],
            ['class' => 'yii\grid\ActionColumn'],
            [
                'value' => function ($model, $key, $index, $widget) {
                    return $model->active
                        ? Html::a(
                            'Скрыть',
                            [
                                'ingredient/disable/',
                                'id' => $model->id
                            ],
                            [
                                'class' => 'btn btn-danger'
                            ]
                        )
                        : Html::a(
                                'Отобразить',
                            [
                                'ingredient/disable/',
                                'id' => $model->id
                            ],
                            [
                                'class' => 'btn btn-success'
                            ]
                        );
                },
                'format'=>'raw'
            ]
        ],
    ]); ?>
</div>
