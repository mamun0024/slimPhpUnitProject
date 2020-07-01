<?php
/**
 * Created by PhpStorm.
 */

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection($container['settings']['db']);

$capsule->bootEloquent();
$capsule->setAsGlobal();

$container['dbCon'] = function () use ($capsule) {
    return $capsule->getConnection();
};
