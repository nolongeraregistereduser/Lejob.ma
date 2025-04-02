<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConsultantApproved extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Votre compte consultant a été activé - LeJob.ma')
                    ->greeting('Bonjour ' . $notifiable->name . ',')
                    ->line('Nous sommes heureux de vous informer que votre compte consultant a été approuvé et activé.')
                    ->line('Vous pouvez maintenant vous connecter à votre tableau de bord et commencer à utiliser toutes les fonctionnalités de consultant.')
                    ->action('Accéder à mon compte', url('/login'))
                    ->line('Merci de faire partie de notre communauté de consultants!')
                    ->salutation('L\'équipe LeJob.ma');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}