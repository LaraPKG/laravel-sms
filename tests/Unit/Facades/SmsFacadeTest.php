<?php

declare(strict_types=1);

namespace Unit\Facades;

use LaraPkg\LaravelSms\Facades\Sms;
use LaraPkg\LaravelSms\SmsManager;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

class SmsFacadeTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testFacadeAccessor(): void
    {
        $reflectionMethod = new ReflectionMethod(Sms::class, 'getFacadeAccessor');
        $reflectionMethod->setAccessible(true);
        $result = $reflectionMethod->invoke(new Sms);

        $this->assertIsString($result);
        $this->assertSame(SmsManager::class, $result);
    }
}
