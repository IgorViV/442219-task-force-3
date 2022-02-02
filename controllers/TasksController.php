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
        $filterForm = new FilterForm();
        $query = Task::find()
            ->joinWith('category')
            ->where(['status_id' => '1'])
            ->orderBy('created_at DESC');

        $tasks = $query->all();

        foreach($tasks as $task) {
            $task->created_at = GetTimePublic::getTimePublic($task->created_at);
        }

        $categories = Category::find()->all();

        return $this->render('index', [
            'tasks' => $tasks, 
            'categories' => $categories,
            'models' => $filterForm,
        ]);
    }

    

}