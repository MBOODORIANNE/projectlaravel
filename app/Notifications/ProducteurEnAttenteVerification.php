<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ProducteurEnAttenteVerification extends Notification
{
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Votre compte producteur est en cours de vérification')
            ->greeting('Bonjour ' . $notifiable->nom . ',')
            ->line('Votre inscription en tant que producteur a bien été prise en compte.')
            ->line('Votre compte est en cours de vérification par un administrateur.')
            ->line('Vous recevrez un email dès que votre compte sera validé.')
            ->salutation('Merci pour votre confiance !');
    }
}