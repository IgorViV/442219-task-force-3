<?php

/* @var $this yii\web\View */
/* @var $tasks array */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;

$this->title = 'Taskforce';

?>
<div class="left-column">
    <h3 class="head-main head-task">Новые задания</h3>
    <?php foreach($tasks as $task): ?>
    <div class="task-card">
        <div class="header-task">
            <a  href="#" class="link link--block link--big"><?= Html::encode($task->title) ?></a>
            <p class="price price--task"><?= Html::encode($task->finance) ?> ₽</p>
        </div>
        <p class="info-text"><span class="current-time"><?= Html::encode($task->created_at) ?></span></p>
        <p class="task-text"><?= Html::encode($task->description) ?>
        </p>
        <div class="footer-task">
            <p class="info-text town-text"><?= Html::encode($task->address) ?></p>
            <p class="info-text category-text"><?= Html::encode($task->category->name) ?></p>
            <a href="#" class="button button--black">Смотреть Задание</a>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="pagination-wrapper">
        <ul class="pagination-list">
            <li class="pagination-item mark">
                <a href="#" class="link link--page"></a>
            </li>
            <li class="pagination-item">
                <a href="#" class="link link--page">1</a>
            </li>
            <li class="pagination-item pagination-item--active">
                <a href="#" class="link link--page">2</a>
            </li>
            <li class="pagination-item">
                <a href="#" class="link link--page">3</a>
            </li>
            <li class="pagination-item mark">
                <a href="#" class="link link--page"></a>
            </li>
        </ul>
    </div>
    </div>
    <div class="right-column">
    <div class="right-card black">
        <div class="search-form">
            <?php $form = ActiveForm::begin([
                'id' => 'filter-form',
                'fieldConfig' => [
                    'template' => "{input}",
                    'options' => ['class' => 'form-group'],
                    'labelOptions' => ['class' => 'control-label']
                ]
            ]); ?>
                <h4 class="head-card">Категории</h4>
                <div class="form-group">
                    <?php foreach($categories as $category): ?>
                    <div>
                        <input type="checkbox" id="<?= $category->icon; ?>">
                        <label class="control-label" for="<?= $category->icon; ?>">
                            <?= Html::encode($category->name); ?>
                        </label>
                    </div>                    
                    <?php endforeach; ?>
                </div>
                <h4 class="head-card">Дополнительно</h4>
                <div class="form-group">
                    <div>
                        <input id="no-address" type="checkbox">
                        <label class="control-label" for="no-address">Удаленная работа</label>
                    </div>
                    <div>
                        <input id="without-performer" type="checkbox">
                        <label class="control-label" for="without-performer">Без откликов</label>
                    </div>
                </div>
                <h4 class="head-card">Период</h4>
                <div class="form-group">
                    <label for="period-value"></label>
                    <select id="period-value">
                        <option>1 час</option>
                        <option>12 часов</option>
                        <option>24 часа</option>
                    </select>
                </div>
                <input type="button" class="button button--blue" value="Искать">
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>