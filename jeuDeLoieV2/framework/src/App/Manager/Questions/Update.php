<?php 

namespace App\Manager\Questions;
use  App\Class\ControlDataForm\ControlDataEntity\ControlQuestionsForm;
use App\Class\Admin\Questions\Questions;

class Update
{
    public function update()
    {
        $controlQuestionsForm = new ControlQuestionsForm();
        $question = new Questions();
        
        $controlQuestionsForm->findError($controlQuestionsForm->getValidations(), $_POST, null);            
        if(empty($controlQuestionsForm->getErrors())){
            $question->updateQuestion($_POST);
            return true;
        }else{
            return $controlQuestionsForm->getErrors();
        }
    }
}