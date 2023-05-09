<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderParticipant extends Mailable
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
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'url' => $this->data['url'],
            'friend_name' => $this->data['friend_name']
        ];
        return $this->subject($subject)->markdown('home.emails.reminderParticipant')->with('content', $data);
    }
}
