<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feedbacks".
 *
 * @property int $id
 * @property string $created_at
 * @property string|null $comment
 * @property int $evaluation
 * @property int $author_id
 * @property int $task_id
 *
 * @property Users $author
 * @property Tasks $task
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedbacks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'evaluation', 'author_id', 'task_id'], 'required'],
            [['created_at'], 'safe'],
            [['comment'], 'string'],
            [['evaluation', 'author_id', 'task_id'], 'integer'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'comment' => 'Comment',
            'evaluation' => 'Evaluation',
            'author_id' => 'Author ID',
            'task_id' => 'Task ID',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
}
