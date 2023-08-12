<?php

namespace Tests\Feature;

use App\Services\TodoListService;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodoListServiceTest extends TestCase
{
    private TodoListService $todoListObj;
    protected function setUp(): void
    {
        parent::setUp();
        $this->todoListObj = $this->app->make(TodoListService::class);
    }

    public function testTodoListNotNull()
    {
        $this->assertNotNull($this->todoListObj);
    }

    public function testSaveTodo()
    {

        $this->todoListObj->saveTodo('1', 'gw');
        $todolistData = Session::get('todolist');
        var_dump($todolistData);

        foreach ($todolistData as $data) {
            $this->assertEquals('1', $data['id']);
            $this->assertEquals('gw', $data['todo']);
        }
    }

    public function testGetTodoListempty()
    {
        $this->assertEquals([], $this->todoListObj->getTodoList());

    }
    public function testGetTodoListNotempty()
    {
        $expected = [['id' => '1', 'todo' => 'gw'], ['id' => 2, 'todo' => 'gw2']];
        $this->todoListObj->saveTodo('1', 'gw')->saveTodo('2', 'gw2');

        $this->assertEquals($expected, $this->todoListObj->getTodoList());

    }

    public function testRemoveTodo()
    {

        $this->todoListObj->saveTodo('1', 'gw')->saveTodo('2', 'gw2');
        $this->todoListObj->removeTodo('1');
        $todoData = $this->todoListObj->getTodoList();

        $this->assertequals(1, sizeof($todoData));
    }

}
