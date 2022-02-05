<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Task;
use app\models\Category;
use app\models\FilterForm;
use Taskforce\utilities\GetTimePublic;

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
        
        $query = Task::find()
            ->joinWith('category')
            ->where(['status_id' => '1']);

        if (Yii::$app->request->post()) {
            $filter->load(Yii::$app->request->post());

            if (array_sum($filter->categories)) {
                $query->where(['category_id' => $filter->categories]);
            }

        } else {
            $filter->categories = [];
        }

        $query->orderBy('created_at DESC'); 

        $tasks = $query->all();

        foreach($tasks as $task) {
            $task->created_at = GetTimePublic::getTimePublic($task->created_at);
        }

        return $this->render('index', [
            'tasks' => $tasks,
            'categories' => Category::find()->all(),
            'model' => $filter,
        ]);
    }

    

}