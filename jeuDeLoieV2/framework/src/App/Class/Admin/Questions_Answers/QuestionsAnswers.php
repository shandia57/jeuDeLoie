<?php 

namespace App\Class\Admin\Questions_Answers;
use  App\Class\Connection\Connection;
use PDO;

class QuestionsAnswers
{
    protected int $id_question;
    protected int $id_answer;


    public function getId_question() : int
    {
        return $this->id_question;
    }


    public function setId_question($id_question) : QuestionsAnswers
    {
        $this->id_question = $id_question;

        return $this;
    }


    public function getId_answer() : int
    {
        return $this->id_answer;
    }


    public function setId_answer($id_answer) : QuestionsAnswers
    {
        $this->id_answer = $id_answer;

        return $this;
    }

    public function linkQuestionWithAnswer($id_question, $id_answer) : bool{

        $connection = Connection::get();
        $sql = 'INSERT INTO `questions_answers`(`id_question`, `id_answer`) 
                VALUES (:id_question, :id_answer)';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam('id_question', $id_question, PDO::PARAM_STR);
        $stmt->bindParam('id_answer', $id_answer, PDO::PARAM_STR);
    
        return $stmt->execute();
    }

    public function getQuestionsAnswer() : Array
    {
        $connection = Connection::get();
        $stmt = $connection->prepare("SELECT * FROM `questions_answers` ");
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function deleteQuestion($id_answer) : Array
    {
        $connection = Connection::get();
        $sql = "DELETE 
        FROM `questions_answers`  
        WHERE `id_answer` = $id_answer";
        $stmt = $connection->prepare($sql);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function getAnswer($id_question){
        $connection = Connection::get();
        $stmt = $connection->prepare("SELECT * FROM answer, questions_answers WHERE questions_answers.id_question = $id_question AND questions_answers.id_answer = answer.id_answer;");
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}