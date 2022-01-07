<?php 

namespace App\Class\ControlDataForm\ControlDataEntity;
use App\Class\ControlDataForm\ControlDataForm;

class ControlAnswersForm extends ControlDataForm
{

    protected $validations = [
        'answer' => [
            'rules' => [
                ['name' => 'required'],
                ['name' => 'maxlength', 'value' => 100],
                ['name' => 'isString']
               
            ]
        ]
    ];

    
    public function getValidations() : array
    {
        return $this->validations;
    }

    public function findErrosIntoArray($array) : void
    {
        for($i = 0; $i < count($array); $i++){
            $this->findError($this->getValidations(), ["answer" => $array[$i]], null);
        }       
    }

    
}