<?php

namespace app\models;

use app\models\Dish;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * DishSearch represents the model behind the search form of `app\models\Dish`.
 */
class DishSearch extends Dish
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'active'], 'integer'],
            [['name'], 'safe'],
            [['ingredientIds'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Dish::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

    public function searchFront($params)
    {

		$subCountIngredientsQuery = Ingredient::find()
			->select(['count(id) as countQueryIngredients']);

		$subQuery = Dish::find()
            ->select(['dish.id', 'dish.name', 'count(i.id) as countIngredients'])
            ->joinWith('ingredients i')
            ->groupBy(['dish.id', 'dish.name']);

        $query = Dish::find()
			->select(
			    [
                    'd2.id',
                    'd2.name',
                    'd2.countIngredients',
                    'e2.countQueryIngredients',
					'count(i2.id) as countFind'
                ]
            )
            ->from(['d2' => $subQuery])
			->joinWith('ingredients i2')
            ->leftJoin(['e2' => $subCountIngredientsQuery], '1=1')
            ->where(['>=','d2.countIngredients', 2])
			->groupBy(
			    [
			        'd2.id',
                    'd2.name',
                    'd2.countIngredients',
                    'e2.countQueryIngredients'
                ]
            )
            ->orderBy(['countFind' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        $subCountIngredientsQuery->andFilterWhere([
			'id' => $this->ingredientIds
		]);

        $subQuery->andFilterWhere([
            'id' => $this->id,
            'dish.active' => 1,
        ]);

        $subQuery->andFilterWhere([
            'like', 'name', $this->name
        ]);

		$query->andFilterWhere([
			'i2.id' => $this->ingredientIds
		]);
        return $dataProvider;
    }
}
