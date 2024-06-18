<?php

namespace App\Service;

use App\Service\Interface\ShortMessageServiceInterface;

class SmsSender implements ShortMessageServiceInterface
{

    /**
     * @param string $from
     * @param string $to
     * @param string $text
     * @return string
     */
    public function sendSMS(string $from, string $to, string $text): string
    {
        return "Sending SMS using <strong>SMS SENDER</strong> from [$from] to [$to], with text [$text]";
    }
}