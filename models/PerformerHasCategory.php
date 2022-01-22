<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "performers_has_categories".
 *
 * @property int $id
 * @property int $performer_id
 * @property int $category_id
 *
 * @property Categories $category
 * @property Profiles $performer
 */
class PerformerHasCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'performers_has_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['performer_id', 'category_id'], 'required'],
            [['performer_id', 'category_id'], 'integer'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['performer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['performer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'performer_id' => 'Performer ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Performer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerformer()
    {
        return $this->hasOne(Profile::className(), ['id' => 'performer_id']);
    }
}
