<?php

/* @var $this yii\web\View */
/* @var $user array */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Taskforce';

?>
<div class="center-block">
    <div class="registration-form regular-form">
        <?php $form = ActiveForm::begin([
            'id' => 'registration-form',
            'enableAjaxValidation' => true,
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'control-label'],
            ],
        ]); ?>
            <h3 class="head-main head-task">Регистрация нового пользователя</h3>
            <div class="form-group"></div>
            <?= $form->field($model, 'user_name')->textInput(); ?>
            <div class="half-wrapper">
                <div class="form-group">
                    <?= $form->field($model, 'email')->textInput(); ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'cities_id')->dropDownList($cities)->label('Город'); ?>
                </div>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'user_password')->passwordInput(); ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'repeat_user_password')->passwordInput(); ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'is_performer', ['template' => "{input}\n{label}"])->checkbox(['label' => ''], false)->label('собираюсь откликаться на заказы'); ?>
            </div>
            <?= Html::submitButton('Создать аккаунт', ['class' => 'button button--blue']); ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>