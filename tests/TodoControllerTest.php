<?php

use PHPUnit\Framework\TestCase;
use Slim\Http\Environment;
use Slim\Http\Request;
use Slim\Http\Response;

use App\Models\Todo;
use App\Controllers\TodoController;

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
class TodoControllerTest extends TestCase {

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

	public function testIndex() {

		$environment = Environment::mock([
			'REQUEST_METHOD' => 'GET',
			'REQUEST_URI'    => '/v1/todos',
			'SERVER_NAME'    => 'slim-api.test',
			'CONTENT_TYPE'   => 'application/json;charset=utf8'
		]);

		$request = Request::createFromEnvironment($environment);
		$response = new Response();

		$todoController = new TodoController;

		$response = $todoController->index($request, $response, []);

		$status_code = $response->getStatusCode();
		$data = json_decode($response->getBody(), true);

		$this->assertEquals(200, $status_code);

		$this->assertArrayHasKey('total', $data);
		$this->assertArrayHasKey('per_page', $data);
		$this->assertArrayHasKey('current_page', $data);
		$this->assertArrayHasKey('last_page', $data);
		$this->assertArrayHasKey('next_page_url', $data);
		$this->assertArrayHasKey('prev_page_url', $data);
		$this->assertArrayHasKey('data', $data);
	}

	public function testSave(){

		$environment = Environment::mock([
			'REQUEST_METHOD' => 'POST',
			'REQUEST_URI'    => '/v1/todos',
			'SERVER_NAME'    => 'slim-api.test',
			'CONTENT_TYPE'   => 'application/json;charset=utf8'
		]);

		$request = Request::createFromEnvironment($environment);
		$request = $request->withParsedBody([
			'name' => 'test'
		]);

		$response = new Response();

		$todoController = new TodoController;
		$response = $todoController->save($request, $response, []);

		$status_code = $response->getStatusCode();
		$this->assertEquals(201, $status_code);
	}

	public function testSaveWithoutName(){

		$environment = Environment::mock([
			'REQUEST_METHOD' => 'POST',
			'REQUEST_URI'    => '/v1/todos',
			'SERVER_NAME'    => 'slim-api.test',
			'CONTENT_TYPE'   => 'application/json;charset=utf8'
		]);

		$request = Request::createFromEnvironment($environment);

		$response = new Response();

		$todoController = new TodoController;
		$response = $todoController->save($request, $response, []);

		$status_code = $response->getStatusCode();
		$this->assertEquals(403, $status_code);
	}

	public function testUpdate(){

		$environment = Environment::mock([
			'REQUEST_METHOD' => 'PATCH',
			'REQUEST_URI'    => '/v1/todos/1',
			'SERVER_NAME'    => 'slim-api.test',
			'CONTENT_TYPE'   => 'application/json;charset=utf8'
		]);
		$request = Request::createFromEnvironment($environment);
		$request = $request->withParsedBody(['name'=>'test']);

		$response = new Response();

		$todoController = new TodoController;
		$response = $todoController->update($request, $response, ['id'=>'1']);

		$status_code = $response->getStatusCode();
		$this->assertEquals(204, $status_code);
	}

	public function testUpdateWithoutData(){

		$environment = Environment::mock([
			'REQUEST_METHOD' => 'PATCH',
			'REQUEST_URI'    => '/v1/todos',
			'SERVER_NAME'    => 'slim-api.test',
			'CONTENT_TYPE'   => 'application/json;charset=utf8'
		]);
		$request = Request::createFromEnvironment($environment);

		$response = new Response();

		$todoController = new TodoController;
		$response = $todoController->update($request, $response, []);

		$status_code = $response->getStatusCode();
		$this->assertEquals(403, $status_code);
	}

	public function testDelete(){

		$environment = Environment::mock([
			'REQUEST_METHOD' => 'DELETE',
			'REQUEST_URI'    => '/v1/todos/1',
			'SERVER_NAME'    => 'slim-api.test',
			'CONTENT_TYPE'   => 'application/json;charset=utf8'
		]);
		$request = Request::createFromEnvironment($environment);

		$response = new Response();

		$todoController = new TodoController;
		$response = $todoController->delete($request, $response, ['id'=>'1']);

		$status_code = $response->getStatusCode();
		$this->assertEquals(204, $status_code);
	}

	public function testDeleteWithoutId(){

		$environment = Environment::mock([
			'REQUEST_METHOD' => 'DELETE',
			'REQUEST_URI'    => '/v1/todos',
			'SERVER_NAME'    => 'slim-api.test',
			'CONTENT_TYPE'   => 'application/json;charset=utf8'
		]);
		$request = Request::createFromEnvironment($environment);

		$response = new Response();

		$todoController = new TodoController;
		$response = $todoController->delete($request, $response, []);

		$status_code = $response->getStatusCode();
		$this->assertEquals(403, $status_code);
	}

}
