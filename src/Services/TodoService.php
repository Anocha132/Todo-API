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

	public function update($id, Array $params){

		if(!isset($params['name']) && !isset($params['status'])) return false;

		$todo = Todo::find($id);

		if (is_null($todo)) {
			return false;
		}

		if(isset($params['name'])) $todo->name = $params['name'];
		if(isset($params['status'])) $todo->status = $params['status'];

		$saved = $todo->save();

		return $saved;

	}

	public function delete($id){
		$todo = Todo::find($id);

		if (is_null($todo)) {
			return false;
		}

		$deleted = $todo->delete();

		return $deleted;
	}

}