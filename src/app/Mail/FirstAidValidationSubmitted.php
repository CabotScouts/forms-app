<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\{Address, Content, Envelope, Headers};
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\{Str, Uri};

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

    public function headers(): Headers
    {
        $fqdn = Uri::of(config('app.url'))->host();
        return new Headers(
            messageId: "validation-" . $this->validation->id . "@" . $fqdn,
            text: [
                'X-Entity-Ref-ID' => Str::random(40),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.first-aid.submitted',
        );
    }

}
