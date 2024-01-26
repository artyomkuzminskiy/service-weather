<?php

namespace App\Providers;

use App\Repositories\Telegram\TelegramHttpRepository;
use App\Repositories\Telegram\TelegramRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TelegramRepositoryInterface::class, TelegramHttpRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
