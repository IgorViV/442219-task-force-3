<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Task;
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
        $query = Task::find()
            ->joinWith('category')
            ->where(['status_id' => '1'])
            ->orderBy('created_at DESC');

        $tasks = $query->all();

        foreach($tasks as $task) {
            $task['created_at'] = GetTimePublic::getTimePublic($task['created_at']);
        }

        return $this->render('index', ['tasks' => $tasks]);
    }

    

}