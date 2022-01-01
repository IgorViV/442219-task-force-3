<?php
declare(strict_types=1);

namespace Taskforce\logic;

class CancelAction extends AbstractBaseAction
{
    public function getTitle(): string 
    {
        return 'Отменить';
    }
    public function getName(): string
    {
        return 'action_cancel';
    }
    public function compareUsers(): bool 
    {
        return $this->idCurrentUser === $this->idAcceptableUser;
    }
}