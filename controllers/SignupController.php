<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\SignupForm;
use app\models\City;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

class SignupController extends Controller
{
    /**
     * Displays User registration page.
     *
     * @return string
     */
    public function actionIndex()
    {
        $form = new SignupForm();

        $cities = ArrayHelper::map(City::find()->all(), 'id', 'name');

        if (Yii::$app->request->getIsPost()) {
            $form->load(Yii::$app->request->post());

            if ($form->validate() && $form->signup()) {
                return $this->goHome();
            }

        }
                       
        return $this->render('index', [
            'model' => $form,
            'cities' => $cities,
        ]);
    }
}