<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\Task;
use app\models\Category;
use app\models\Response;
use app\models\FilterForm;
use yii\web\NotFoundHttpException;

class TasksController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'] // TODO Set roles
                    ]
                ]
            ]
        ];
    }

    /**
     * Displays Tasks page.
     *
     * @return string
     */
    public function actionIndex()
    {
        $filter = new FilterForm();
        $task = new Task();

        if (Yii::$app->request->post()) {
            $filter->load(Yii::$app->request->post());
        }
        
        $tasks = $task->filterTasks(Yii::$app->request->post())->getModels(); 
                
        return $this->render('index', [
            'tasks' => $tasks,
            'categories' => Category::find()->all(),
            'model' => $filter,
        ]);
    }

    /**
     * Displays Task view page.
     *
     * @return string
     */
    public function actionView($id)
    {
        $task = Task::findOne($id);
        if (!$task) {
            throw new NotFoundHttpException("Задача с ID $id не найдена");
        }

        $task->dedline = $task->dedline ? Yii::$app->formatter->asDatetime($task->dedline) : 'Срок не определен';

        $responses = Response::find()
            ->where(['task_id' => $id])
            ->all();

        return $this->render('view', [
            'task' => $task,
            'responses' => $responses,
            ]);
    }

}