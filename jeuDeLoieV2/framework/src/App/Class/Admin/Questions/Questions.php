<?php 

namespace App\Class\Admin\Questions;
use  App\Class\Connection\Connection;
use PDO;

class Questions
{
    protected int $id_question;
    protected string $answer;
    protected bool $valid;


    public function __construct()
    {

    }

    public function getId_questions(): int
    {
        return $this->id_questions;
    }


    public function setId_questions($id_questions): Questions
    {
        $this->id_questions = $id_questions;

        return $this;
    }


    public function getLabel(): string
    {
        return $this->label;
    }


    public function setLabel($label): Questions
    {
        $this->label = $label;

        return $this;
    }


    public function getLevel(): string
    {
        return $this->level;
    }


    public function setLevel($level): Questions
    {
        $this->level = $level;

        return $this;
    }


    public function getQuestion(): string
    {
        return $this->question;
    }


    public function setQuestion($question): Questions
    {
        $this->question = $question;

        return $this;
    }

    public function getMaxNumberIdQuestions() : Array
    {
        $connection = Connection::get();
        $stmt = $connection->prepare("SELECT MAX(id_question) as numberID FROM `questions` ");
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
    }

    public function returnNumberIfEmptyID($isEmptyID) : int
    {
        if( empty($isEmptyID[0]['numberID']) ){
            return 1;
        }else{
            return $isEmptyID[0]['numberID'] + 1 ;
        }
    }

    public function insertQuestion($dataQuestion, $id_question) : bool
    {
        $connection = Connection::get();
    
        $sql = 'INSERT INTO
                `questions`(`id_question`, `label`, `level`, `question`) 
                VALUES 
                    (:id_question, :label, :level, :question)';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam('id_question', $id_question, PDO::PARAM_STR);
        $stmt->bindParam('label', $dataQuestion['label'], PDO::PARAM_STR);
        $stmt->bindParam('level', $dataQuestion['level'], PDO::PARAM_STR);
        $stmt->bindParam('question', $dataQuestion['question'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function getAllQuestions() : Array
    {
        $connection = Connection::get();
        $stmt = $connection->prepare("SELECT * FROM `questions` ");
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function getSingleQuestion($id) : array
    {
        $connection = Connection::get();
        $stmt = $connection->prepare("SELECT * FROM `questions` WHERE id_question = $id");
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function updateQuestion($dataQuestion) : bool
    {
        $label = addslashes($dataQuestion['label']);
        $question = addslashes($dataQuestion['question']);
        $connection = Connection::get();
        $sql = "UPDATE `questions` SET 
         `label`=  '$label', 
         `level` = '$dataQuestion[level]', 
         `question` = '$question' 
          WHERE `questions`.`id_question` = $dataQuestion[idQuestionsUpdate] ;";
        $stmt = $connection->prepare($sql);
        return $stmt->execute();
    }

    public function deleteQuestion($id_question) : array
    {
        $connection = Connection::get();
        $sql = "DELETE 
        FROM `questions`  
        WHERE `id_question` = $id_question";
        $stmt = $connection->prepare($sql);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function getGreenQuestions(): array
    {
        $connection = Connection::get();
        $stmt = $connection->prepare("SELECT * FROM questions WHERE level = 'vert' ");
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } 
    }

    public function getYellowQuestions(): array
    {
        $connection = Connection::get();
        $stmt = $connection->prepare("SELECT * FROM questions WHERE level = 'jaune' ");
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } 
    }

    public function getBlueQuestions(): array
    {
        $connection = Connection::get();
        $stmt = $connection->prepare("SELECT * FROM questions WHERE level = 'bleu' ");
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } 
    }

    public function getOrangeQuestions(): array
    {
        $connection = Connection::get();
        $stmt = $connection->prepare("SELECT * FROM questions WHERE level = 'orange' ");
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } 
    }

    public function getRedQuestions(): array
    {
        $connection = Connection::get();
        $stmt = $connection->prepare("SELECT * FROM questions WHERE level = 'rouge' ");
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } 
    }

    public function getBlackQuestions(): array
    {
        $connection = Connection::get();
        $stmt = $connection->prepare("SELECT * FROM questions WHERE level = 'noir' ");
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } 
    }
}