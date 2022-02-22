<?php

namespace app\controllers;

use Yii;
use app\models\Task;
use app\models\Category;
use app\models\Response;
use app\models\FilterForm;
use app\models\File;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;

class TasksController extends SecuredController
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

    /**
     * Displays Add new task page.
     *
     * @return string
     */
    public function actionAdd()
    {
        $newTask = new Task;

        $categories = Category::find()->all();

        if (Yii::$app->request->isPost) {
            $newTask->load(Yii::$app->request->post());
            $newTask->files = UploadedFile::getInstances($newTask, 'files');

            if ($newTask->validate()) {
                $newTask->user_id = Yii::$app->user->identity->id;
                $newTask->save();
                if (isset($newTask->files)) {
                    foreach ($newTask->files as $file) {
                        $user_file = new File;
                        $user_file->task_id = $newTask->id;
                        $user_file->file_path = 'uploads/' . $file->baseName . '.' . $file->extension;
                        $user_file->save();
                        $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
                    }
               }
               $this->redirect('/tasks/view/' . $newTask->id);
            } 
        }

        return $this->render('add', [
            'model' => $newTask,
            'categories' => $categories,
        ]);
    }

}