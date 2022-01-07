<?php 

namespace App\Manager\Answers;

use App\Class\Admin\Answers\Answers;
use App\Class\Admin\Questions_Answers\QuestionsAnswers;
use  App\Class\ControlDataForm\ControlDataEntity\ControlAnswersForm;


class Insert
{
    public function insert($id)
    {
        if (isset($_POST['validAnswer'])){
            $validAnswer = 1;
        }else{
            $validAnswer = 0;
        }
        $answer = new Answers();
        $controlAnswersForm = new ControlAnswersForm();
        $questionsAnswers = new QuestionsAnswers();
        
        $controlAnswersForm->findError($controlAnswersForm->getValidations(), $_POST, null);
        if(empty($controlAnswersForm->getErrors())){
            $answer->insertAnswer($_POST['answer'], $validAnswer);
            $id_answer = $answer->getNumberIdAnswer();
            $id_answer = $answer->returnNumberIfEmptyID($id_answer);
            $questionsAnswers->linkQuestionWithAnswer($id, $id_answer);
            return true;
        }else{
            return $controlAnswersForm->getErrors();
        }
    }
}