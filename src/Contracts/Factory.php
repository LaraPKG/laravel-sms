<?php

declare(strict_types=1);

namespace LaraPkg\LaravelSms\Contracts;

interface Factory
{
    public function driver(?string $driver = null): Provider;
}
