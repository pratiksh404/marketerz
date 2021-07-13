<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use App\Models\Admin\Discussion;
use App\Mail\DiscussionReminderMail;
use League\HTMLToMarkdown\HtmlConverter;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class DiscussionReminderNotification extends Notification
{
    use Queueable;

    protected $discussion;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Discussion $discussion)
    {
        $this->discussion = $discussion;
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
        if (isset($this->discussion->channel)) {
            foreach ($this->discussion->channel as $channel) {
                $channels[] = $this->discussion->getChannel($channel);
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
        return (new DiscussionReminderMail($this->discussion))->to($notifiable->email);
    }

    /**
     * Get the Slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        $discussion = $this->discussion;
        return (new SlackMessage)
            ->from(env('APP_NAME', 'Marketerz') . ' - Discussion Reminder : ' . $discussion->discussion)
            ->content((new HtmlConverter())->convert($discussion->discussion))
            ->attachment(function ($attachment) use ($discussion) {
                $attachment->title('Reminder')
                    ->fields([
                        'subject' => $discussion->subject ?? 'N/A',
                        'status' => $discussion->getStatus(),
                        'type' => $discussion->type ?? 'N/A',
                        'Discussion Date' => isset($discussion->discussion_date) ? Carbon::create($discussion->discussion_date)->toFormattedDateString() : "N/A",
                        'Discussion By' => $discussion->user->name,
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
        $discussion = $this->discussion;
        return [
            'id' => $discussion->id,
            'subject' => $discussion->subject ?? 'N/A',
            'status' => $discussion->getStatus(),
            'type' => $discussion->type ?? 'N/A',
            'discussion_datetime' => isset($discussion->discussion_date) ? Carbon::create($discussion->discussion_date)->toFormattedDateString() : "N/A",
            'reminder_datetime' => isset($discussion->reminder_datetime) ? Carbon::create($discussion->discussion_date)->toFormattedDateString() : "N/A",
        ];
    }
}
