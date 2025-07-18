<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ProducteurValidated extends Notification
{
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Votre compte producteur a été validé')
            ->line('Félicitations, votre compte producteur a été validé par l\'administrateur. Vous pouvez maintenant vous connecter.');
    }
}
