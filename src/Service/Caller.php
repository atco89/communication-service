<?php

namespace App\Service;

class Caller
{

    /**
     * @param string $from
     * @param string $to
     * @return string
     */
    public function startCall(string $from, string $to): string
    {
        return "Starting a call using <strong>CALLER</strong> from [$from] to [$to].";
    }
}