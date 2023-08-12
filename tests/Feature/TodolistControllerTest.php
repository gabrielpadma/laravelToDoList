<?php

namespace Tests\Feature;

use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodoList()
    {
        $this->withSession(['user' => 'groove', 'todolist' => ['id' => '1', 'todo' => 'gw']])->get('/todolist')->assertSeeText('1')->assertSeeText('gw');
    }
}
