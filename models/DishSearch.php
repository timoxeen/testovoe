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

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
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
        $subQuery = Dish::find()
            ->select(['dish.id', 'dish.name', 'count(dish.id) as countIngredients'])
            ->joinWith('ingredients')
            ->groupBy(['dish.id', 'dish.name']);

        $query = Dish::find()
            ->from(['u' => $subQuery])
            ->where(['>=','countIngredients', 2])
            ->orderBy(['countIngredients' => SORT_DESC]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $subQuery->andFilterWhere([
            'id' => $this->id,
            'dish.active' => 1,
        ]);
        $subQuery->andFilterWhere([
            'ingredient.id' => $this->ingredientIds
        ]);

        $subQuery->andFilterWhere([
            'like', 'name', $this->name
        ]);
//        if (!empty($this->ingredientIds)) {
//            $query->andFilterWhere([
//                'countIngredients' => sizeof($this->ingredientIds)
//            ]);
//        }
//        var_dump($query); die();
        return $dataProvider;
    }
}
