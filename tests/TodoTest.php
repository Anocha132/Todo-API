<?php

use PHPUnit\Framework\TestCase;
use App\Services\TodoService;

class TodoTest extends TestCase {

	public function testGet () {
		$TodoService = new TodoService;

		$response = $TodoService->get();

		$this->assertArrayHasKey('total', $response);
		$this->assertArrayHasKey('per_page', $response);
		$this->assertArrayHasKey('current_page', $response);
		$this->assertArrayHasKey('last_page', $response);
		$this->assertArrayHasKey('next_page_url', $response);
		$this->assertArrayHasKey('prev_page_url', $response);
		$this->assertArrayHasKey('data', $response);
	}

}