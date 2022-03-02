<?php

/* @var $this yii\web\View */
/* @var $task array */
/* @var $responses array */ 

use yii\helpers\Html;

$this->title = 'Taskforce';

?>
<div class="left-column">
    <div class="head-wrapper">
        <h3 class="head-main"><?= $task->title; ?></h3>
        <p class="price price--big"><?= Html::encode($task->finance) ?> ₽</p>
    </div>
    <p class="task-description">
    <?= Html::encode($task->description) ?>
    </p>
    <!--  -->
    <!-- Клик по кнопке «Откликнуться» вызывает показ модального окна с формой отклика. 
    Здесь пользователь вводит стоимость работы и сопровождает отклик своим комментарием. 
    После отправки формы новый отклик появляется на странице. 
    Исполнитель может оставить только один отклик к заданию. -->
    <a href="#" class="button button--blue">Откликнуться на задание</a>
    <!--  -->
    <!-- Клик по кнопке «Завершить» показывает модальное окно завершения задания. 
    Кнопка доступна только заказчику этого задания. 
    В форме этого окна заказчик должен указать отзыв и поставить оценку. 
    После сохранения формы задание переходит в статус «Завершено». -->
    <div class="task-map">
        <img class="map" src="img/map.png"  width="725" height="346" alt="<?= Html::encode($task->address) ?>">
        <p class="map-address town">Москва</p>
        <p class="map-address">Новый арбат, 23, к. 1</p>
    </div>
    <?php if($responses): ?> <!-- TODO все отклики видит только автор задания или собственный отклик - автор этого отклика -->
    <h4 class="head-regular">Отклики на задание</h4>
        <?php foreach($responses as $response): ?>
        <div class="response-card">
            <img class="customer-photo" src="/img/man-glasses.png" width="146" height="156" alt="Фото заказчика">
            <div class="feedback-wrapper">
                <a href="#" class="link link--block link--big">Астахов Павел</a>
                <div class="response-wrapper">
                    <div class="stars-rating small"><span class="fill-star">&nbsp;</span><span class="fill-star">&nbsp;</span><span class="fill-star">&nbsp;</span><span class="fill-star">&nbsp;</span><span>&nbsp;</span></div>
                    <p class="reviews">2 отзыва</p>
                </div>
                <p class="response-message">
                    <?= Html::encode($response->text_content); ?>
                </p>
            </div>
            <div class="feedback-wrapper">
                <p class="info-text"><span class="current-time"><?= Yii::$app->formatter->asRelativeTime($response->created_at); ?></p>
                <p class="price price--small"><?= Html::encode($response->price); ?> ₽</p>
            </div>
            <!-- TODO Показывать только автору этого задания - заказчику -->
            <div class="button-popup"> 
                <!--  -->
                <!-- Действие «Подтвердить» устанавливает пользователя в исполнители этого задания, 
                а также меняет статус самого задания на «В работе». 
                Если задание находится в статусе «В работе», 
                то у всех откликов кнопки действий показывать уже не надо. -->
                <a href="#" class="button button--blue button--small">Принять</a>
                <!--  -->
                <!-- Действие «Отказать» должно скрывать кнопки-действия с этого отклика — 
                после обновления статуса отклика на «отказано», 
                внутри этого отклика больше не появляются кнопки. -->
                <a href="#" class="button button--orange button--small">Отказать</a>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<div class="right-column">
    <div class="right-card black info-card">
        <h4 class="head-card">Информация о задании</h4>
        <dl class="black-list">
            <dt>Категория</dt>
            <dd><?= Html::encode($task->category->name) ?></dd>
            <dt>Дата публикации</dt>
            <dd><?= Yii::$app->formatter->asRelativeTime($task->created_at); ?></dd>
            <dt>Срок выполнения</dt>
            <!-- <dd>15 октября, 13:00</dd> -->
            <dd><?= Html::encode($task->dedline); ?></dd>
            <dt>Статус</dt>
            <!-- <dd>Открыт для новых заказов</dd> -->
            <dd><?= Html::encode($task->status->alias) ?></dd>
        </dl>
    </div>
    <div class="right-card white file-card">
        <h4 class="head-card">Файлы задания</h4>
        <ul class="enumeration-list">
            <li class="enumeration-item">
                <a href="#" class="link link--block link--clip">my_picture.jpg</a>
                <p class="file-size">356 Кб</p>
            </li>
            <li class="enumeration-item">
                <a href="#" class="link link--block link--clip">information.docx</a>
                <p class="file-size">12 Кб</p>
            </li>
        </ul>
    </div>
</div>