<?php

namespace Tests\Feature;

use App\Services\UserService;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
    }

    public function testLoginSuccesss()
    {
        // var_dump($this->userService);
        $this->assertTrue($this->userService->login('groove', 'tes'));
    }

}
