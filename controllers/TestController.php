<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;
use app\models\City;

class TestController extends Controller
{
    /**
     * Displays test page.
     *
     * @return string
     */
    public function actionTest()
    {
        $firstCategory = Category::findOne(1);

        if ($firstCategory) {
            $category = $firstCategory->name;
        }

        $myCity = City::findOne(['name' => 'Пушкино']);

        if ($myCity) {
            $city = $myCity->name;
        }

        return $this->render('test', ['category' => $category, 'city' => $city]);
    }

}
