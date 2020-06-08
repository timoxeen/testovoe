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
        $dishes = [];
        $dishes2 = [];
        $getParams = Yii::$app->request->queryParams;
        $countQueryIngredients = empty($getParams['DishSearch']['ingredientIds'])
            ? 0
            : sizeof($getParams['DishSearch']['ingredientIds']);
        $searchModel = new DishSearch();
        if (!empty($getParams) && $countQueryIngredients < 2) {
            Yii::$app->getSession()->setFlash('alert', [
                'body' => 'Выберите больше ингредиентов',
                'options' => ['class'=>'alert-warning']
            ]);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dishes' => $dishes,
				'countQueryIngredients' => $countQueryIngredients
            ]);
        }

        $dataProvider = $searchModel->searchFront($getParams);
        foreach ($dataProvider->models as $dish) {
            if (
            	$dish->countIngredients == $dish->countQueryIngredients
				&& $dish->countFind == $dish->countIngredients
			) {
                $dishes[$dish->id]['name'] = $dish->name;
                $dishes[$dish->id]['count'] = $dish->countIngredients;
				$dishes[$dish->id]['count_query'] = $dish->countQueryIngredients;
				$dishes[$dish->id]['count_find'] = $dish->countFind;
				$dishes[$dish->id]['ingredients'] = $dish->consist;
            } elseif ($dish->countFind >= 2) {
                $dishes2[$dish->id]['name'] = $dish->name;
                $dishes2[$dish->id]['count'] = $dish->countIngredients;
				$dishes2[$dish->id]['count_query'] = $dish->countQueryIngredients;
				$dishes2[$dish->id]['count_find'] = $dish->countFind;
                $dishes2[$dish->id]['ingredients'] = $dish->consist;
            }
        }

        if (empty($dishes)) {
			(empty($dishes2))
			? Yii::$app->getSession()->setFlash('alert',
				[
					'body' => 'Ничего не найдено',
					'options' => ['class'=>'alert-danger']
				]
			)
			: $dishes = $dishes2;
		}
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dishes' => $dishes,
			'countQueryIngredients' => $countQueryIngredients
        ]);
    }


}
