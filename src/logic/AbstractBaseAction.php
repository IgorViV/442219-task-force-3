<?php
namespace Taskforce\logic;

abstract class AbstractBaseAction
{ 
    public $idCurrentUser;
    public $idAcceptableUser;

    public function __construct($idCurrentUser, $idAcceptableUser)
    {
        $this->idCurrentUser = $idCurrentUser;
        $this->idAcceptableUser = $idAcceptableUser;
    }

    abstract public function getTitle();
    abstract public function getName();
    abstract public function compareUsers(); 
}