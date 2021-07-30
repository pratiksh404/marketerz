<?php

namespace App\Notifications;

use App\Models\Admin\Advance;
use Illuminate\Bus\Queueable;
use League\HTMLToMarkdown\HtmlConverter;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class AdvancePaymentSlackNotfication extends Notification implements ShouldQueue
{
    use Queueable;

    protected $advance;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Advance $advance)
    {
        $this->advance = $advance;
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
        $advance = $this->advance;
        return (new SlackMessage)
            ->from(env('APP_NAME', 'Marketerz') . ' - Advance Payment Notification : ')
            ->content(isset($advance->remark) ? (new HtmlConverter())->convert($advance->remark) : 'No Remark')
            ->attachment(function ($attachment) use ($advance) {
                $attachment->title('Notification')
                    ->fields([
                        'subject' => 'Advance Payment Alert',
                        'particular' => $advance->particular,
                        'client' => $advance->client->name ?? 'N/A',
                        'phone' => $advance->client->phone ?? 'N/A',
                        'email' => $advance->client->email ?? 'N/A',
                        'amount' => config('adminetic.currency_symbol', 'Rs.') . $advance->amount,
                        'payment method' => $advance->payment_method
                    ]);
            });
    }
}
