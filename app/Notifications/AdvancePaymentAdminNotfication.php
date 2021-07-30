<?php

namespace App\Notifications;

use App\Mail\AdvancePaymentAdminMail;
use App\Models\Admin\Advance;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdvancePaymentAdminNotfication extends Notification implements ShouldQueue
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
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new AdvancePaymentAdminMail($this->advance))->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $advance = $this->advance;
        return [
            'subject' => 'Advance Payment Alert',
            'advance_id' => $this->advance->id,
            'particular' => $advance->particular,
            'client_id' => $advance->client_id,
            'client' => $advance->client->name ?? 'N/A',
            'phone' => $advance->client->phone ?? 'N/A',
            'email' => $advance->client->email ?? 'N/A',
            'amount' => config('adminetic.currency_symbol', 'Rs.') . $advance->amount,
            'payment_method' => $advance->payment_method
        ];
    }
}
