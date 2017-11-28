<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FreelancerResetPasswordNotification extends Notification
{
  use Queueable;

  public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
      $this->token = $token;
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
      ->subject('SysGAP - redefinição de senha')
      ->line('Você está recebendo este e-mail porque recebemos um pedido de redefinição de senha para sua conta SysGAP.')
      ->action('Redefinir Senha', route('freelancer.reseta-senha.reset', $this->token))
      ->line('Se você não solicitou uma redefinição da senha, nenhuma ação adicional é necessária!');
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
