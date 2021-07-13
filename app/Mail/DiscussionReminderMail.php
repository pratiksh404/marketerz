<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\Admin\Discussion;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DiscussionReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $discussion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Discussion $discussion)
    {
        $this->discussion = $discussion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('admin.layouts.components.mail.discussion_reminder_email');
    }
}
