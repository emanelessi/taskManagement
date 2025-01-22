<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;


class TaskAssigned extends Notification
{
    use Queueable;
    public $task;

    /**
     * Create a new notification instance.
     */

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['database', 'mail', WebPushChannel::class];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'New Task Assigned',
            'body' => 'You have been assigned a new task: ' . $this->task->title,
            'url' => url('/tasks/' . $this->task->id),
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You have been assigned a new task: ' . $this->task->title)
            ->action('View Task', url('/tasks/' . $this->task->id))
            ->line('Thank you for using our application!');
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('New Task Assigned')
            ->icon('/notification-icon.png')
            ->body('You have been assigned a new task: ' . $this->task->title)
            ->action('View Task', 'view_task')
            ->data(['url' => url('/tasks/' . $this->task->id)]);
    }
}
