<?php

declare(strict_types=1);

namespace LaraPkg\LaravelSms\Facades;

use Illuminate\Support\Facades\Facade;
use LaraPkg\LaravelSms\SmsManager;

/**
 * @method driver(?string $driver): LaraPkg\LaravelSms\Contracts\\Provider
 * @method from(string $from): LaraPkg\LaravelSms\Contracts\\Provider
 * @method destination(int $destination): LaraPkg\LaravelSms\Contracts\\Provider
 * @method send(string $message): bool
 */
class Sms extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return SmsManager::class;
    }
}
