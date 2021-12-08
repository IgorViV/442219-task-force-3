<?php
    use Taskforce\logic\Task;
    require_once 'vendor/autoload.php';

    $newTask = new Task(1, 1);

    /**
     * Checking class methods
     */
    assert(
        $newTask->getAvailableActionsCustomer() === 
        $newTask->rulesForActionsCustomer[Task::STATUS_NEW], 
        'available action customer'
    );

    assert(
        $newTask->getAvailableActionsPerformer() === 
        $newTask->rulesForActionsPerformer[Task::STATUS_NEW], 
        'available action performer'
    );

    assert(
        $newTask->getFollowingStatus('action_cancel') === 
        Task::STATUS_CANCELED, 
        'action cancel'
    );

    assert(
        $newTask->getAvailableActionsCustomer() === null, 
        'unavailable action customer'
    );

    assert(
        $newTask->getAvailableActionsPerformer() === null, 
        'unavailable action performer'
    );

    assert(
        $newTask->getFollowingStatus('action_done') === 
        Task::STATUS_DONE, 
        'action done'
    );

    assert(
        $newTask->getAvailableActionsCustomer() === null, 
        'unavailable action customer'
    );

    assert(
        $newTask->getAvailableActionsPerformer() === null, 
        'unavailable action performer'
    );

    assert(
        $newTask->getFollowingStatus('action_refuse') === 
        Task::STATUS_FAILED, 
        'action failed'
    );

    assert(
        $newTask->getAvailableActionsCustomer() === null, 
        'unavailable action customer'
    );

    assert(
        $newTask->getAvailableActionsPerformer() === null, 
        'unavailable action performer'
    );

    assert(
        $newTask->getFollowingStatus('action_respond') === 
        Task::STATUS_WORK, 
        'action respond'
    );

    assert(
        $newTask->getAvailableActionsCustomer() === 
        $newTask->rulesForActionsCustomer[Task::STATUS_WORK], 
        'available action customer'
    );

    assert(
        $newTask->getAvailableActionsPerformer() === 
        $newTask->rulesForActionsPerformer[Task::STATUS_WORK], 
        'available action performer'
    );