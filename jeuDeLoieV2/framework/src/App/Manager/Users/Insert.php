<?php 

namespace App\Manager\Users;
use App\Class\User\User;
use App\Class\ControlDataForm\ControlDataEntity\ControlUsersForm;


class Insert 
{
    public function insert()
    {
        $user = new User();
        $controlUserForm = new ControlUsersForm();
        $controlUserForm->findError($controlUserForm->getValidationsSubscription(),$_POST, $user);
        if(empty($controlUserForm->getErrors())){
            $user->insertUser($_POST);
            return true;
        }else{
           return $controlUserForm->getErrors();
        }
    }
}