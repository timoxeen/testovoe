<?php

namespace app\models;

use Yii;
use yii2tech\ar\linkmany\LinkManyBehavior;

/**
 * This is the model class for table "dish".
 *
 * @property int $id
 * @property string $name
 * @property int $active
 *
 * @property IngredientDish[] $ingredientDishes
 * @property Ingredient[] $ingredients
 */
class Dish extends \yii\db\ActiveRecord
{
    public $countIngredients;
    public $countQueryIngredients;
    public $countFind;

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'linkGroupBehavior' => [
                'class' => LinkManyBehavior::className(),
                'relation' => 'ingredients',
                'relationReferenceAttribute' => 'ingredientIds'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dish';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['ingredientIds'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование блюда',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredientDishes()
    {
        return $this->hasMany(IngredientDish::className(), ['dish_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasMany(Ingredient::className(), ['id' => 'ingredient_id'])
            ->viaTable('ingredient_dish', ['dish_id' => 'id']);
    }

    public function getConsist()
    {
        $consist = [];
        $ingredients = $this->ingredients;
        foreach ($ingredients as $ingredient) {
            $consist[] = $ingredient->name;
        }
        return implode(', ', $consist);
    }

}
