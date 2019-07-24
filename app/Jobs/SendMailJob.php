<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $mailable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Mailable $mailable)
    {
        $this->mailable = $mailable;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->mailable->mail_recipient)
            ->bcc([
                ['email' => 'damms005@gmail.com'],
            ])
            ->send(new \App\Mail\MessageApplicant(
                $this->mailable->mail_recipient,
                $this->mailable->mail_from,
                $this->mailable->mail_message,
                $this->mailable->mail_subject
            ));
    }
}
