<?php
namespace App\Services\Impl;

use App\Services\TodoListService;
use Illuminate\Support\Facades\Session;

class TodoListImpl implements TodoListService
{
    public function saveTodo(string $id, string $todo): TodoListService
    {
        if (!Session::exists('todolist')) {
            Session::put('todolist', []);

        };
        Session::push('todolist', ['id' => $id, 'todo' => $todo]);
        return $this;
    }

    public function getTodoList(): array
    {
        return Session::get('todolist', []);
    }

    public function removeTodo(string $id): void
    {
        $todoList = Session::get('todolist');
        foreach ($todoList as $index => $list) {
            if ($list['id'] == $id) {
                unset($todoList[$index]);
                break;
            }
        }
        Session::put('todolist', $todoList);
    }

}
