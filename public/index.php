<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Database information
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

$todoService = new App\Services\TodoService;

$app = new Slim\App();

$app->get('/v1/todos', App\Controllers\TodoController::class.':index');

$app->post('/v1/todos', App\Controllers\TodoController::class.'save' );

$app->patch('/v1/todos/{id}', App\Controllers\TodoController::class.'update');

$app->delete('/v1/todos/{id}', App\Controllers\TodoController::class.'delete');

$app->run();
