<?php

use App\Controllers\HomeController;
use App\Controllers\UserController;

define("CREATE_UPDATE_FUNCTION", 'createOrUpdate');

$app->get('/', HomeController::class . ':index');

$app->group('/users', function () {
    $this->post('', UserController::class . ':'.CREATE_UPDATE_FUNCTION);
    $this->put('/{id}', UserController::class . ':'.CREATE_UPDATE_FUNCTION);
});
