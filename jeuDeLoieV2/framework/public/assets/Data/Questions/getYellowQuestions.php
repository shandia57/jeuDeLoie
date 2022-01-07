<?php 

require_once('../../../../vendor/autoload.php');

use App\Class\Admin\Questions\Questions;


$questions = (new Questions)->getYellowQuestions();

echo json_encode($questions);