<?php

require "bootstrap.php";

use Slim\Http\Request;
use Slim\Http\Response;

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$contenedor = new \Slim\Container($configuration);

$app = new \Slim\App($contenedor);

$app->post(
    '/game/create',
    function ($request, $response) {
        $gameController = new App\Controllers\GameController();
        
        $result = $gameController->create($request);
        return $response->withJson($result);
    }
);

$app->put(
    '/game/edit',
    function ($request, $response) {
        $gameController = new App\Controllers\GameController();
        
        $result = $gameController->edit($request);
        return $response->withJson($result); 
    }
);

$app->get(
    '/game/delete/{title}',
    function ($request, $response, $title) {
        $gameController = new App\Controllers\GameController();

        $result = $gameController->delete($title);
        return $response->withJson($result);
    }
);

$app->run();