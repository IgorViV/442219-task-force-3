<?php
declare(strict_types=1);

namespace Taskforce\logic;

class RespondAction extends AbstractBaseAction
{
    public function getTitle(): string 
    {
        return 'Откликнуться';
    }
    public function getName(): string
    {
        return 'action_respond';
    }
    public function compareUsers(): bool 
    {
        return $this->idCurrentUser === $this->idAcceptableUser;
    }
}