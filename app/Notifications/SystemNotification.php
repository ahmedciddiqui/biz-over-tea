<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SystemNotification extends Notification 
{
    use Queueable;
    protected $title;
    protected $message;
    protected $actionText;
    protected $actionUrl;
    protected $sendMail;
    protected $mailView;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $title, $message, string $actionText = null, string $actionUrl = null, bool $sendMail = false, string $mailView = null)
    {
        $this->title = $title;
        $this->message = $message;
        $this->actionText = $actionText;
        $this->actionUrl = $actionUrl;
        $this->sendMail = $sendMail;
        $this->mailView = $mailView;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->sendMail ? ['mail', 'database'] : ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $mail = (new MailMessage)->subject($this->title);
        if ($this->mailView) {
            return $mail->view($this->mailView, [
                'data' => is_array($this->message) ? $this->message : ['message' => $this->message],
            ]);
        }

        $mail->line($this->message);

        if ($this->actionText && $this->actionUrl) {
            $mail->action($this->actionText, $this->actionUrl);
        }
        return $mail;
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'action_text' => $this->actionText,
            'action_url' => $this->actionUrl,
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
