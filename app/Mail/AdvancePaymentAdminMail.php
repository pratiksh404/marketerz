<?php

namespace App\Mail;

use App\Models\Admin\Advance;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdvancePaymentAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $advance;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Advance $advance)
    {
        $this->advance = $advance;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('admin.layouts.components.mail.advance_payment_admin_email');
    }
}
