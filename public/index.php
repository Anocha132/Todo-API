<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Slim\App();

$app->get('/v1/todos', function($req, $res, $args) {
  return $res->withJson(['message' => 'get todo']);
});

$app->post('/v1/todos', function($req, $res, $args) {
  return $res->withJson(['message' => 'post todo']);
});

$app->patch('/v1/todos/{id}', function($req, $res, $args) {
  return $res->withJson(['message' => 'patch todo ' . $args['id']]);
});

$app->delete('/v1/todos/{id}', function($req, $res, $args) {
  return $res->withJson(['message' => 'delete todo ' . $args['id']]);
});

$app->run();
