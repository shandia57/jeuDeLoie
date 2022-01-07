<?php 

namespace App\Manager\Users;

use App\Class\User\User;


class Get
{
    public function get()
    {
        $user = new User();
        return $user->getUsers();
    }
}