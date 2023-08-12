<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function testGuest()
    {
        $this->get('/')->assertRedirect('/login');
    }

    public function testMember()
    {
        $this->get('/')->assertRedirect('/todolist');
    }
}
