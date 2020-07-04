<?php

use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Middleware\AuthenticateMiddleware;

define("CREATE_UPDATE_FUNCTION", 'createOrUpdate');

$app->get('/', HomeController::class . ':index');

// Authenticated API's
$app->group('/api/v1', function () {
    $this->group('/users', function () {
        $this->post('', UserController::class . ':'.CREATE_UPDATE_FUNCTION);
        $this->put('/{id}', UserController::class . ':'.CREATE_UPDATE_FUNCTION);
    });
})->add(new AuthenticateMiddleware($container->get('settings')->all()));
