<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Facades\SMSGateway;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserNotApproved extends Notification
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
        return ['mail', SmsChannel::class];
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
            ->view('email.verification.usernotapproved', ['user' => $notifiable])
            ->subject('Üyeliğiniz onaylanmamıştır');
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
                'Sayın %s, 6 ay ve üzeri çalışma kaydınız bulunamamıştır.Üyeliğiniz onaylanamamıştır.',
                $notifiable->name
            )
        );
    }
}
