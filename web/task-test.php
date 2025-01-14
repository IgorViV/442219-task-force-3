<?php
declare(strict_types=1);

use Taskforce\logic\Task;
use Taskforce\logic\CancelAction;
use Taskforce\logic\DoneAction;
use Taskforce\logic\RespondAction;
use Taskforce\logic\RefuseAction;
use Taskforce\utilities\ConvertCsvToSql;
use Taskforce\exceptions\FileFormatException;
use Taskforce\exceptions\SourceFileException;
use Taskforce\exceptions\WriteFileException;

require_once 'vendor/autoload.php';

$idCurrentUser = 1;
$idCustomer = 1;
$idPerformer = 2;
$isPerformer = true;
$currentStatus = 'new';

$newTask = new Task($currentStatus, $idCurrentUser, $idCustomer, $idPerformer);

/**
 * Checking class methods
 */
assert(
    ($newTask->getAvailableActions(!$isPerformer))->getTitle() ===
    (new CancelAction($idCurrentUser, $idCustomer))->getTitle(),
    'available action for NEW_TASK customer'
);

assert(
    $newTask->getAvailableActions($isPerformer) === null,
    'unavailable action for NEW_TASK performer'
);

assert(
    $newTask->getFollowingStatus('action_cancel') ===
    Task::STATUS_CANCELED,
    'action cancel'
);

assert(
    $newTask->getAvailableActions(!$isPerformer) === null,
    'unavailable action for CANCELED_TASK customer'
);

assert(
    $newTask->getAvailableActions($isPerformer) === null,
    'unavailable action for CANCELED_TASK performer'
);

assert(
    $newTask->getFollowingStatus('action_done') ===
    Task::STATUS_DONE,
    'action done'
);

assert(
    $newTask->getAvailableActions(!$isPerformer) === null,
    'unavailable action for DONE_TASK customer'
);

assert(
    $newTask->getAvailableActions($isPerformer) === null,
    'unavailable action for DONE_TASK performer'
);

assert(
    $newTask->getFollowingStatus('action_refuse') ===
    Task::STATUS_FAILED,
    'action failed'
);

assert(
    $newTask->getAvailableActions(!$isPerformer) === null,
    'unavailable action for FAILED_TASK customer'
);

assert(
    $newTask->getAvailableActions($isPerformer) === null,
    'unavailable action for FAILED_TASK performer'
);

assert(
    $newTask->getFollowingStatus('action_respond') ===
    Task::STATUS_WORK,
    'action respond'
);

assert(
    ($newTask->getAvailableActions(!$isPerformer))->getTitle() ===
    (new DoneAction($idCurrentUser, $idCustomer))->getTitle(),
    'available action for WORK_TASK customer'
);

assert(
    $newTask->getAvailableActions($isPerformer) === null,
    'available action for WORK_TASK performer'
);

/**
 * Checking class action methods for performer
 */

$idCurrentUser = 2;
$idCustomer = 1;
$idPerformer = 2;
$isPerformer = true;
$currentStatus = 'new';

$secondTask = new Task($currentStatus, $idCurrentUser, $idCustomer, $idPerformer);

assert(
    $secondTask->getAvailableActions(!$isPerformer) === null,
    'unavailable action for NEW_TASK customer'
);

assert(
    ($secondTask->getAvailableActions($isPerformer))->getTitle() ===
    (new RespondAction($idCurrentUser, $idPerformer))->getTitle(),
    'available action for NEW_TASK performer'
);

assert(
    $secondTask->getFollowingStatus('action_respond') ===
    Task::STATUS_WORK,
    'action respond'
);

assert(
    $secondTask->getAvailableActions(!$isPerformer) === null,
    'unavailable action for WORK_TASK customer'
);

assert(
    ($secondTask->getAvailableActions($isPerformer))->getTitle() ===
    (new RefuseAction($idCurrentUser, $idPerformer))->getTitle(),
    'available action for WORK_TASK performer'
);

/**
 * Convert file CSV TO SQL
 */

$convertCategories = new ConvertCsvToSql("data/categories.csv", ['name', 'icon']);
try {
    $convertCategories->convert();
} catch (SourceFileException $e) {
    print('Не удалось обработать csv файл: ' . $e->getMessage());
} catch (FileFormatException $e) {
    print('Неверный форма файла импорта: ' . $e->getMessage());
} catch (WriteFileException $e) {
    print('Ошибка записи файла: ' . $e->getMessage());
}

$convertCities = new ConvertCsvToSql("data/cities.csv", ['name', 'lat', 'long']);
try {
    $convertCities->convert();
} catch (SourceFileException $e) {
    print('Не удалось обработать csv файл: ' . $e->getMessage());
} catch (FileFormatException $e) {
    print('Неверный форма файла импорта: ' . $e->getMessage());
} catch (WriteFileException $e) {
    print('Ошибка записи файла: ' . $e->getMessage());
}
