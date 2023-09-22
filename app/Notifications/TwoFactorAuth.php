<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Facades\SMSGateway;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TwoFactorAuth extends Notification
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
        if ($notifiable->hasVerifiedEmail()) {
            return [SmsChannel::class, 'mail'];
        }
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
                'Sayın %s, %s doğrulama kodu ile giriş yapabilirsiniz.',
                $notifiable->name,
                $notifiable->two_factor_code
            )
        );
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->view('email.verification.twofactor', ['user' => $notifiable])
            ->subject('İki aşamalı doğrulama');
    }
}
