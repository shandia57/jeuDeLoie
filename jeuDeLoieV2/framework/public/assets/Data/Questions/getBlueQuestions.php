<?php

require_once('../../../../vendor/autoload.php');

use App\Class\Admin\Questions\Questions;


$questions = (new Questions)->getBlueQuestions();

echo json_encode($questions);