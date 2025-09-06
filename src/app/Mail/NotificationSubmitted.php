<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use App\Models\Notification;

class NotificationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Notification $notification
    ) {}

    public function envelope(): Envelope
    {
        $reply = $this->notification->submitter_email ? new Address($this->notification->submitter_email, $this->notification->submitter_name) : new Address($this->notification->lic_email, $this->notification->lic_name);
        
        return new Envelope(
            subject: 'Activity Notification Submitted',
            replyTo: [$reply],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.notification.submitted',
        );
    }
}
