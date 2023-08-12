<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')->assertSeeText('Login');
    }

    public function testLoginSuccess()
    {
        $this->post(
            '/login', ['user' => 'groove', 'password' => 'tes']
        )->assertRedirect('/')->assertSessionHas('user', 'groove');
    }

    public function testLoginValidationError()
    {
        $this->post('/login', [])->assertSeeText('User or Password is required');
    }

    public function testLoginFailed()
    {
        $this->post('/login', ['user' => 'afsd', 'password' => 'afsd'])->assertSeeText('User or password wrong');
    }

    public function testLogout()
    {
        $this->withSession(['user' => 'groove'])->post('/logout')->assertRedirect('/')->assertSessionMissing('user');
    }

    public function testLoginPageMember()
    {
        $this->withSession(['user' => 'groove']);
        $this->get('/login')->assertRedirect('/');
    }

    public function testUserAlreadyLoggedin()
    {
        $this->withSession(['user' => 'groove'])->post('/login', ['user' => 'groove', 'password' => 'tes'])->assertRedirect('/');
    }

}
