<?php

declare(strict_types=1);

namespace LaraPkg\LaravelSms;

use Illuminate\Support\Manager;
use LaraPkg\LaravelSms\Exceptions\DefaultDriverException;

class SmsManager extends Manager
{
    /**
     * @return never
     * @throws DefaultDriverException
     */
    public function getDefaultDriver(): never
    {
        throw new DefaultDriverException('SmsManager may not be used without a driver.');
    }
}
