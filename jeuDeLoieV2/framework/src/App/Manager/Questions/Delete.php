<?php 

namespace App\Manager\Questions;
use App\Class\Admin\Questions\Questions;

class Delete
{
    public function delete()
    {
        $question = new Questions();
        $question->deleteQuestion($_POST['idQuestionsUpdate']);
    }
}