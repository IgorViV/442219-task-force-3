<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property array $categories
 * @property boolean $no_address
 * @property boolean $without_performer
 * @property string $period
 *
 */
class FilterForm extends \yii\db\ActiveRecord
{
    public $categories;
    public $no_address;
    public $without_performer; 
    public $period;
    
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['name', 'lat', 'long'], 'required'],
            // [['name', 'lat', 'long'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'no_adress' => 'Удаленная работа',
            'without_performer' => 'Без откликов',
        ];
    }
}
