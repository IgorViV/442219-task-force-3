<?php

/* @var $this yii\web\View */
/* @var $tasks array */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Новое задание';

?>
<div class="add-task-form regular-form">
    <?php $form = ActiveForm::begin([
            'id' => 'add-task-form',
            // 'enableAjaxValidation' => true,
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'control-label'],
            ],
        ]); ?>
        <h3 class="head-main head-main">Публикация нового задания</h3>
            <div class="form-group">
                <?= $form->field($model, 'title')->textInput(); ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'description')->textarea(); ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($categories, 'id', 'name'))->label('Категория'); ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'address')->textInput(); ?>
            </div>
            <div class="half-wrapper">
                <div class="form-group">
                    <?= $form->field($model, 'finance')->textInput(['type' => 'number']); ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'dedline')->textInput(['type' => 'date']); ?>
                </div>
            </div>
            <?= $form->field($model, 'files[]')->fileInput(['multiple' => true, 'class' => "new-file"])->label('Файлы'); ?>
        <?= Html::submitButton('Опубликовать', ['class' => 'button button--blue']); ?>
    <?php ActiveForm::end(); ?>
</div>