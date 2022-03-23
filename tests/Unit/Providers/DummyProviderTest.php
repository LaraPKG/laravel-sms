<?php

declare(strict_types=1);

namespace Unit\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
use LaraPkg\LaravelSms\Providers\DummyProvider;
use PHPUnit\Framework\TestCase;

class DummyProviderTest extends TestCase
{
    /**
     * @throws BindingResolutionException
     */
    public function testDummyProvider(): void
    {
        $provider = app()->make(DummyProvider::class);

        $provider = $provider->destination(447562509988);

        $this->assertInstanceOf(DummyProvider::class, $provider);

        $provider = $provider->from('Test');

        $this->assertInstanceOf(DummyProvider::class, $provider);

        $result = $provider->send('Test send.');

        $this->assertTrue($result);
    }
}
