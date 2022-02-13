<?php

namespace app\models;

use yii\base\Model;
use app\models\User;

/**
 * This is the model class for registration form.
 *
 * @property string $user_name
 * @property string $email
 * @property string $user_password
 * @property int|null $is_performer
 * @property int $cities_id
 *
 */
class SignupForm extends Model
{
    public $user_name;
    public $email;
    public $user_password;
    public $repeat_user_password;
    public $cities_id;
    public $is_performer;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_name', 'email', 'user_password', 'repeat_user_password', 'cities_id'], 'required'],
            [['is_performer', 'cities_id'], 'integer'],
            [['user_name', 'email', 'user_password', 'repeat_user_password'], 'string', 'max' => 128],
            [['repeat_user_password'], 'compare', 'compareAttribute'=>'user_password'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\User'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_name' => 'Ваше имя',
            'email' => 'Email',
            'user_password' => 'Пароль',
            'repeat_user_password' => 'Повтор пароля',
            'is_performer' => 'собираюсь откликаться на заказы',
            'cities_id' => 'Город',
        ];
    }

    /**
     * 
     */
    public function signup()
    {
        $user = new User();
        $user->user_name = $this->user_name;
        $user->email = $this->email;
        $user->setPassword($this->user_password);
        $user->is_performer = $this->is_performer;
        $user->cities_id = $this->cities_id;
        return $user->save();
    }
}
