<?php

declare(strict_types=1);

namespace LaraPkg\LaravelSms\Contracts;

interface ProviderFactory
{
    public function createDriver(): Provider;
}
