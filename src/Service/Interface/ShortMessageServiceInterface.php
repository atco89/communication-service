<?php

namespace App\Service\Interface;

interface ShortMessageServiceInterface
{

    /**
     * @param string $from
     * @param string $to
     * @param string $text
     * @return string
     */
    public function sendSMS(string $from, string $to, string $text): string;
}