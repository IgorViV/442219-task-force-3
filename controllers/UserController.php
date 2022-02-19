<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\City;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

class UserController extends Controller
{    
    /**
     * Displays User profile page.
     *
     * @return string
     */
    public function actionView($id)
    {
        $user = User::findOne($id);
        if (!$user) {
            throw new NotFoundHttpException("Пользователь с ID $id не найден");
        }

        return $this->render('view', [
            'user' => $user,
        ]);
    }

    /**
     * Signup new user
     * 
     * @return string
     */
    public function actionSignup()
    {
        $user = new User();
        $cities = ArrayHelper::map(City::find()->all(), 'id', 'name');

        if (Yii::$app->request->getIsPost()) {
            $user->load(Yii::$app->request->post());

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;

                return ActiveForm::validate($user);
            }

            if ($user->validate()) {
                $user->user_password = Yii::$app->security->generatePasswordHash($user->user_password);

                $user->save(false);
                $this->redirect('/tasks');
            }
        }

        return $this->render('signup', [
            'model' => $user,
            'cities' => $cities,
        ]);
    }
}