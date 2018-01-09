<?php

namespace App\Services;

use App\Models\Todo;

class TodoService {

	public function get($page = null) {
		$todo = [
			'total' => 0,
			'per_page' => 0,
			'current_page'=> 0,
			'last_page' => 0,
			'first_page_url' => 'string',
			'last_page_url' => 'string',
			'next_page_url' => 'string',
			'prev_page_url' => 'string',
			'data' => [
				[
					'id' => 0,
					'name' => 'string',
					'status' => true,
					'created_at' => '2018-01-08T07:48:11.609Z',
					'updated_at' => '2018-01-08T07:48:11.609Z'
				]
			]
		];

		return $todo;
	}

}