<?php

declare(strict_types=1);

namespace LaraPkg\LaravelSms\Factories;

use Illuminate\Contracts\Container\BindingResolutionException;
use LaraPkg\LaravelSms\Contracts\Provider;
use LaraPkg\LaravelSms\Providers\DummyProvider;
use LaraPkg\LaravelSms\Contracts\ProviderFactory;

use function app;

class DummyFactory implements ProviderFactory
{
    /**
     * @inheritDoc
     *
     * @throws BindingResolutionException
     */
    public function createDriver(): Provider
    {
        return app()->make(DummyProvider::class);
    }
}
