<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Event;
use App\Facades\SMSGateway;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserInvitedForEvent extends Notification
{
    use Queueable;

    /**
     * @var Event the event which user got invited
     */
    private Event $event;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
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
        return ['mail', 'database', SmsChannel::class];
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
            ->view('email.event.invite', ['user' => $notifiable, 'event' => $this->event])
            ->subject(sprintf(
                '%s etkinliğine davet edildiniz.',
                $this->event->event_title
            ));
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toDatabase($notifiable): array
    {
        return [
            'message' => sprintf(
                'Sayın %s, %s etkinliğine davet edildiniz.',
                $notifiable->name,
                $this->event->event_title
            ),
            'link' => route('events.show', $this->event->event_seo_url),
        ];
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
                'Sayın %s, %s etkinliğine davet edildiniz.',
                $notifiable->name,
                $this->event->event_title
            )
        );
    }
}
