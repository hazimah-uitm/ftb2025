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
            ->subject('Pendaftaran anda telah ' . $this->registration->status)
            ->greeting('Salam Sejahtera ' . $this->registration->user->name . ',')
            ->line('Pendaftaran anda untuk "' . $this->registration->group_name . '" telah ' . $this->registration->status . '.')
            ->line('Catatan daripada Admin: ' . ($this->registration->remarks_checker ?? '-'))
            ->action('Papar Maklumat', url(route('registration.view', $this->registration->id))) // adjust route name
            ->salutation("Terima kasih.");
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
