<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewUserRegistration extends Notification
{
    use Queueable;
    private $Notification;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($RegNotification)
    {
        $this->Notification = $RegNotification;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        // return (new MailMessage)
        //             ->line('New user is created with the name ',$notifiable->name)
        //             ->action('Notification Action', url('/'))
        //             ->line('Thank you for using our application!');
        return [
                'resgistration' => $this->Notification
            ];
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
