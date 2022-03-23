<?php

declare(strict_types=1);

namespace Tests\Unit\Managers;

use Config;
use Illuminate\Contracts\Container\BindingResolutionException;
use LaraPkg\LaravelSms\Contracts\ProviderFactory;
use LaraPkg\LaravelSms\Facades\Sms;
use LaraPkg\LaravelSms\Factories\DummyFactory;
use LaraPkg\LaravelSms\Providers\DummyProvider;
use LaraPkg\LaravelSms\SmsManager;
use Orchestra\Testbench\TestCase;
use ReflectionException;
use ReflectionMethod;

class SmsManagerTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        Config::set('laravel-sms', [
            'default_driver' => 'dummy',
            'drivers' => [
                'dummy' => \LaraPkg\LaravelSms\Factories\DummyFactory::class
            ]
        ]);
    }

    /**
     * @throws BindingResolutionException
     */
    public function testGetDefaultDriver(): void
    {
        $manager = app()->make(SmsManager::class);

        $provider = $manager->getDefaultDriver();

        $this->assertSame('dummy', $provider);
    }

    public function testGetManager(): void
    {
        $manager = Sms::driver('dummy');

        $this->assertInstanceOf(DummyProvider::class, $manager);
    }

    /**
     * @throws ReflectionException
     */
    public function testFindConfiguredDriver(): void
    {
        $reflectionMethod = new ReflectionMethod(SmsManager::class, 'findConfiguredDriver');
        $reflectionMethod->setAccessible(true);
        $result = $reflectionMethod->invoke(new SmsManager(app()), 'dummy');

        $this->assertSame(DummyFactory::class, $result);
    }

    /**
     * @throws ReflectionException
     * @throws BindingResolutionException
     */
    public function testBuildDriver(): void
    {
        $reflectionMethod = new ReflectionMethod(SmsManager::class, 'findConfiguredDriver');
        $reflectionMethod->setAccessible(true);
        $result = $reflectionMethod->invoke(new SmsManager(app()), 'dummy');

        $factory = app()->make($result);

        $reflectionMethod = new ReflectionMethod(SmsManager::class, 'buildDriver');
        $reflectionMethod->setAccessible(true);
        $provider = $reflectionMethod->invoke(new SmsManager(app()), $factory);

        $this->assertInstanceOf(DummyProvider::class, $provider);
    }

    public function testCreateFactory(): void
    {
        $reflectionMethod = new ReflectionMethod(SmsManager::class, 'findConfiguredDriver');
        $reflectionMethod->setAccessible(true);
        $result = $reflectionMethod->invoke(new SmsManager(app()), 'dummy');

        $reflectionMethod = new ReflectionMethod(SmsManager::class, 'createFactory');
        $reflectionMethod->setAccessible(true);
        $factory = $reflectionMethod->invoke(new SmsManager(app()), $result);

        $this->assertInstanceOf(DummyFactory::class, $factory);
    }

    public function testFindConfiguredDriverExcepts(): void
    {
        try {
            $reflectionMethod = new ReflectionMethod(SmsManager::class, 'findConfiguredDriver');
            $reflectionMethod->setAccessible(true);
            $result = $reflectionMethod->invoke(new SmsManager(app()), 'wrong');
            $this->fail('Exception expected but not received.');
        } catch (\Throwable $exception) {
            $this->assertTrue(true);
        }
    }
}
