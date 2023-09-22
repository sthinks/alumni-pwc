<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Facades\SMSGateway;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetUserPassword extends Notification
{
    use Queueable;

    /**
     * @var string Link to reset password
     */
    private string $link;

    /**
     * Create a new notification instance.
     *
     * @param string $token Token generated for resetting password
     *
     * @return void
     */
    public function __construct(string $token)
    {
        $this->link = route('password.reset', $token);
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
                'Sayın %s, %s linkine tıklayarak şifrenizi sıfırlayabilirsiniz.',
                $notifiable->name,
                $this->link
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
            ->view('email.verification.resetpw', ['user' => $notifiable, 'token' => $this->link])
            ->subject('Şifre Sıfırlama');
    }
}
