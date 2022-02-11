<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "cities".
 *
 * @property array $categories
 * @property boolean $no_address
 * @property boolean $without_response
 * @property string $period
 *
 */
class FilterForm extends Model
{
    const PERIOD_VALUES = [
        '0' => 'Без ограничений',
        '1' => '1 час',
        '12'  => '12 часов',
        '24' => '24 часа'
    ];
    
    public $categories = [];
    public $no_address = '0';
    public $without_response = '0'; 
    public $period;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categories', 'no_address', 'without_response', 'period'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'no_adress' => 'Удаленная работа',
            'without_response' => 'Без откликов',
        ];
    }
}