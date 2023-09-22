<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Facades\SMSGateway;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserApproved extends Notification
{
    use Queueable;

    /**
     * @var string Link where approved users will be redirected to
     */
    private string $link;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->link = route('profile.index');
    }

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
            ->view('email.verification.userapproved', ['user' => $notifiable])
            ->subject('Üyeliğiniz onaylandı');
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
                'Sayın %s, üyeliğiniz onaylandı. %s linkinden siteye erişim sağlayabilirsiniz.',
                $notifiable->name,
                $this->link
            )
        );
    }
}
