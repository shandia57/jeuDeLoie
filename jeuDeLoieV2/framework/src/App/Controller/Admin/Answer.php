<?php

namespace App\Controller\Admin;

use Framework\Controller\AbstractController;
use App\Class\Admin\Questions\Questions;
use App\Class\Admin\Answers\Answers;
use  App\Class\ControlDataForm\ControlDataEntity\ControlAnswersForm;

use App\Manager\Answers\Insert;
use App\Manager\Answers\Update;
use App\Manager\Answers\Delete;
use App\Manager\Answers\Get;

use App\Manager\Questions\Get as GetQuestions;


class Answer extends AbstractController
{

    public function __invoke(string $id): string
    {
        session_start();

        $this->isConnected = $_SESSION['user'] ?? null;
        $this->createUserSessionWithCookie();
        Answer::isAdmin();
        
        $controlAnswersForm = new ControlAnswersForm();


        if(!empty($_POST))
        {
            $this->controlPostSended($id, $controlAnswersForm);
        }


        if ((int)$id){
            $questions = (new GetQuestions)->getSingle($id);
            $answers = (new Get)->get($id);
            if(empty($questions)){
                header("location: /questions");
            }
        }else{
            header("location: /questions");
        }
        
        return $this->render('Admin/answer.html.twig', [
            'title' => "Questions",
            'questions' => $questions??null,
            'answers' => $answers??null,
            "answer" => $controlAnswersForm->displayErrors("answer"),

        ]);
    }

    public function controlPostSended($id, $controlAnswersForm) : void
    {
        if(isset($_POST ['updateAnswer'])){
            $update = (new Update)->update();
            if($update !== true){
                $controlAnswersForm->setErrors($update);
            }

        }else if (isset($_POST['deleteAnswer'])){
            $delete = (new Delete)->delete();

        }else if (isset($_POST ['insertAnswer'])){
            $insert = (new Insert)->insert($id);
            if($insert !== true){
                $controlAnswersForm->setErrors($insert);
            }        
        }
    }

  
}
