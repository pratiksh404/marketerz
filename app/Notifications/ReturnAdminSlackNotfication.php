<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\Admin\Project;
use Illuminate\Bus\Queueable;
use League\HTMLToMarkdown\HtmlConverter;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class ReturnAdminSlackNotfication extends Notification implements ShouldQueue
{
    use Queueable;

    protected $project;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the Slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        $project = $this->project;
        return (new SlackMessage)
            ->from(env('APP_NAME', 'Marketerz') . ' - Project Cancellation Notification : ')
            ->content(isset($project->return_remark) ? (new HtmlConverter())->convert($project->return_remark) : 'No Remark')
            ->attachment(function ($attachment) use ($project) {
                $attachment->title('Project Cancellation Notification')
                    ->fields([
                        'subject' => 'Project Cancellation Alert',
                        'project_id' => $project->id,
                        'client' => $project->client->name ?? 'N/A',
                        'phone' => $project->client->phone ?? 'N/A',
                        'email' => $project->client->email ?? 'N/A',
                        'amount' => config('adminetic.currency_symbol', 'Rs.') . $project->return,
                        'cancellation date' => Carbon::create($project->cancel_date)->toFormattedDateString()
                    ]);
            });
    }
}
