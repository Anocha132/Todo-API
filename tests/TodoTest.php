<?php

use PHPUnit\Framework\TestCase;
use App\Services\TodoService;
use App\Models\Todo;

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
class TodoTest extends TestCase {

	public static function setUpBeforeClass() {
		$todoSchema = new \Schema\Todo;
		$todoSchema->create();

		Todo::create(['name' => 'name 1', 'status' => true]);
		Todo::create(['name' => 'name 2', 'status' => true]);
		Todo::create(['name' => 'name 3', 'status' => true]);
	}

	public static function tearDownAfterClass() {
		$todoSchema = new \Schema\Todo;
		$todoSchema->drop();
	}

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

	public function testSave() {
		$params = ['name' => 'todo 1'];

		$TodoService = new TodoService;
		$saved = $TodoService->save($params);

		$this->assertTrue($saved);
	}

	public function testSaveWithoutName() {
		$params = ['name' => ''];

		$TodoService = new TodoService;
		$saved = $TodoService->save($params);

		$this->assertFalse($saved);
	}

	public function testUpdate(){
		$params = ['name' => ''];
		$id = 1;

		$TodoService = new TodoService;
		$update = $TodoService->update($id, $params);

		$this->assertTrue($update);
	}

	public function testUpdateWithoutName(){
		$params = ['name' => ''];
		$id = 1;

		$TodoService = new TodoService;
		$update = $TodoService->update($id, $params);

		$this->assertTrue($update);
	}

	public function testDelete(){

		$TodoService = new TodoService;
		$delete = $TodoService->delete(1);

		$this->assertTrue($delete);
	}

}
