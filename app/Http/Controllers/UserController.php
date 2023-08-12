<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(): Response
    {
        $data = ['title' => 'login'];
        return response()->view('user.login', $data);
    }
    public function doLogin(Request $request): Response | RedirectResponse
    {
        $username = $request->input('user');
        $password = $request->input('password');
        $data = ['title' => 'Login', 'error' => 'User or Password is required'];
        if (empty($username || $password)) {
            return response()->view('user.login', $data);
        };
        if ($this->userService->login($username, $password)) {
            $request->session()->put('user', $username);
            return redirect('/');
        }
        return response()->view('user.login', ['title' => 'Login', 'error' => 'User or password wrong']);
    }
    public function doLogout(Request $request): RedirectResponse
    {
        $request->session()->forget('user');
        return redirect('/');
    }
}
