<?php 

namespace App\Manager\Users;
use App\Class\User\User;


class Delete
{
    public function delete()
    {
        $user = new User();
        if($_POST['delete'] === "true"){
            $user->deleteUser($_POST['id_user']);
            return true;
        }else{
            return false;
        }

    }
}