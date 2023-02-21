<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChangeEventRegistration extends Notification
{
    use Queueable;

    protected $url;

    protected $event;

    protected $status;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($event, $status, $url)
    {
        $this->event = $event->name;
        $this->status = $status->name;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     */
    public function toArray($notifiable): array
    {
        return [
            'type' => 'registration',
            'title' => $this->event,
            'message' => 'The organizer has changed the status of your registration to: ',
            'link' => true,
            'url' => $this->url,
            'status' => $this->status,
        ];
    }
}
