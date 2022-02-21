<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\User;
use app\models\City;
use app\models\LoginForm;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

class UserController extends SecuredController
{    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'] 
                    ]
                ]
            ], 
        ];
    }
    
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

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        

        $loginForm = new LoginForm;

        if (Yii::$app->request->getIsPost()) {
            $loginForm->load(Yii::$app->request->post());

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;

                return ActiveForm::validate($loginForm);
            }
           
            if ($loginForm->validate()) {
                
                Yii::$app->user->login($loginForm->getUser());
                var_dump(Yii::$app->user->getIsGuest());
                // TODO Delete
                // ЗДЕСЬ ВСЕ ЧЕТКО ПОКАЗЫВАЕТ, ЧТО Я ЗАЛОГИНИЛСЯ
                // print_r(Yii::$app->user->identity->user_name);
                // print_r(Yii::$app->user->getId()); 
                // exit;

                return $this->redirect('/tasks'); // при переходе уже ГОСТЬ
            }
        }

        return $this->goHome();
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout(false);

        return $this->goHome();
    }
}