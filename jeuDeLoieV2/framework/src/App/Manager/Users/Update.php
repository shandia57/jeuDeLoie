<?php 

namespace App\Manager\Users;
use App\Class\User\User;
use App\Class\ControlDataForm\ControlDataEntity\ControlUsersForm;


class Update
{
    public function update()
    {
        $user = new User();
        $controlUserForm = new ControlUsersForm();
        $controlUserForm->findError($controlUserForm->getValidationUpdate(), $_POST, $user);
        if(empty($controlUserForm->getErrors())){
            $user->updateUser($_POST);
            return true;
        }else{
            return $controlUserForm->getErrors();
        }
    }
}