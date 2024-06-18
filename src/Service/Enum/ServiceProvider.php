<?php

namespace App\Service\Enum;

enum ServiceProvider: string
{

    case CALLER = 'caller';

    case CHEAP_SMS_AND_CALLS = 'cheap_sms_and_calls';

    case SMS_SENDER = 'sms_sender';
}