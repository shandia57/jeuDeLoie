<?php 

namespace App\Manager\Questions;

use App\Class\Admin\Questions\Questions;
use App\Class\Admin\Answers\Answers;
use App\Class\Admin\Questions_Answers\QuestionsAnswers;
use  App\Class\ControlDataForm\ControlDataEntity\ControlQuestionsForm;
use  App\Class\ControlDataForm\ControlDataEntity\ControlAnswersForm;

class Insert
{

    public function insertQuestionAndAnswer()
    {
        $question = new Questions();
        $answer = new Answers();
        $questionsAnswers = new QuestionsAnswers();

        $id_question = $question->getMaxNumberIdQuestions();
        $id_question = $question->returnNumberIfEmptyID($id_question);

        $question->insertQuestion($_POST, $id_question);

        for($i = 0; $i < count($_POST['answer']); $i++){

            if(isset($_POST["validAnswer" .$i + 1])){
                $validAnswer = 1;
                $answer->insertAnswer($_POST['answer'][$i], $validAnswer);
    
            }else{
                $validAnswer = 0;
                $answer->insertAnswer($_POST['answer'][$i], $validAnswer);
            }

            $id_answer = $answer->getNumberIdAnswer();
            $id_answer = $answer->returnNumberIfEmptyID($id_answer);

            $questionsAnswers->linkQuestionWithAnswer($id_question, $id_answer);
        }
    }

    public function insert()
    {
        $question = new Questions();
        $answer = new Answers();
        $questionsAnswers = new QuestionsAnswers();
        $controlQuestionsForm = new ControlQuestionsForm();
        $controlAnswersForm = new ControlAnswersForm();


        $controlAnswersForm->findErrosIntoArray($_POST['answer']);
        $controlQuestionsForm->findError($controlQuestionsForm->getValidations(), $_POST, null);
        if(empty($controlQuestionsForm->getErrors()) && empty($controlAnswersForm->getErrors()) ){
            $this->insertQuestionAndAnswer($question, $answer, $questionsAnswers, $_POST);
            return true;
        }else{
            return [$controlQuestionsForm->getErrors(), $controlAnswersForm->getErrors()];
        }
    }
}