<?php
namespace App\Controller;

use App\Class\User\User;
use App\Class\Admin\Questions\Questions;
use Framework\Controller\AbstractController;

class Homepage extends AbstractController
{


    public function __invoke(): string
    {

        session_start();
        
        if(!empty($_POST))
        {
            $this->controlPostSended();
        }
        

        $users = (new User)->getUsers();
        $questions = (new Questions)->getAllQuestions();

        
        $this->isConnected = $_SESSION['user'] ?? null;
        $this->createUserSessionWithCookie();


        $result = (new User)->filterArrayByKeyValue($users, 'username',$isConnected??null['username']??null);
            return $this->render('/home.html.twig', [
                "user" => $this->isConnected['username']?? null,
                "user_roles" => $this->isConnected['roles']?? null,
                "usersNumber" => sizeOf($result),
                "nbrUsers" => count($users),
                "nbrQuestions" => count($questions),
                "anyErrors" => $this->anyErrors,
                "users" => $users


            ]);
        }

        public function sendError() : void
        {
            $this->anyErrors = "La connexion a échoué, l'identifiant ou le mot de passe est incorrect";
        }

        public function createCookie($cookieName, $value) : void
        {
            setcookie($cookieName,   $value, time() +
            (10 * 365 * 24 * 60 * 60));
        }


        public function tryToConnect() : void
        {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if((new User)->userExists($username) == null)
            {
                $this->sendError();
            }

            else
            {
                $this->isConnected= (new User)->userConnection($username, $password);

                if (empty($this->isConnected))
                {
                    $this->sendError();  
                }

                else
                {
                    if(isset($_POST['checkbox']))
                    {
                        $this->createCookie("remember_user",$this->isConnected['username']);
                        $this->createCookie("remember_roles",$this->isConnected['roles']);
                    }
                }

            }
        }

        public function controlPostSended() : void
        {
            if(isset($_POST['logout']))
            {
                if ($_POST['logout'] === "true")
                {
                    $this->logout();
                }
            }
            else if (isset($_POST['connect']))
            {
                $this->tryToConnect();
            }
        }

}