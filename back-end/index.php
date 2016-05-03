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

$app->run();