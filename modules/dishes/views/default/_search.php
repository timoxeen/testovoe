<?php

use app\models\Ingredient;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DishSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dish-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ingredientIds')
        ->checkboxList(
            ArrayHelper::map(Ingredient::find()->where(['active'=>1])->all(),
                'id', 'name'),
            [
                'multiple' => true,
                'class' => 'h4'
            ]
        )->label('Ингредиенты') ?>

    <div class="form-group">
        <?= Html::submitButton('Найти', [ 'class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
