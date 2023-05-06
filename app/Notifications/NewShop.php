<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewShop extends Notification
{
    use Queueable;

    
     // برای ارسال نام کاربری ایمیل و پسورد فروشنده ثبت نام شده به ایمیل او
    private $email = null;
    private $pass = null;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

     // برای ارسال نام کاربری ایمیل و پسورد فروشنده ثبت نام شده به ایمیل او
    public function __construct($email, $pass)
    {
        $this->email = $email;
        $this->pass = $pass;
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
        return (new MailMessage)
                    ->greeting('سلام. به فروشگاه ما خوش امدید.')
                    ->line('برای شما در سایت فروشگاه یک حساب کاربری ایجاد شد. شما می توانید به حساب کاربری خود از طریق لینک زیر دسترسی پیدا کنید و وارد حساب کاربری خود شوید.')
                    ->line("نام کاربری شما $this->email  میباشد و رمز عبور $this->pass می باشد.")
                    ->action('ورود به حساب کاربری', url('/login'))
                    ->line('لطفا جهت امنیت بیشتر پس از ورود به حساب کاربری لطفا حتما روز عبور خود را تغییر دهید.!');
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
