<?php

declare(strict_types=1);

return [
    'default_driver' => 'dummy',

    'drivers' => [
        'dummy' => \LaraPkg\LaravelSms\Factories\DummyFactory::class
    ]
];
