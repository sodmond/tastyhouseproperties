<?php

namespace App\Mail;

use App\Models\AbuseReport;
use App\Models\THC\AbuseReport as THCAbuseReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendAbuseReport extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $abuseReport;
    public $urlRouteName;

    /**
     * Create a new message instance.
     */
    public function __construct(AbuseReport|THCAbuseReport $report)
    {
        $this->abuseReport = $report;
        $this->urlRouteName = (get_class($report) == AbuseReport::class) ? 'admin.abusereport' : 'admin.thc.abusereport';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Abuse Report',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.abuse_report',
            with: [
                'url' => route($this->urlRouteName, ['id' => $this->abuseReport->id])
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
