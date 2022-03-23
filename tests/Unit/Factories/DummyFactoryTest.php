<?php

declare(strict_types=1);

namespace Unit\Factories;

use Illuminate\Contracts\Container\BindingResolutionException;
use LaraPkg\LaravelSms\Factories\DummyFactory;
use LaraPkg\LaravelSms\Providers\DummyProvider;
use PHPUnit\Framework\TestCase;
use LaraPkg\LaravelSms\Contracts\Provider;

class DummyFactoryTest extends TestCase
{
    /**
     * @throws BindingResolutionException
     */
    public function testDummyProviderCreated(): void
    {
        $provider = app()->make(DummyFactory::class)->createDriver();

        $this->assertInstanceOf(DummyProvider::class, $provider);
    }
}
