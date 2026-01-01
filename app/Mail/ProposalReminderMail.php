<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProposalReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    

    public $proposal;

    public function __construct($proposal)
    {
        $this->proposal = $proposal;
    }
    
    public function build()
    {
        return $this->subject('Reminder: Proposal still pending')
                    ->view('emails.proposal');
    }
    
}
