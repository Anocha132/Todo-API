<?php

namespace Schema;

use Illuminate\Database\Capsule\Manager as Database;

class Todo implements SchemaTemplate {

	public function create() {
		if(Database::schema()->hasTable('todos')) return;

		Database::schema()->create('todos', function($table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->boolean('status')->default(0);
			$table->timestamps();
		});
	}

	public function drop() {
		Database::schema()->dropIfExists('todos');
	}

}
