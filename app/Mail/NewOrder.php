<?php

namespace App\Mail;

use App\Models\Chat;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewOrder extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $order;
    public $chat;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order, Chat $chat)
    {
        $this->order = $order;
        $this->chat = $chat;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Order #'.$this->order->code,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.seller.new_order',
            with: [
                'url' => route('seller.message', ['id' => $this->chat->id])
            ]
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
