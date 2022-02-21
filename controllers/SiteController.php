<?php

namespace app\controllers;

use Yii;
// use yii\filters\AccessControl;
use yii\web\Controller;
// use yii\web\Response;
// use yii\widgets\ActiveForm;
// use app\models\LoginForm;

class SiteController extends Controller
{
    public $layout = 'landing';
   
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/tasks');
        }

        return $this->render('index');
    }

    
}
