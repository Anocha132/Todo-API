<?php

require_once __DIR__.'/../vendor/autoload.php';

$settings = [
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'database' => 'todo-api',
    'username' => 'root',
    'password' => '',
    'collation' => 'utf8_general_ci',
    'prefix' => ''
];

// Bootstrap Eloquent ORM
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($settings);
$capsule->setEventDispatcher(new Illuminate\Events\Dispatcher(new Illuminate\Container\Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();