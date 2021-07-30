<?php

namespace App\Notifications;

use App\Mail\ReturnAdminMail;
use App\Models\Admin\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReturnAdminNotfication extends Notification implements ShouldQueue
{
    use Queueable;

    public $project;

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
        if (isset($this->project->team_channel)) {
            return $this->project->getChannelArray(1);
        } else {
            return ['database'];
        }
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new ReturnAdminMail($this->project))->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $project = $this->project;;
        return [
            'subject' => 'Project Cancel Alert',
            'project_id' => $project->id,
            'client_id' => $project->client_id,
            'client' => $project->client->name ?? 'N/A',
            'phone' => $project->client->phone ?? 'N/A',
            'email' => $project->client->email ?? 'N/A',
            'amount' => config('adminetic.currency_symbol', 'Rs.') . $project->return,
        ];
    }
}
