<?php

declare(strict_types=1);

namespace LaraPkg\LaravelSms;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Manager;
use InvalidArgumentException;
use LaraPkg\LaravelSms\Contracts\Factory;
use LaraPkg\LaravelSms\Contracts\Provider;
use LaraPkg\LaravelSms\Contracts\ProviderFactory;
use LaraPkg\LaravelSms\Exceptions\NotImplemented;
use LaraPkg\LaravelSms\Exceptions\UnConfiguredDriver;

use function assert;
use function method_exists;
use function in_array;
use function sprintf;

class SmsManager extends Manager implements Factory
{
    /**
     * Get a driver instance.
     *
     * @throws BindingResolutionException
     * @throws NotImplemented
     * @throws UnConfiguredDriver
     */
    public function driver($driver = null): Provider
    {
        $driver ??= $this->getDefaultDriver();

        $factoryClass = $this->findConfiguredDriver($driver);

        if (!isset($this->drivers[$driver])) {
            $factory = $this->createFactory($factoryClass);
            $this->drivers[$driver] = $this->buildDriver($factory);
        }

        return $this->drivers[$driver];
    }

    public function getDefaultDriver(): string
    {
        return config('laravel-sms.default_driver', null);
    }

    /**
     * @throws BindingResolutionException
     */
    protected function createFactory(string $factoryClass): ProviderFactory
    {
        $factory = app()->make($factoryClass);

        assert(
            $factory instanceof ProviderFactory,
            'Driver must implement LaraPkg\\LaravelSms\\Contracts\\ProviderFactory.',
        );

        return $factory;
    }

    /**
     * Create a new driver instance.
     *
     * @throws InvalidArgumentException
     * @throws NotImplemented
     */
    protected function buildDriver(ProviderFactory $factory): Provider
    {
        return $factory->createDriver();
    }

    /**
     * @throws UnConfiguredDriver
     */
    protected function findConfiguredDriver(string $driver): ?string
    {
        $configuredDrivers = config('laravel-sms.drivers', []);

        if (!array_key_exists($driver, $configuredDrivers)) {
            throw new UnConfiguredDriver(sprintf('Driver not configured [%s].', $driver));
        }

        return $configuredDrivers[$driver];
    }
}
