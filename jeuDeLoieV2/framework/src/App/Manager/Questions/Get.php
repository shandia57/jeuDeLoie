<?php 

namespace App\Manager\Questions;
use App\Class\Admin\Questions\Questions;

class Get
{
    public function get()
    {
        $question = new Questions();
        return $question->getAllQuestions();
    }

    public function getSingle($id)
    {
        $question = new Questions();
        return $question->getSingleQuestion($id);
    }
}