<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RegistrationStatusUpdated extends Notification
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
            ->subject('Your Registration Has Been ' . $this->registration->status)
            ->greeting('Hello ' . $this->registration->user->name . ',')
            ->line('Your registration for "' . $this->registration->group_name . '" has been ' . $this->registration->status . '.')
            ->line('Remarks from admin: ' . ($this->registration->remarks_checker ?? '-'))
            ->action('View Details', url(route('registration.view', $this->registration->id))) // adjust route name
            ->line('Thank you for your registration.');
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
