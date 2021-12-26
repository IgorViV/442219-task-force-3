<?php
namespace Taskforce\logic;

class RefuseAction extends AbstractBaseAction
{
    public function getTitle() 
    {
        return 'Отказаться';
    }
    public function getName() 
    {
        return 'action_refuse';
    }
    public function compareUsers() 
    {
        return $this->idCurrentUser === $this->idAcceptableUser;
    }
}