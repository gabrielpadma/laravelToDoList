<?php

namespace App\Http\Controllers;

use App\Services\TodoListService;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    private TodoListService $todoListObj;

    public function __construct(TodoListService $todoObj)
    {
        $this->todoListObj = $todoObj;
    }

    public function todolist(Request $req)
    {
        //  $this->todoListObj->saveTodo('1', 'gw')->saveTodo('2', 'gw');
        $data = ['title' => 'Todolist', 'todolist' => $this->todoListObj->getTodoList()];
        return response()->view('todolist.todolist', $data);
    }

    public function addTodo(Request $req)
    {

        $todo = $req->input('todo');
        if (empty($todo)) {
            $data = ['title' => 'Todolist', 'todolist' => $this->todoListObj->getTodoList(), 'error' => 'Todo is required'];
            return response()->view('todolist.todolist', $data);
        }

        $this->todoListObj->saveTodo(uniqid(), $todo);
        return redirect()->action([TodoListController::class, 'todolist']);
    }

    public function removeTodo(Request $req, string $id)
    {
        $this->todoListObj->removeTodo($id);
        return redirect('/todolist');
    }

}
