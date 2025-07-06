<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class UserValidated extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Votre compte a été validé')
            ->line('Bonjour ' . $notifiable->nom . ',')
            ->line('Votre compte a été validé avec succès. Vous pouvez maintenant vous connecter.')
            ->action('Se connecter', url('/login'));
    }
}
