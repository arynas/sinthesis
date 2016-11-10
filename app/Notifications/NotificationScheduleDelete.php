<?php

namespace App\Notifications;

use App\ConselingRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;

class NotificationScheduleDelete extends Notification
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
        if(Auth::user()->role == 'lecturer')
        {
            $url = url('schedules');

            return (new MailMessage)
                ->from('admin@sinthesis.ac.id', 'Admin Sinthesis')
                ->subject('Pengumuman Dosen Membatalkan Jadwal Bimbingan.')
                ->greeting('Salam!')
                ->line('Dosen '.$this->request->conseling_schedule->lecturer->name.' membatalkan jadwal bimbingan. Klik tautan berikut untuk lebih detailnya.')
                ->action('Detail', $url);

        }elseif(Auth::user()->role == 'student')
        {
            $url = url('schedules');

            return (new MailMessage)
                ->from('admin@sinthesis.ac.id', 'Admin Sinthesis')
                ->subject('Pengumuman Mahasiswa Membatalkan Jadwal Bimbingan.')
                ->greeting('Salam!')
                ->line($this->request->student->name.' membatalkan jadwal bimbingan. Klik tautan berikut untuk lebih detailnya.')
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
