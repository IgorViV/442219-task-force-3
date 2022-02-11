<?php

namespace app\models;

use Yii;
use app\models\FilterForm;
use yii\db\Expression;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $created_at
 * @property string $title
 * @property string $description
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int|null $finance
 * @property string|null $dedline
 * @property int $author_id
 * @property int $category_id
 * @property int $city_id
 * @property int $status_id
 * @property int|null $performer_id
 * @property string|null $address
 *
 * @property Users $author
 * @property Categories $category
 * @property Cities $city
 * @property Feedbacks[] $feedbacks
 * @property Files[] $files
 * @property Profiles $performer
 * @property Responses[] $responses
 * @property Statuses $status
 */
class Task extends \yii\db\ActiveRecord
{
    const MAX_PAGES = 5;

    public function filterTasks($params = null) {
        $query = self::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => self::MAX_PAGES,    
            ],
        ]);

        $query->joinWith('category')
            ->where(['status_id' => '1']);

        $filter = new FilterForm();
        $filter->load($params);

        if ($params) {
            if (array_sum($filter->categories)) {
                $query->where(['category_id' => $filter->categories]);
            }

            settype($filter->period, 'integer');
            
            if ($filter->period > 0) {
                $expression = new Expression("DATE_SUB(NOW(), INTERVAL {$filter->period} HOUR)");
                $query->andWhere(['>', 'created_at', $expression]);
            }

            if ($filter->no_address) {
                print('HI NO_ADDRESS');
                $query->andWhere(['address' => NULL]);
            }

            if ($filter->without_response) {
                print('HI NO_RESPONSE');
                $query->andWhere(['performer_id' => NULL]);
            }
        }

        $query->orderBy('created_at DESC')
            ->all();
 
        return $dataProvider;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'title', 'description', 'author_id', 'category_id', 'city_id', 'status_id'], 'required'],
            [['created_at', 'dedline'], 'safe'],
            [['description', 'address'], 'string'],
            [['finance', 'author_id', 'category_id', 'city_id', 'status_id', 'performer_id'], 'integer'],
            [['title', 'latitude', 'longitude'], 'string', 'max' => 128],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['performer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['performer_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
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
            'title' => 'Title',
            'description' => 'Description',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'finance' => 'Finance',
            'dedline' => 'Dedline',
            'author_id' => 'Author ID',
            'category_id' => 'Category ID',
            'city_id' => 'City ID',
            'status_id' => 'Status ID',
            'performer_id' => 'Performer ID',
            'address' => 'Address',
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
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Feedbacks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['task_id' => 'id']);
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

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }
}
