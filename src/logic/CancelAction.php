<?php
namespace Taskforce\logic;

class CancelAction extends AbstractBaseAction
{
    public function getTitle() 
    {
        return 'Отменить';
    }
    public function getName()
    {
        return 'action_cancel';
    }
    public function compareUsers() 
    {
        return $this->idCurrentUser === $this->idAcceptableUser;
    }
}