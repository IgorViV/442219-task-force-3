<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<header class="page-header">
    <nav class="main-nav">
        <a href='#' class="header-logo">
            <img class="logo-image" src="/img/logotype.png" width=227 height=60 alt="taskforce">
        </a>
        <?php if(Url::current() !== '/signup'): ?>
        <div class="nav-wrapper">
            <ul class="nav-list">
                <li class="list-item list-item--active">
                    <a href="<?= Url::to('add'); ?>" class="link link--nav">Новое</a>
                </li>
                <li class="list-item">
                    <a href="#" class="link link--nav">Мои задания</a>
                </li>
                <li class="list-item">
                    <a href="#" class="link link--nav">Создать задание</a>
                </li>
                <li class="list-item">
                    <a href="#" class="link link--nav">Настройки</a>
                </li>
            </ul>
        </div>
        <?php endif; ?>
    </nav>
    <?php if(Url::current() !== '/signup'): ?>
    <div class="user-block">
        <a href="#">
            <img class="user-photo" src="/img/man-glasses.png" width="55" height="55" alt="Аватар">
        </a>
        <div class="user-menu">
            <p class="user-name">
                <!-- Василий -->
                <!-- ЗДЕСЬ ВСЕ NULL -->
                <?= var_dump(Yii::$app->user->isGuest) ?> <!-- TODO Удалить  -->
                <?= var_dump(Yii::$app->user->getId()) ?> <!-- TODO Удалить  -->
                <?php if (!Yii::$app->user->isGuest): ?>
                    <?= Html::encode(Yii::$app->user->identity->user_name); ?>
                <?php endif; ?>
            </p>
            <div class="popup-head">
                <ul class="popup-menu">
                    <li class="menu-item">
                        <a href="#" class="link">Настройки</a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="link">Связаться с нами</a>
                    </li>
                    <li class="menu-item">
                        <a href="<?= Url::to('/user/logout'); ?>" class="link">Выход из системы</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>
</header>
<main class="main-content container">
    <?= $content ?>
</main>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
