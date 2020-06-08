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
    <?php if ($countQueryIngredients > 1) : ?>
    <table class="table table-striped">
        <tr>
            <th class="text-center" rowspan="2">Блюдо</th>
            <th class="text-center" rowspan="2">Ингредиенты</th>
            <th class="text-center" colspan="3">Количество ингредиентов</th>
        </tr>
        <tr>
            <th class="text-center">в блюде</th>
            <th class="text-center">в запросе</th>
            <th class="text-center">совпало</th>
        </tr>
    <?php foreach ($dishes as $modelDish) : ?>
        <tr>
            <td>
                <?php echo $modelDish['name'];?>
            </td>
            <td>
                <?php echo $modelDish['ingredients'];?>
            </td>
            <td class="text-center">
                <?php echo $modelDish['count'];?>
            </td>
            <td class="text-center">
				<?php echo $modelDish['count_query'];?>
            </td>
            <td class="text-center">
				<?php echo $modelDish['count_find'];?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
    <?php endif;?>
</div>
