<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewRegistrationSubmitted extends Notification
{
    use Queueable;
    protected $registration;

    public function __construct($registration)
    {
        $this->registration = $registration;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Registration Submitted')
            ->greeting('Hello Admin,')
            ->line('A new registration has been submitted by ' . $this->registration->user->institution_name)
            ->line('Group Name: ' . $this->registration->group_name)
            ->action('View Registration', url(route('registration.show', $this->registration->id)))
            ->line('Thank you.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
