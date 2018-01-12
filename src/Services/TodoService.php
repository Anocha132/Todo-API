<?php

namespace App\Services;

use App\Models\Todo;

class TodoService {

	public function get($page = null, $path = null) {
		$todos = Todo::orderBy('created_at', 'desc')->paginate(15, ['*'], 'page', $page);

		if($path) $todos->setPath((string) $path);

		$todos = $todos->toArray();

		return $todos;
	}

	public function save(Array $params) {
		$params = array_filter($params);
		if(!isset($params['name'])) return false;

		$todo = new Todo;
		$todo->name = $params['name'];
		$saved = $todo->save();

		return $saved;
	}

}