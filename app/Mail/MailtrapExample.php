<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailtrapExample extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($_GET['mail_email'], 'Mailtrap')
            ->subject($_GET['mail_subject'])
            ->markdown('mails.email')
            ->with([
                'name' => 'Aftab Ahmed',
                'sender' => $_GET['mail_name'],
                'message' => $_GET['mail_msg'],
                'link' => 'https://mailtrap.io/inboxes'
            ]);
    }
}
