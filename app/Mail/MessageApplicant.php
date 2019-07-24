<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageApplicant extends Mailable
{
    use Queueable, SerializesModels;

    public $mail_recipient;
    public $mail_from;
    public $mail_subject;
    public $mail_message;

    /**
     * Undocumented function
     *
     * @param [mixed] $user - \App\User or simply plain email repreented as string (hence 'mixed' type @signature)
     * @param [type] $from
     * @param [type] $subject
     * @param [type] $message
     */
    public function __construct($recipient, $from, $subject, $message)
    {
        $this->mail_recipient = $recipient;
        $this->mail_from      = $from;
        $this->mail_subject   = $subject;
        $this->mail_message   = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from($this->mail_from)
            ->subject($this->mail_subject)
            ->view('mail.default', [
                'message_text' => $this->mail_message,
            ]);

        $this->withSwiftMessage(function ($message) {
            //something to do when mail sent successfully (note: not necessarily means delivery guaranteed)
            // $message->getHeaders()->addTextHeader('Custom-Header', 'eMail sent successfully');
        });

        return $this;
    }
}
