<?php

require_once __DIR__.'/../vendor/autoload.php';

$settings = [
    'driver' => 'sqlite',
    'host' => '',
    'database' => ':memory:',
    'username' => '',
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
