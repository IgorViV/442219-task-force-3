<?php

namespace app\models;

use Yii;
/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $registered_at
 * @property string $user_name
 * @property string $email
 * @property string $user_password
 * @property string $repeat_user_password
 * @property int|null $is_performer
 * @property int $cities_id
 *
 * @property Cities $cities
 * @property Feedbacks[] $feedbacks
 * @property Profiles[] $profiles
 * @property Tasks[] $tasks
 */
class User extends \yii\db\ActiveRecord
{
    public $repeat_user_password;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_name', 'email', 'user_password', 'cities_id'], 'required'],
            [['registered_at', 'repeat_user_password'], 'safe'],
            [['is_performer', 'cities_id'], 'integer'],
            [['user_name', 'email', 'user_password'], 'string', 'max' => 128],
            [['repeat_user_password'], 'compare', 'compareAttribute'=>'user_password'],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['cities_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['cities_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'registered_at' => 'Registered At',
            'user_name' => 'Ваше имя',
            'email' => 'Email',
            'user_password' => 'Пароль',
            'repeat_user_password' => 'Повтор пароля',
            'is_performer' => 'Is Performer',
            'cities_id' => 'Город',
        ];
    }

    /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'cities_id']);
    }

    /**
     * Gets query for [[Feedbacks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['author_id' => 'id']);
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['author_id' => 'id']);
    }

    /**
     * 
     */
    public function setPassword($password)
    {
        $this->user_password = sha1($password);
    }
}
