<?php 

require_once('../../../../vendor/autoload.php');

use App\Class\Admin\Questions_Answers\QuestionsAnswers;

$id = $_REQUEST["idQuestion"];
$answers = (new QuestionsAnswers)->getAnswer($id);

echo json_encode($answers);