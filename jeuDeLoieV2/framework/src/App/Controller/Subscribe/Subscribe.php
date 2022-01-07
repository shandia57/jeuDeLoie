<?php

namespace App\Controller\Subscribe;

use Framework\Controller\AbstractController;
use App\Class\User\User;
use App\Class\ControlDataForm\ControlDataEntity\ControlUserSubForm;

class Subscribe extends AbstractController
{
    public function __invoke(): string
    {
        session_start();
        $user = new User();
        $controlUserSubForm = new ControlUserSubForm();
        if (!empty($_POST)) {
            
            $controlUserSubForm->findError($controlUserSubForm->getValidationsSubscription(), $_POST, $user);
            
            if (empty($controlUserSubForm->getErrors())) {

                $_POST['roles'] = "ROLES_USER";
                $user->insertUser($_POST);
                if ($user) {
                    $_SESSION['user'] = [
                        "username" => $_POST['username'],       
                        "roles" => $_POST['roles'] 
                    ];
                    header("Location: /");
                } else {
                    echo 'Une erreur est survenue pendant votre inscription !';
                }

                die;
            }
        }

        return $this->render('Subscribe/subscribe.html.twig', array(

            'username' => $controlUserSubForm->displayErrors("username"),
            'password' => $controlUserSubForm->displayErrors("password"),
            'passwordConfirm' => $controlUserSubForm->displayErrors("passwordConfirm"),
            'lastname' => $controlUserSubForm->displayErrors("lastname"),
            'firstName' => $controlUserSubForm->displayErrors("firstName"),
            'mail' => $controlUserSubForm->displayErrors("mail"),
        ));
    }
}
