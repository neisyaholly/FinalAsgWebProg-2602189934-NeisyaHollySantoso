<?php

namespace App\Notifications;

use App;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FriendRequestAccepted extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($notifiable)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $loc = session()->get('locale');
        App::setLocale($loc);

        return ['mail', 'database']; // You can add 'database' or 'mail' depending on your preference
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $loc = session()->get('locale');
        App::setLocale($loc);

        return (new MailMessage)
            ->line('Your friend request has been accepted!')
            ->action('View Friends', url('/friends'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $loc = session()->get('locale');
        App::setLocale($loc);

        return [
            'message' => 'Your friend request has been accepted!',
            'action_url' => url('/friends'),
        ];
    }
}