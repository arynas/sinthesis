<?php

namespace App\Notifications;

use App\Conseling;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotificationConseling extends Notification
{
    use Queueable;

    protected $conseling;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Conseling $conseling)
    {
        $this->conseling = $conseling;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if ($this->conseling->user->role == 'student')
        {
            $url = url('conselings/'.$this->conseling->id.'/comments');

            return (new MailMessage)
                ->from('admin@sinthesis.ac.id', 'Admin Sinthesis')
                ->subject('Pengumuman Bimbingan.')
                ->greeting('Salam!')
                ->line('Ada bimbingan baru dari '.$this->conseling->user->username.'. Klik tautan berikut untuk lebih detailnya.')
                ->action('Detail', $url);
        }else{
            $url = url('conselings/'.$this->conseling->id);

            return (new MailMessage)
                ->from('admin@sinthesis.ac.id', 'Admin Sinthesis')
                ->subject('Pengumuman Bimbingan.')
                ->greeting('Salam!')
                ->line('Ada bimbingan baru dari '.$this->conseling->user->username.'. Klik tautan berikut untuk lebih detailnya.')
                ->action('Detail', $url);
        }
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
