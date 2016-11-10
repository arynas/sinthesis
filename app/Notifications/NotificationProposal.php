<?php

namespace App\Notifications;

use App\Proposal;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotificationProposal extends Notification
{
    use Queueable;

    protected $proposal;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Proposal $proposal)
    {
        $this->proposal = $proposal;
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

        if($this->proposal->is_check == 0)
        {
            $url = url('theses');

            return (new MailMessage)
                ->from('admin@sinthesis.ac.id', 'Admin Sinthesis')
                ->subject('Pengumuman Proposal.')
                ->greeting('Salam!')
                ->line('Proposal Anda ditolak. Klik tautan berikut untuk lebih detailnya.')
                ->action('Detail', $url);
        }else{

            $url = url('theses');

            return (new MailMessage)
                ->from('admin@sinthesis.ac.id', 'Admin Sinthesis')
                ->subject('Pengumuman Proposal.')
                ->greeting('Salam!')
                ->line('Proposal Anda diterima. Klik tautan berikut untuk lebih detailnya.')
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
