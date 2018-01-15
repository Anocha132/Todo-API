<?php

namespace Schema;

interface SchemaTemplate {

	public function create();
	public function drop();

}
