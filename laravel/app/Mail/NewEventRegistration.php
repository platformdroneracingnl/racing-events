<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Registration;
use App\Models\Event;
use App\Models\User;
use App\Models\Organization;

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
    public function __construct($registration, $event, $organization, $user) {
        $this->registration = $registration;
        $this->event = $event;
        $this->organization = $organization;
        $this->user = $user;
    }

    public function determineReplyEmail() {
        // If user didn't give up overrule email
        if ($this->event[0]->email == null) {
            return $this->user[0]->email;
        } else {
            return $this->event[0]->email;
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
                    ->subject('Inschrijving wedstrijd: '.$this->event[0]->name)
                    ->replyTo(NewEventRegistration::determineReplyEmail(), $this->user[0]->name);
    }
}