<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\{Address, Content, Envelope};
use Illuminate\Queue\SerializesModels;

use App\Models\FirstAidValidation;

class FirstAidValidationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public FirstAidValidation $validation
    ) {}

    public function envelope(): Envelope
    {
        $reply = new Address($this->validation->email, $this->validation->name);

        return new Envelope(
            subject: 'First Aid Validation Request',
            replyTo: [$reply],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.first-aid-validation.submitted',
        );
    }

}
