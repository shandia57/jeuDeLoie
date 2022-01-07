<?php 

namespace App\Class\ControlDataForm\ControlDataEntity;
use App\Class\ControlDataForm\ControlDataForm;

class ControlQuestionsForm extends ControlDataForm
{

    protected $validations = [
        'label' => [
            'rules' => [
                ['name' => 'required'],
                ['name' => 'maxlength', 'value' => 100],
                ['name' => 'isString']
               
            ]
        ],
        'level' => [
            'rules' => [
                ['name' => 'required'],
                ['name' => 'maxlength', 'value' => 100],
                ['name' => 'isString'], 
                ['name' => 'shouldBe', 'value' => ["Vert", 
                                                    "Jaune",
                                                    "Bleu",
                                                    "Orange",
                                                    "Rouge",
                                                    "Noir"
                                                    ]]
            ]
        ],
        'question' => [
            'rules' => [
                ['name' => 'required'],
                ['name' => 'maxlength', 'value' => 100],
                ['name' => 'isString']
            ]
        ],
    ];

    
    public function getValidations() : array
    {
        return $this->validations;
    }


    
}