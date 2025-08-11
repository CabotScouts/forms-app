<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\{Address, Content, Envelope};
use Illuminate\Queue\SerializesModels;

use App\Models\AccidentReport;

class AccidentReportSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public AccidentReport $report
    ) {}

    public function envelope(): Envelope
    {
        $reply = new Address($this->report->reporter_email, $this->report->reporter_name);

        return new Envelope(
            subject: 'Accident Report',
            replyTo: [$reply],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.accident-report.submitted',
        );
    }

}
