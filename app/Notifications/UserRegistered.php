<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class UserRegistered extends Notification
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
      ->subject('Реєстрація користувача')
      ->greeting('Привіт!')
      ->line($this->user->name . ' ' . $this->user->surname)
      ->line('Ви успішно зареєструвалися у сервісі!')
      ->line('Найближчим часом ми активуємо Вас, і Ви зможете увійти.');
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
