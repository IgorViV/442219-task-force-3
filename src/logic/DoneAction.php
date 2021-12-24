<?php
namespace Taskforce\logic;

class DoneAction extends AbstractBaseAction
{
    public function getTitle() 
    {
        return 'Выполнено';
    }
    public function getName() 
    {
        return 'action_done';
    }
    public function compareUsers() 
    {
        return $this->idCurrentUser === $this->idAcceptableUser;
    }
}