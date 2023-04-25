<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageReply extends Notification implements \Illuminate\Contracts\Mail\Mailable
{
    use Queueable;

    protected string $message;
    protected string $name;
    protected string $email;


    /**
     * Create a new notification instance.
     */
    public function __construct(string $message, string $name, string $email)
    {
        $this->message = $message;
        $this->name = $name;
        $this->email = $email;

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
            ->line('شكرا لتواصلك معنا')
            ->line('سنقوم بالرد عليك في اقرب وقت');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->message,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
