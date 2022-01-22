<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "statuses".
 *
 * @property int $id
 * @property string $status
 * @property string $alias
 *
 * @property Tasks[] $tasks
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'statuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'alias'], 'required'],
            [['status', 'alias'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'alias' => 'Alias',
        ];
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['status_id' => 'id']);
    }
}
