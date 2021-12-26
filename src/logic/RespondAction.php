<?php
namespace Taskforce\logic;

class RespondAction extends AbstractBaseAction
{
    public function getTitle() 
    {
        return 'Откликнуться';
    }
    public function getName() 
    {
        return 'action_respond';
    }
    public function compareUsers() 
    {
        return $this->idCurrentUser === $this->idAcceptableUser;
    }
}