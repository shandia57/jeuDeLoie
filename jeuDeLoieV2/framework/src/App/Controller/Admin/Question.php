<?php

namespace App\Controller\Admin;

use Framework\Controller\AbstractController;
use App\Class\User\User;
use App\Class\Admin\Questions\Questions;
use App\Class\Admin\Answers\Answers;
use  App\Class\ControlDataForm\ControlDataEntity\ControlQuestionsForm;
use  App\Class\ControlDataForm\ControlDataEntity\ControlAnswersForm;

use App\Manager\Questions\Insert;
use App\Manager\Questions\Update;
use App\Manager\Questions\Delete;
use App\Manager\Questions\Get;


class Question extends AbstractController
{

    public function __invoke(): string
    {
 
        session_start();

        $this->isConnected = $_SESSION['user'] ?? null;
        $this->createUserSessionWithCookie();
        Question::isAdmin();

        $question = new Questions();
        $answer = new Answers();

        $controlQuestionsForm = new ControlQuestionsForm();
        $controlAnswersForm = new ControlAnswersForm();

        if(!empty($_POST))
        {
            $this->controlPostSended($controlAnswersForm, $controlQuestionsForm, $question, $answer);
        }



        $users = (new User)->getUsers();
        $questions = (new Get)->get();

        return $this->render('Admin/questions.html.twig', [
            'user' => $this->isConnected['username'],
            'user_roles' => $this->isConnected['roles'],
            'title' => "Questions",
            'questions' => $questions, 
            'label' =>  $controlQuestionsForm->displayErrors("label"),
            'level' =>  $controlQuestionsForm->displayErrors("level"),
            'question' =>  $controlQuestionsForm->displayErrors("question"),
            "answer" => $controlAnswersForm->displayErrors("answer"),
            "nbrUsers" => count($users),
            "nbrQuestions" => count($questions),
            "anyErrors" => $this->anyErrors,

        ]);
    }


    public function controlPostSended($controlAnswersForm, $controlQuestionsForm) : void
    {
        if (isset($_POST['insertQuestion'])) {
            $insert = (new Insert)->insert();
            if($insert !== true){
               $controlQuestionsForm->setErrors($insert[0]); 
               $controlAnswersForm->setErrors($insert[1]); 
               $this->anyErrors = "L'insertion de la question a échoué, cliquez sur 'Ajouter un nouvel utilisateur' pour avoir plus de détails";
            }
        }else if (isset($_POST['UpdateQuestions'])){

            $update = (new Update)->update();
            if($update !== true){
                $controlQuestionsForm->setErrors($update);
               $this->anyErrors = "La modification de la question a échoué, cliquez sur 'Ajouter un nouvel utilisateur' pour avoir plus de détails";
            }

        }else if (isset($_POST['deleteQuestions']) && $_POST['deleteQuestions'] === "true"){
            $delete = (new Delete)->delete();   

        }else if (isset($_POST['logout']) && $_POST['logout'] === "true"){
            $this->logout();
        }
    }
  
}
