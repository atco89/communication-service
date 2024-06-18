<?php

namespace App\Service\Factory;

use App\Service\CheapSmsAndCalls;
use App\Service\Enum\ServiceProvider;
use App\Service\Interface\ShortMessageServiceInterface;
use App\Service\SmsSender;
use InvalidArgumentException;

class SmsFactory
{

    /**
     * @param ServiceProvider|null $serviceProvider
     * @return ShortMessageServiceInterface
     */
    public static function build(ServiceProvider|null $serviceProvider): ShortMessageServiceInterface
    {
        return match ($serviceProvider) {
            ServiceProvider::SMS_SENDER => new SmsSender(),
            ServiceProvider::CHEAP_SMS_AND_CALLS => new CheapSmsAndCalls(),
            default => throw new InvalidArgumentException(message: 'Invalid service provider!'),
        };
    }
}