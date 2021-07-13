<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\Admin\Discussion;
use App\Notifications\DiscussionReminderNotification;

class DiscussionReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discussion:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to check and run discussion reminder.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $discussions = Discussion::where('reminder', 1)->whereDate('reminder_datetime', Carbon::today())->get();
        if (isset($discussions)) {
            if ($discussions->count() > 0) {
                foreach ($discussions as $discussion) {
                    $user = $discussion->user;
                    if (isset($discussion->user)) {
                        $user->setSlackUrl(env('DISCUSSION_REMINDER_SLACK_WEBHOOK_URL'))->notify(new DiscussionReminderNotification($discussion));
                        $discussion->update([
                            'reminder' => 0
                        ]);
                        $this->info('Reminder Notification Sent Successfully !');
                    } else {
                        $this->error('No user found !');
                    }
                }
            } else {
                $this->error('No discussion reminder for today.');
            }
        }
    }
}
