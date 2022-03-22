<?php

declare(strict_types=1);

namespace LaraPkg\LaravelSms\Providers;

use LaraPkg\LaravelSms\Contracts\Provider;

class DummyProvider implements Provider
{
    private ?string $from;

    private ?int $destination;

    public function from(string $from): Provider
    {
        $this->from = $from;

        return $this;
    }

    public function destination(int $destination): Provider
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     */
    public function send(string $message): bool
    {
        return true;
    }
}
