<?php

namespace app\modules\dishes\controllers;

use app\models\Dish;
use app\models\DishSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `dishes` module
 */
class DefaultController extends Controller
{
    /**
     * Lists all Dish models.
     * @return mixed
     */
    public function actionIndex()
    {
        $message = '';
        $dishes = [];
        $dishes2 = [];
        $getParams = Yii::$app->request->queryParams;
        $countQueryIngredients = empty($getParams['DishSearch']['ingredientIds'])
            ? 0
            : sizeof($getParams['DishSearch']['ingredientIds']);

        $searchModel = new DishSearch();
        $dataProvider = $searchModel->searchFront($getParams);
//        var_dump($searchModel->ingredientIds);
//        var_dump($dataProvider); die();
        if ($countQueryIngredients < 2) {
            $message = 'Выберите больше ингредиентов';
        }
        foreach ($dataProvider->models as $dish) {
            if ($dish->countIngredients == $countQueryIngredients) {
                $dishes[$dish->id]['name'] = $dish->name;
                $dishes[$dish->id]['count'] = $dish->countIngredients;
                $dishes[$dish->id]['ingredients'] = $dish->consist;
            }
            if ($dish->countIngredients < $countQueryIngredients) {
                $dishes[$dish->id]['name'] = $dish->name;
                $dishes[$dish->id]['count'] = $dish->countIngredients;
                $dishes[$dish->id]['ingredients'] = $dish->consist;
            }

        }
        //var_dump($dishes); die();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dishes' => $dishes,
            'message' => $message
        ]);
    }


}
