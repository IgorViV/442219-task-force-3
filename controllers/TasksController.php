<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Task;
use app\models\Category;
use app\models\FilterForm;

class TasksController extends Controller
{

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
}