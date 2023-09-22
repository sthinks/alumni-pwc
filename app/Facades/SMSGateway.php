<?php

namespace App\Facades;

use App\Services\Contracts\SMSServiceContract;
use Illuminate\Support\Facades\Facade;

/**
 *  @method static sendSMS($phone, $message)
 */
class SMSGateway extends Facade
{
    /**
     * Get registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return SMSServiceContract::class;
    }
}
