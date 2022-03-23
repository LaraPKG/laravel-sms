<?php

declare(strict_types=1);

namespace Unit\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
use LaraPkg\LaravelSms\LaravelSmsServiceProvider;
use Orchestra\Testbench\TestCase;

class LaravelSmsServiceProviderTest extends TestCase
{
    /**
     * @throws BindingResolutionException
     */
    public function testRegister(): void
    {
        $provider = app()->make(LaravelSmsServiceProvider::class, ['app' => app()]);

        try {
            $provider->register();
            $this->assertTrue(true);
        } catch (\Exception $exception) {
            $this->fail("Exception thrown testing register method: {$exception->getMessage()}");
        }
    }

    /**
     * @throws BindingResolutionException
     */
    public function testBoot(): void
    {
        $provider = app()->make(LaravelSmsServiceProvider::class, ['app' => app()]);

        try {
            $provider->boot();
            $this->assertTrue(true);
        } catch (\Exception $exception) {
            $this->fail("Exception thrown testing boot method: {$exception->getMessage()}");
        }
    }
}
