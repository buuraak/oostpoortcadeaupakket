<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminNewParticipant extends Mailable
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
            'emailParticipant' => $this->data['emailParticipant'],
            'emailFriend' => $this->data['emailFriend']
        ];

        return $this->subject($subject)->markdown('home.emails.adminNewParticipant')->with('content', $data);
    }
}
