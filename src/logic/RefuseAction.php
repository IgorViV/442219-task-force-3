<?php
declare(strict_types=1);

namespace Taskforce\logic;

class RefuseAction extends AbstractBaseAction
{
    public function getTitle(): string 
    {
        return 'Отказаться';
    }
    public function getName(): string 
    {
        return 'action_refuse';
    }
    public function compareUsers(): bool
    {
        return $this->idCurrentUser === $this->idAcceptableUser;
    }
}