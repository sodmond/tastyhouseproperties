<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendNewChatEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $fname;
    public $senderType;
    public $chatUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($fname, $sender)
    {
        $this->fname = $fname;
        $this->senderType = $sender;
        $this->chatUrl = ($sender == 'user') ? route('seller.messages') : route('user.messages');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Chat from ' . ucwords($this->senderType),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.new_chat',
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
