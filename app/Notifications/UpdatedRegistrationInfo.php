<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UpdatedRegistrationInfo extends Notification
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
            ->subject('Penyertaan Telah Dikemaskini Oleh Peserta')
            ->line('Penyertaan oleh ' . $this->registration->user->name . ' telah dikemaskini.')
            ->action('Lihat Maklumat', route('registration.view', $this->registration->id));
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
