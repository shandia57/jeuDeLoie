<?php

namespace Framework\Controller;

use Framework\Templating\Twig;
abstract class AbstractController
{
    
    protected string $anyErrors = "";
    protected mixed $isConnected;


    public function render(string $template, array $args = []): string
    {
        $twig = new Twig();

        return $twig->render($template, $args);
    }
    public function isPost():bool
    {
        return strtoupper($_SERVER['REQUEST_METHOD])']) === $_POST;
    }

    
    public function redirect(string $url):void{
        header('location'.$url) ;
        exit();
    }


    public function isAdmin(): bool
    {
        if(isset($_SESSION['user']) && $_SESSION['user']['roles'] === "ROLES_ADMIN" ){
            return true;
        }else{
            header("Location: /fail");
            return false;
        }
        
    }
    public function logout(): void
    {
        session_destroy();
        if (isset($_COOKIE['remember_user']) && isset($_COOKIE['remember_roles'])) {
            unset($_COOKIE['remember_user']);
            setcookie('remember_user', '', time() - 3600, '/');

            unset($_COOKIE['remember_roles']);
            setcookie('remember_roles', '', time() - 3600, '/');
        } 
        header("Location: /");
    }

    public function setIsConnected($key, $cookieName) : void
    {
        $this->isConnected[$key]  = $_COOKIE[$cookieName];
    }

    public function createUserSessionWithCookie() : void
    {
        if (!empty($_COOKIE['remember_user'])  && !empty($_COOKIE['remember_roles']) ){
            $this->setIsConnected("username","remember_user" );
            $this->setIsConnected("roles","remember_roles" );
            $_SESSION['user'] = [
                "username" => $this->isConnected['username'],       
                "roles" => $this->isConnected['roles'], 
            ];
        }
    }

}
