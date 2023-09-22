<?php

namespace App\Services\Contracts;

/**
 * Interface for sms services
 */
interface SMSServiceContract
{
    public function sendSMS($phone, $message);
}
