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

$app->get('/v1/todos', function($req, $res, $args) use ($todoService) {

	$page = (int) $req->getParam('page');
	$path = (string) $req->getUri()->withQuery('');
	$todos = $todoService->get($page, $path);

	return $res->withJson($todos);
});

$app->post('/v1/todos', function($req, $res, $args) use ($todoService) {
	$params = $req->getParams();

	$saved = $todoService->save($params);

	return $saved ? $res->withStatus(201) : $res->withStatus(403);
});

$app->patch('/v1/todos/{id}', function($req, $res, $args) {
	$params = $req->getParams();
	$id = $args['id'];

	if(!isset($params['name']) && !isset($params['status'])) return $res->withStatus(403);

	$todo = App\Models\Todo::find($id);

	if (is_null($todo)) return $res->withStatus(404);

	if(isset($params['name']))$todo->name = $params['name'];
	if(isset($params['status']))$todo->status = $params['status'];
	$todo->save();

	return $res->withStatus(204);
});

$app->delete('/v1/todos/{id}', function($req, $res, $args) {
	$id = $args['id'];

	$todo = App\Models\Todo::find($id);

	if (is_null($todo)) return $res->withStatus(404);

	$todo->delete();

	return $res->withStatus(204);
});

$app->run();
