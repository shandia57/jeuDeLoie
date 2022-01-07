<?php

use App\Controller\Homepage;
use App\Controller\Game;
use App\Controller\Fail\Fail;

use App\Controller\Admin\Question;
use App\Controller\Admin\Answer;
use App\Controller\Admin\Users;

use App\Controller\Subscribe\Subscribe;

use App\Controller\Logout;
use App\Controller\UserLogin;

use Framework\Routing\Route;


require_once "../vendor/autoload.php";

return [
    new Route('GET', '/', Homepage::class),
    new Route('POST', '/', Homepage::class),
    // new Route('PUT', '/', Logout::class),

    new Route('GET', '/fail', Fail::class),

    new Route('GET', '/game?player={player}', Game::class),
    new Route('POST', '/game?player={player}', Game::class),

    new Route('GET', '/questions', Question::class),
    new Route('POST', '/questions', Question::class),

    new Route('GET', '/users', Users::class),
    new Route('POST', '/users', Users::class),
    
    new Route('GET', '/questions/{id}', Answer::class),
    new Route('POST', '/questions/{id}', Answer::class),

    new Route('GET','/connectToGame', UserLogin::class),
    new Route('POST','/connectToGame', UserLogin::class),
    new Route('PUT','/connectToGame', Logout::class),

    new Route('GET','/subscribe', Subscribe::class),
    new Route('POST','/subscribe', Subscribe::class),
];