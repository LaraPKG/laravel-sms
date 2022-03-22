<?php

declare(strict_types=1);

namespace LaraPkg\LaravelSms\Facades;

use Illuminate\Support\Facades\Facade;
use LaraPkg\LaravelSms\SmsManager;

class Sms extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return SmsManager::class;
    }
}
