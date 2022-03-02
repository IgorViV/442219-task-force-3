<?php

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */ // TODO Modify

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

<section class="modal enter-form form-modal" id="enter-form">
    <h2>Вход на сайт</h2>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'action' => 'user/login',
        'enableAjaxValidation' => true,
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'form-modal-description'],
            'inputOptions' => ['class' => 'enter-form-email input input-middle'],
            'errorOptions' => ['class' => 'invalid-feedback'],
        ],
    ]); ?>
    <?= $form->field($model, 'email')->textInput(); ?>
    <?= $form->field($model, 'password')->passwordInput(); ?>
    <?= Html::submitButton('Войти', ['class' => 'button']) ?>
    <?php ActiveForm::end(); ?>
    <button class="form-modal-close" type="button">Закрыть</button>
</section> 

<div class="regular-form pop-up pop-up--respond pop-up--close">
   <?php $form = ActiveForm::begin([
      'id' => 'response',
      'options' => ['autocomplete' => 'of'],
      ]) ?>
   <div class="half-wrapper">
      <div class="form-group">
         <?= $form->field($model, 'prise')->input('number')->label('Цена', ['class' => 'control-label']); ?>
      </div>
   </div>
   <div class="form-group">
      <?= $form->field($model, 'coment')->textarea()->label('Ваш коментарий', ['class' => 'control-label']); ?>  
   </div>
   <?= Html::submitButton('Откликнуться', ['class' => 'button button--blue']) ?>
   <?php ActiveForm::end() ?>
</div>
<div class="regular-form pop-up pop-up--done pop-up--close">
   <?php $form = ActiveForm::begin([
      'id' => 'done',
      'options' => ['autocomplete' => 'of'],
      ]) ?>
   <div class="half-wrapper">
      <div class="form-group">
         <?= $form->field($done, 'rating')->input('number')->label('Оценка', ['class' => 'control-label']); ?>
      </div>
   </div>
   <div class="form-group">
      <?= $form->field($done, 'coment')->textarea()->label('Оставьте отзыв', ['class' => 'control-label']); ?>  
   </div>
   <?= Html::submitButton('Задание завершено', ['class' => 'button button--blue']) ?>
   <?php ActiveForm::end() ?>
</div>
<div class="regular-form pop-up pop-up--refused pop-up--close">
   <h2>Вы действительно хотите отказаться от задания?</h2>
   <a href="<?= Url::to(['tasks/view/' . $task->id ]); ?>" class="button button--blue">Я передумал, продолжаю</a>
   <a href="<?= Url::to(['tasks/refused', 'id' => $task->id ]); ?>" class="button button--blue">Отказаться от задания</a>
</div>