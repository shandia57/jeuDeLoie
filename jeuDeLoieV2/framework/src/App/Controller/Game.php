<?php
namespace App\Controller;


use Framework\Controller\AbstractController;

class Game extends AbstractController
{

    public function __invoke($player): string
    {
            $users = [];
            if(!empty($_POST['players'])){

                $users = $_POST['players'];

                // for($i = 0; $i < sizeOf($users); $i++){
                //     $user = explode(",", $users[$i]);
                //     $to_email = 'alexandre57450@hotmail.fr';
                //     $subject = 'Rejoins la partie !';
                //     $message = "Rejoins la partie via ce lien -> http://framework.local/game?player=$user[0]";
                //     $headers = 'From: noreply @ company . com';
                //     mail($to_email,$subject,$message,$headers);
                // }
                
            }





            return $this->render('/game.html.twig', [

                "users" => $users,
            ]);
        }




}