<?php

namespace App\Notifications;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class LoginAlert extends Notification
{
    use Queueable;

    public $curDate;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->curDate = date("F m, Y, H:i:s A (").'GMT'.date(' O)');
    }

    public function getUserIpAddr()
    {
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
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
        $user = User::find($notifiable->id);
        $name = $user->firstname;
        $url = route('user.home');
        if (Auth::guard('admin')->check() && !Auth::guard('web')->check()) {
            $admin = Admin::find($notifiable->id);
            $name = $admin->firstname;
            $url = route('admin.home');
        }
        return (new MailMessage)
                    ->subject('Login Alert')
                    ->greeting('Dear '.$name)
                    ->line('Please be informed that your Plumeris admin account was accessed at '.$this->curDate.', using this IP Address '.$this->getUserIpAddr())
                    ->line('If you did not log on to your Plumeris account at the time detailed above, please change your password as fast as possible')
                    ->line(' ')
                    ->action('Login to your account', $url);
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
