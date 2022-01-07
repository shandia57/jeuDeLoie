<?php
namespace App\Controller\Fail;


use Framework\Controller\AbstractController;

class Fail extends AbstractController
{


    public function __invoke(): string
    {
        session_start();
        if(isset($_SESSION['user']) && $_SESSION['user']['roles'] === "ROLES_ADMIN" ){
            header("Location: /");
        }
            return $this->render('/Fail/fail.html.twig', [
            ]);
        }
}