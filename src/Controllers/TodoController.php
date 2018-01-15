<?php

namespace App\Controllers;

use App\Services\TodoService;

class TodoController {

	public function __construct() {
		$this->todoService = new TodoService;
	}

	public function index($req , $res , $args) {
		$page = (int) $req->getParam('page');
		$path = (string) $req->getUri()->withQuery('');
		$todos = $this->todoService->get($page, $path);

		return $res->withJson($todos);
	}

	public function save($req , $res , $args) {
		$params = $req->getParams();

		$saved = $this->todoService->save($params);

		return $saved ? $res->withStatus(201) : $res->withStatus(403);
	}

	public function update($req , $res , $args) {
		$params = $req->getParams();
		$id = isset($args['id']) ? $args['id'] : null;

		$saved = $this->todoService->update($id, $params);

		return $saved ? $res->withStatus(204) : $res->withStatus(403);
	}

	public function delete($req , $res , $args) {
		$id = isset($args['id']) ? $args['id'] : null;

		$saved = $this->todoService->delete($id);

		return $saved ? $res->withStatus(204) : $res->withStatus(403);
	}


}
