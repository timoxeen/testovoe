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
        if ($countQueryIngredients < 2) {
            Yii::$app->getSession()->setFlash('alert', [
                'body' => 'Выберите больше ингредиентов',
                'options' => ['class'=>'alert-danger']
            ]);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dishes' => $dishes,
                'message' => $message
            ]);
        }


        $dataProvider = $searchModel->searchFront($getParams);
        foreach ($dataProvider->models as $dish) {
            if ($dish->differenceIngredients == 0) {
                $dishes[$dish->id]['name'] = $dish->name;
                $dishes[$dish->id]['count'] = $dish->countIngredients;
                $dishes[$dish->id]['ingredients'] = $dish->consist;
            } else {
                $dishes2[$dish->id]['name'] = $dish->name;
                $dishes2[$dish->id]['count'] = $dish->countIngredients;
                $dishes2[$dish->id]['ingredients'] = $dish->consist;
            }
        }

        if (empty($dishes)) {
        	$dishes = $dishes2;
		}
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dishes' => $dishes,
            'message' => $message
        ]);
    }


}
