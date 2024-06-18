<?php

namespace App\Service;

use App\Service\Interface\ShortMessageServiceInterface;

class CheapSmsAndCalls implements ShortMessageServiceInterface
{

    /**
     * @param string $from
     * @param string $to
     * @return string
     */
    public function call(string $from, string $to): string
    {
        return "Starting a call using <strong>CHEAP SMS AND CALLS</strong> from [$from] to [$to].";
    }

    /**
     * @param string $from
     * @param string $to
     * @param string $text
     * @return string
     */
    public function sendSMS(string $from, string $to, string $text): string
    {
        return "Sending SMS using <strong>CHEAP SMS AND CALLS</strong> from [$from] to [$to], with text [$text]";
    }
}