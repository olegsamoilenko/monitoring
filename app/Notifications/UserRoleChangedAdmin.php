<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRoleChangedAdmin extends Notification
{
  use Queueable;

  /**
   * The user instance.
   *
   * @var \App\Models\User
   */
  private $user;

  /**
   * Create a new notification instance.
   *
   * @return void
   */
  public function __construct(User $user)
  {
    $this->user = $user;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @param mixed $notifiable
   * @return array
   */
  public function via($notifiable)
  {
    return ['mail'];
  }

  /**
   * Get the mail representation of the notification.
   *
   * @param mixed $notifiable
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toMail($notifiable)
  {
    return (new MailMessage)
      ->subject('Зміна ролі користувача')
      ->greeting('Привіт!')
      ->line($this->user->name . ' ' . $this->user->surname)
      ->line('Вашу роль змінено на Адміністратор. Тепер Ви можете увійти в Панель Адміністратора.')
      ->action('Увійти до Адмінки', url('/admin'));
  }

  /**
   * Get the array representation of the notification.
   *
   * @param mixed $notifiable
   * @return array
   */
  public function toArray($notifiable)
  {
    return [
      //
    ];
  }
}
