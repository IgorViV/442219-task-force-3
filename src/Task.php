<?php

class Task 
{
    const STATUS_NEW = 'new';                 // The task has been published, 
                                              // the performer has not yet been found
    const STATUS_CANCELED = 'canceled';       // The customer canceled the task
    const STATUS_WORK = 'work';               // The customer chose the contractor for the task 
    const STATUS_DONE = 'done';               // The customer marked the task as completed
    const STATUS_FAILED = 'failed';           // The performer refused to complete the task
    const ACTION_CANCEL = 'action_cancel';    // Cancel action
    const ACTION_RESPOND = 'action_respond';  // Action respond
    const ACTION_REFUSE = 'action_refuse';    // Action refused
    const ACTION_DONE = 'action_done';        // Action completed

    public $currentStatus = self::STATUS_NEW;
    public $idCustomer;
    public $idPerformer;

    public $rulesForActionsCustomer = [
        self::STATUS_NEW => self::ACTION_CANCEL,
        self::STATUS_WORK => self::ACTION_DONE,
    ];
    public $rulesForActionsPerformer = [
        self::STATUS_NEW => self::ACTION_RESPOND,
        self::STATUS_WORK => self::ACTION_REFUSE,
    ];

    public function __construct($idCustomer, $idPerformer)
    {
        $this->idCustomer = $idCustomer;
        $this->idPerformer = $idPerformer;
    }

    /**
     * Returns a status map
     */
    public function getMapStatus()
    {
        return [
            self::STATUS_NEW => 'Новое',
            self::STATUS_CANCELED => 'Отменено',
            self::STATUS_WORK => 'В работе',
            self::STATUS_DONE => 'Выполнено',
            self::STATUS_FAILED => 'Провалено',
        ];
    }

    /**
     * Returns an action map
     */
    public function getMapAction()
    {
        return [
            self::ACTION_CANCEL => 'Отменить',
            self::ACTION_RESPOND => 'Откликнуться',
            self::ACTION_REFUSE => 'Отказаться',
            self::ACTION_DONE => 'Выполнено',
        ];
    }

    /**
     * Gets the following status after this action
     */
    public function getFollowingStatus($action)
    {
        if ($action === self::ACTION_CANCEL) {
            return $this->currentStatus = self::STATUS_CANCELED;
        }
        if ($action === self::ACTION_DONE) {
            return $this->currentStatus = self::STATUS_DONE;
        }
        if ($action === self::ACTION_REFUSE) {
            return $this->currentStatus = self::STATUS_FAILED;
        }
        if ($action === self::ACTION_RESPOND) {
            return $this->currentStatus = self::STATUS_WORK;
        }

        return $this->currentStatus;
    }

    /**
     * Gets available actions for current status for customer
     */
    public function getAvailableActionsCustomer()
    {
        if ($this->currentStatus === self::STATUS_NEW || $this->currentStatus === self::STATUS_WORK) {
            return $this->rulesForActionsCustomer[$this->currentStatus];
        }
        return null;
    }

    /**
     * Gets available actions for current status for performer
     */
    public function getAvailableActionsPerformer()
    {
        if ($this->currentStatus === self::STATUS_NEW || $this->currentStatus === self::STATUS_WORK) {
            return $this->rulesForActionsPerformer[$this->currentStatus];
        }
        return null;
    }
}