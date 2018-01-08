<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Slim\App();

$app->get('/v1/todos', function($req, $res, $args) {
  return $res->withJson([
  'total' => 0,
  'per_page' => 0,
  'current_page' => 0,
  'last_page' => 0,
  'first_page_url' => 'string',
  'last_page_url' => 'string',
  'next_page_url' => 'string',
  'prev_page_url' => 'string',
  'path' => 'string',
  'from' => 0,
  'to' => 0,
  'data' => [
    [
      "id"=> 0,
      "name"=> "string",
      "status"=> true,
      "created_at"=> "2018-01-08T07:48:11.609Z",
      "updated_at"=> "2018-01-08T07:48:11.609Z"
    ]
  ]]);
});

$app->post('/v1/todos', function($req, $res, $args) {
  return $res->withStatus(201);
});

$app->patch('/v1/todos/{id}', function($req, $res, $args) {
  return $res->withStatus(204);
});

$app->delete('/v1/todos/{id}', function($req, $res, $args) {
  return $res->withStatus(204);
});

$app->run();
