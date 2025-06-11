<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApprovalRequest extends Notification
{
    use Queueable;
    public $author_id;

    /**
     * Create a new notification instance.
     */
    public function __construct($author_id)
    {
        $this->author_id = $author_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject('Author Approval Request')
                    ->line('A newly registered author is requesting for account approval. Click the button below to view pauthor profile.')
                    ->action('View Profile', route('admin.author', ['id' => $this->author_id]))
                    ->line('Kindly verify that all author details are accurate and legit before approving.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
