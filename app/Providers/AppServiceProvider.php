<?php

namespace App\Providers;

use App\Services\BookSearchService;
use App\Services\BookSearchServiceInterface;
use App\Services\BookService;
use App\Services\BookServiceInterface;
use App\Services\ReviewService;
use App\Services\ReviewServiceInterface;
use App\Services\UserService;
use App\Services\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BookSearchServiceInterface::class,BookSearchService::class);
        $this->app->bind(BookServiceInterface::class,      BookService::class);
        $this->app->bind(ReviewServiceInterface::class,    ReviewService::class);
        $this->app->bind(UserServiceInterface::class,      UserService::class);
    }
}
