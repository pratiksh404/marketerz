<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\Admin\Task;
use Illuminate\Bus\Queueable;
use App\Mail\TaskReminderMail;
use League\HTMLToMarkdown\HtmlConverter;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class TaskReminderNotification extends Notification
{
    use Queueable;

    protected $task;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $channels = [];
        if (isset($this->task->channel)) {
            foreach ($this->task->channel as $channel) {
                $channels[] = $this->task->getChannel($channel);
            }
        }
        return $channels ?? ['datatabse'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new TaskReminderMail($this->task))->to($notifiable->email);
    }

    /**
     * Get the Slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        $task = $this->task;
        return (new SlackMessage)
            ->from(env('APP_NAME', 'Marketerz') . ' - Task Reminder : ' . $task->task)
            ->content((new HtmlConverter())->convert($task->description))
            ->attachment(function ($attachment) use ($task) {
                $attachment->title('Reminder')
                    ->fields([
                        'Deadline' => isset($task->deadline) ? Carbon::create($task->deadline)->toFormattedDateString() : "N/A",
                        'Assigned By' => $task->user->name,
                    ]);
            });
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
            'id' => $this->task->id,
            'task' => $this->task->task,
            'description' => $this->task->description,
            'deadline' => isset($this->task->deadline) ? Carbon::create($this->task->deadline)->toFormattedDateString() : null,
        ];
    }
}
