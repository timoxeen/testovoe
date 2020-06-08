<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ingredient */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ингредиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ingredient-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(
                'Редактировать',
                ['update', 'id' => $model->id],
                ['class' => 'btn btn-primary']
        ) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы серьезно хотите это удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name'
        ],
    ]) ?>

</div>
