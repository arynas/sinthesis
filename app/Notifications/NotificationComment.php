<?php

namespace App\Notifications;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;

class NotificationComment extends Notification
{
    use Queueable;

    protected $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
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
        if (Auth::user()->role == 'student')
        {
            $url = url('conselings/'.$this->comment->conseling->id.'/comments');

            return (new MailMessage)
                ->from('admin@sinthesis.ac.id', 'Admin Sinthesis')
                ->subject('Pengumuman Komentar.')
                ->greeting('Salam!')
                ->line('Ada komentar baru dari '.Auth::user()->username.'. Klik tautan berikut untuk lebih detailnya.')
                ->action('Detail', $url);

        }elseif(Auth::user()->role == 'lecturer'){

            $url = url('conselings/'.$this->comment->conseling->id.'/show');

            return (new MailMessage)
                ->from('admin@sinthesis.ac.id', 'Admin Sinthesis')
                ->subject('Pengumuman Komentar.')
                ->greeting('Salam!')
                ->line('Ada komentar baru dari '.Auth::user()->username.'. Klik tautan berikut untuk lebih detailnya.')
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
