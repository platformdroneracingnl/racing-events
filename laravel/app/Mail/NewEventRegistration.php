<?php

namespace App\Mail;

use App\Models\User;
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
    public function __construct($registration, $event, $organization, $user)
    {
        $this->registration = $registration;
        $this->event = $event;
        $this->organization = $organization;
        $this->user = $user;
    }

    public function determineReplyEmail()
    {
        // If user didn't give up overrule email
        if ($this->event->email == null) {
            return $this->user->email;
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
                    ->replyTo(self::determineReplyEmail(), $this->user->name);
    }
}
