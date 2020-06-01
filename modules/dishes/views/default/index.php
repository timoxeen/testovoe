<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DishSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поиск блюд';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dish-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if (!empty($message)) : echo Html::encode($message) ?>
    <?php else: ?>
    <table class="table table-striped">
        <tr>
            <th>Блюдо</th>
            <th>Ингредиенты</th>
        </tr>
    <?php foreach ($dishes as $modelDish) : ?>
        <tr>
            <td>
                <?php echo $modelDish['name'];?>
            </td>
            <td>
                <?php echo $modelDish['ingredients'];?>
            </td>
            <td>
                <?php echo $modelDish['count'];?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
    <?php endif;?>
</div>
