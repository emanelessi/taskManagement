<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class TaskDue extends Notification
{
    use Queueable;

    public $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['mail', WebPushChannel::class];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Your task is due soon: ' . $this->task->title)
            ->action('View Task', url('/tasks/' . $this->task->id))
            ->line('Thank you for using our application!');
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('Task Due Soon')
            ->icon('/notification-icon.png')
            ->body('Your task is due soon: ' . $this->task->title)
            ->action('View Task', 'view_task')
            ->data(['url' => url('/tasks/' . $this->task->id)]);
    }
}
