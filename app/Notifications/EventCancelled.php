<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Event;
use App\Facades\SMSGateway;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventCancelled extends Notification
{
    use Queueable;

    /**
     * @var Event Cancelled event
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
            ->view('email.event.cancelled', ['user' => $notifiable, 'event' => $this->event])
            ->subject(sprintf(
                '%s etkinliği iptal edilmiştir.',
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
                'Sayın, %s, %s etkinliği iptal edilmiştir',
                $notifiable->name,
                $this->event->event_title
            ),
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
                'Sayın %s, %s etkinliğimiz ileri bir tarihe ertelenmiştir.',
                $notifiable->name,
                $this->event->event_title
            )
        );
    }
}
