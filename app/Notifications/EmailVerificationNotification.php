<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmailVerificationNotification extends Notification
{
    protected $user;
    protected $token;

    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $verificationUrl = url('/verify-email/' . $this->token);

        return (new MailMessage)
            ->subject('Account Email Verification')
            ->greeting('Hello')
            ->line('Please click the link below to verify your account:')
            ->action('Verify Email', $verificationUrl)
            ->line('If you did not register, please ignore this email.');
    }
}
