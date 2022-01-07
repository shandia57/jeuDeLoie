<?php

namespace App\Controller\Admin;

use Framework\Controller\AbstractController;
use App\Class\User\User;
use App\Class\Admin\Questions\Questions;
use App\Class\ControlDataForm\ControlDataEntity\ControlUsersForm;

use App\Manager\Users\Insert;
use App\Manager\Users\Update;
use App\Manager\Users\Delete;
use App\Manager\Users\Get;


class Users extends AbstractController
{
    public function __invoke()
    {
        $test = new User();
        session_start();
        $controlUserForm = new ControlUsersForm();

        $this->isConnected = $_SESSION['user'] ?? null;
        $this->createUserSessionWithCookie();
        Users::isAdmin();

        if(!empty($_POST))
        {
            $this->controlPostSended($controlUserForm);
        }

        $users = (new Get)->get();
        
        $questions = (new Questions)->getAllQuestions();
        

        return $this->render('Admin/users.html.twig', [
            'user' => $this->isConnected['username'],
            'user_roles' => $this->isConnected['roles'],
            'users' => $users, 
            'username' => $controlUserForm->displayErrors("username"),
            'password' => $controlUserForm->displayErrors("password"),
            'passwordConfirm' => $controlUserForm->displayErrors("passwordConfirm"),
            'lastName' => $controlUserForm->displayErrors("lastName"),
            'firstName' => $controlUserForm->displayErrors("firstName"),
            'mail' => $controlUserForm->displayErrors("mail"),
            'roles' => $controlUserForm->displayErrors("roles"),
            "nbrUsers" => count($users),
            "nbrQuestions" => count($questions),
            "anyErrors" => $this->anyErrors,
        ]);        
    }

    public function controlPostSended($controlUserForm) : void
    {
        if(isset($_POST['delete'])){
            $delete = (new Delete)->delete();
            if($delete !== true){
                $this->anyErrors = "La suppression a échoué, cliquez sur 'Ajouter un nouvel utilisateur' pour avoir plus de détails";
            }


        }else if (isset($_POST['update'])){
            $update = (new Update)->update();
            if($update !== true){
                $controlUserForm->setErrors($update);
                $this->anyErrors = "La modification a échoué, cliquez sur 'Ajouter un nouvel utilisateur' pour avoir plus de détails";
            }

        }else if(isset($_POST['insert'])){
            $insert = (new Insert)->insert();
            if($insert !== true){
                $controlUserForm->setErrors($insert);
                $this->anyErrors = "L'inscription a échoué, cliquez sur 'Ajouter un nouvel utilisateur' pour avoir plus de détails";
            }
            
        }else if (isset($_POST['logout']) && $_POST['logout'] === "true" ){
            $this->logout();
        }
    }


}