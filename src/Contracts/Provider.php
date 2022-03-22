<?php

declare(strict_types=1);

namespace LaraPkg\LaravelSms\Contracts;

interface Provider
{
    public function from(string $from): Provider;

    public function destination(int $destination): Provider;

    public function send(string $message): bool;
}
