<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConsultantApproved extends Notification implements ShouldQueue
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
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Votre compte consultant a été approuvé - LeJob.ma')
                    ->greeting('Bonjour ' . $notifiable->name . ',')
                    ->line('Nous sommes heureux de vous informer que votre demande pour devenir consultant sur LeJob.ma a été approuvée par notre équipe.')
                    ->line('Votre compte est maintenant activé et vous pouvez commencer à offrir vos services de consultation.')
                    ->line('Prochaines étapes:')
                    ->line('1. Complétez votre profil consultant avec vos compétences, expériences et tarifs')
                    ->line('2. Définissez vos disponibilités pour les sessions de consultation')
                    ->line('3. Commencez à recevoir des réservations de nos utilisateurs')
                    ->action('Compléter mon profil', url('/consultant/profile'))
                    ->line('Nous sommes ravis de vous compter parmi notre réseau de consultants professionnels.')
                    ->line('Votre expertise aidera de nombreux chercheurs d\'emploi à atteindre leurs objectifs professionnels.')
                    ->salutation('Cordialement, L\'équipe LeJob.ma');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Votre compte consultant a été approuvé.',
            'action_url' => '/consultant/profile',
        ];
    }
}