<?php 
namespace App\Manager\Answers;

use App\Class\Admin\Answers\Answers;


class Get
{
    public function get($id)
    {
        $answer = new Answers();
        return $answer->getAnswersWithIdQuestion($id);
    }
}