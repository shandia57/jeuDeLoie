<?php 

namespace App\Manager\Answers;
use App\Class\Admin\Questions_Answers\QuestionsAnswers;

class Delete
{
    public function delete()
    {
        $questionsAnswers = new QuestionsAnswers();
        if( $_POST ['deleteAnswer'] === "true"){
            $questionsAnswers->deleteQuestion($_POST['idAnswerUpdate']);
        }
    }
}