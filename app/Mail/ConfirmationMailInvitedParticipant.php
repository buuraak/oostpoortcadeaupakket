<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationMailInvitedParticipant extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->data['subject'];
        $data = [
            'email' => $this->data['email'],
            'name' => $this->data['name'],
            'inviter_name' => $this->data['inviter_name'],
            'subject' => $subject,
            'url' => $this->data['url']
        ];
        return $this->subject($subject)->markdown('home.emails.confirmationInvitedParticipant')->with('content', $data);
    }
}
