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
            ->subject('Pendaftaran Baharu Telah Dihantar')
            ->greeting('Salam sejahtera,')
            ->line('Satu penyertaan baharu telah dihantar oleh ' . $this->registration->user->institution_name)
            ->line('Nama Kumpulan: ' . $this->registration->group_name)
            ->action('Papar Maklumat', url(route('registration.view', $this->registration->id)))
            ->salutation("Terima kasih,\nFestival Tari Borneo 2025");
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
