<?php

namespace App\Notifications;

use App\ConselingRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotificationRequest extends Notification
{
    use Queueable;

    protected $request;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ConselingRequest $request)
    {
        $this->request = $request;
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
        $url = url('schedules');

        if($this->request->is_confirmed == 0)
        {
            return (new MailMessage)
                ->from('admin@sinthesis.ac.id', 'Admin Sinthesis')
                ->subject('Pengumuman Konfirmasi Jadwal dari Dosen.')
                ->greeting('Salam!')
                ->line('Jadwal yang Anda minta pada '.$this->request->conseling_schedule->starts_at.' ditolak oleh dosen. Klik tautan berikut untuk lebih detailnya.')
                ->action('Detail', $url);

        }elseif($this->request->is_confirmed == 1)
        {
            return (new MailMessage)
                ->from('admin@sinthesis.ac.id', 'Admin Sinthesis')
                ->subject('Pengumuman Konfirmasi Jadwal dari Dosen.')
                ->greeting('Salam!')
                ->line('Jadwal yang Anda minta pada '.$this->request->conseling_schedule->starts_at.' diterima oleh dosen. Klik tautan berikut untuk lebih detailnya.')
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
