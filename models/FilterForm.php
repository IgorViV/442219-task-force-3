<?php

namespace app\models;

use Yii;
use app\models\Category;
use yii\base\Model;

/**
 * This is the model class for table "cities".
 *
 * @property array $categories
 * @property boolean $no_address
 * @property boolean $without_performer
 * @property string $period
 *
 */
class FilterForm extends Model
{
    public $categories;
    public $no_address;
    public $without_performer; 
    public $period;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categories', 'no_address', 'without_performer', 'period'], 'safe'],
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
