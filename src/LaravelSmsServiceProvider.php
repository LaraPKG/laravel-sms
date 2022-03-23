<?php

declare(strict_types=1);

namespace LaraPkg\LaravelSms;

use Illuminate\Support\ServiceProvider;

use function sprintf;
use function dirname;

class LaravelSmsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->publishes(
            [
                $this->getPackagePath('config/laravel-sms.php') => config_path('laravel-sms.php'),
            ],
        );
    }

    public function boot(): void
    {
        $this->mergeConfigFrom(
            $this->getPackagePath('config/laravel-sms.php'), 'laravel-sms',
        );
    }

    private function getPackagePath(?string $path = null): string
    {
        return sprintf('%s/%s', dirname(__DIR__), $path);
    }
}
