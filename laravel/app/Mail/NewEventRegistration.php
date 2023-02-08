<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewEventRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;

    public $event;

    public $organization;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($registration, $event)
    {
        $this->registration = $registration;
        $this->event = $event;
        $this->organization = $event->organization;
    }

    public function determineReplyEmail()
    {
        // If organizer didn't give up overrule email
        if ($this->event->email == null) {
            return $this->event->user->email;
        } else {
            return $this->event->email;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.event_registration')
                    ->subject('Inschrijving wedstrijd: '.$this->event->name)
                    ->replyTo(self::determineReplyEmail(), $this->event->user->name);
    }
}
