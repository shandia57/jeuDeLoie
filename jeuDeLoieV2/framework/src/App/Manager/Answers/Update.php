<?php 

namespace App\Manager\Answers;
use App\Class\Admin\Answers\Answers;
use  App\Class\ControlDataForm\ControlDataEntity\ControlAnswersForm;

class Update
{
    public function update()
    {
        if (isset($_POST['validAnswer'])){
            $validAnswer = 1;
        }else{
            $validAnswer = 0;
        }

        $answer = new Answers();
        $controlAnswersForm = new ControlAnswersForm();
        $controlAnswersForm->findError($controlAnswersForm->getValidations(), $_POST, null);
        if(empty($controlAnswersForm->getErrors())){
            $answer->updateAnswer($_POST, $validAnswer);
            return true;
        }else{
            return $controlAnswersForm->getErrors();
        }
    }
}