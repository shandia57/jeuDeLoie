<?php

namespace App\Class\ControlDataForm;

class ControlDataForm
{
    protected $errors = [];

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors($errors): ControlDataForm
    {
        $this->errors = $errors;

        return $this;
    }


    public function findError($validation, $dataPosted, $user)
    {
        foreach ($validation as $fieldName => $params) {
            foreach ($params['rules'] as $rule) {
                switch ($rule['name']) {
                    case 'required':
                        if (empty($dataPosted[$fieldName])) {
                            $this->errors[$fieldName][] = 'Le champs est obligatoire';
                        }
                        break;
                    case 'maxlength':
                        if (strlen($dataPosted[$fieldName]) > $rule['value']) {
                            $this->errors[$fieldName][] = 'La valeur de ce champs ne doit pas dépasser ' . $rule['value'] . ' caractères !';
                        }
                        break;
                    case 'mail':
                        if (!filter_var($dataPosted[$fieldName], FILTER_VALIDATE_EMAIL)) {
                            $this->errors[$fieldName][] = 'Ce champs doit contenir une adresse email valide !';
                        }
                        break;
                    case 'sameAs':
                        if ($dataPosted[$fieldName] !== $dataPosted[$rule['field']]) {
                            $this->errors[$fieldName][] = $rule['validationMessage'];
                        }
                        break;
                    case 'match':
                        if ($dataPosted[$fieldName] !== $rule['value']) {
                            $this->errors[$fieldName][] = $rule['validationMessage'] ?? 'La valeur de ce champs doit etre égale à ' . $rule['value'];
                        }
                        break;
                    case 'isString':
                        if (!is_string($dataPosted[$fieldName])) {
                            $this->errors[$fieldName][] = 'Ce champs doit etre une chaine de caractères !';
                        }
                        break;
                    case "shouldBe":
                        if ($dataPosted[$fieldName] !== $rule['value']) {
                            if (!in_array($dataPosted[$fieldName], $rule['value'])) {
                                $this->errors[$fieldName][] = 'Vous devez obligatoirement choisir une des valeurs données dans le sélecteur !';
                            }
                        }
                    case 'unique':
                        // $user = null if we do not want to check this case
                        if ($user !== null) {
                            if ($user->userExists($dataPosted[$fieldName])) {
                                $this->errors[$fieldName][] = $rule['validationMessage'] ?? 'Username déjà existant !';
                            }
                        }
                        break;
                    case 'uniqueMail':
                        // $user = null if we do not want to check this case
                        if ($user !== null) {
                            if ($user->mailExists($dataPosted[$fieldName])) {
                                $this->errors[$fieldName][] = $rule['validationMessage'] ?? 'adresse mail déjà existante !';
                            }
                        }
                        break;
                }
            }
        }
    }

    public function displayErrors($fieldName): string
    {
        $return = '';
        if (isset($this->errors[$fieldName])) {
            foreach ($this->errors[$fieldName] as $error) {
                $return = $return . $error;
            }
        }

        return $return;
    }
}
