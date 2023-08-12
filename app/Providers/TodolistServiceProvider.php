<?php

namespace App\Providers;

use App\Services\Impl\TodoListImpl;
use App\Services\TodoListService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TodolistServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public $singletons = [TodoListService::class => TodoListImpl::class];

    public function provides()
    {
        return [TodoListService::class];
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
