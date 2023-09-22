<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Facades\SMSGateway;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class VerifyUserPhone extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable): array
    {
        return [SmsChannel::class];
    }

    /**
     * Get the sms representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return bool
     */
    public function toSms($notifiable): bool
    {
        return SMSGateway::sendSMS(
            $notifiable->phone,
            sprintf(
                '%s doğrulama kodu ile kaydınızı tamamlayabilirsiniz.',
                $notifiable->phone_verify_code
            )
        );
    }
}
