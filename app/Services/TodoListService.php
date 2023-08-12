<?php

namespace App\Services;

interface TodoListService
{
    public function saveTodo(string $id, string $todo): TodoListService;
    public function getTodoList(): array;
    public function removeTodo(string $id): void;

}
