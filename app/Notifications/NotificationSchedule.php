<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\ConselingSchedule;
use Auth;

class NotificationSchedule extends Notification
{
    use Queueable;

    protected $schedule;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ConselingSchedule $schedule)
    {
        $this->schedule = $schedule;
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
        if(Auth::user()->role == 'lecturer')
        {
            $url = url('schedules');

            return (new MailMessage)
                ->from('admin@sinthesis.ac.id', 'Admin Sinthesis')
                ->subject('Pengumuman Jadwal Bimbingan dari Dosen.')
                ->greeting('Salam!')
                ->line('Ada jadwal baru dari dosen '.$this->schedule->lecturer->name.'. Klik tautan berikut untuk lebih detailnya.')
                ->action('Detail', $url);

        }elseif(Auth::user()->role == 'student')
        {
            $url = url('schedules');

            return (new MailMessage)
                ->from('admin@sinthesis.ac.id', 'Admin Sinthesis')
                ->subject('Pengumuman Permohonan Jadwal Bimbingan dari Mahasiswa.')
                ->greeting('Salam!')
                ->line(Auth::user()->username.' membuat permintaan jadwal pada Anda. Klik tautan berikut untuk lebih detailnya.')
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
