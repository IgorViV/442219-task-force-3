<?php
declare(strict_types=1);

namespace Taskforce\logic;

class DoneAction extends AbstractBaseAction
{
    public function getTitle(): string 
    {
        return 'Выполнено';
    }
    public function getName(): string
    {
        return 'action_done';
    }
    public function compareUsers(): bool 
    {
        return $this->idCurrentUser === $this->idAcceptableUser;
    }
}